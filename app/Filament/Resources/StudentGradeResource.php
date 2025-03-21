<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentGradeResource\Pages;
use App\Filament\Resources\StudentGradeResource\RelationManagers;
use App\Models\StudentGrade;
use App\Models\User;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Auth;

class StudentGradeResource extends Resource
{
    protected static ?string $model = StudentGrade::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Academic Management';

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        $subjectQuery = Subject::query();
        
        if ($user->hasRole('teacher')) {
            $subjectQuery->where('teacher_id', $user->id);
        }

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('subject_id')
                            ->label('Subject')
                            ->relationship('subject', 'name', fn ($query) => $subjectQuery)
                            ->required()
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('user_id', null);
                            }),
                        Select::make('user_id')
                            ->label('Student')
                            ->relationship('user', 'name', function ($query, $get) {
                                $subjectId = $get('subject_id');
                                if ($subjectId) {
                                    $query->whereHas('subjectRegistrations', function ($query) use ($subjectId) {
                                        $query->where('subject_id', $subjectId);
                                    });
                                }
                                $query->role('student');
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->disabled(fn ($get) => !$get('subject_id')),
                        Select::make('grade_id')
                            ->label('Grade')
                            ->relationship('grade', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('score')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100),
                        Textarea::make('remarks')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $query = StudentGrade::query();

        if ($user->hasRole('teacher')) {
            $query->whereHas('subject', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            });
        }

        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query)
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade.name')
                    ->label('Grade')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('score')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('remarks')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudentGrades::route('/'),
            'create' => Pages\CreateStudentGrade::route('/create'),
            'edit' => Pages\EditStudentGrade::route('/{record}/edit'),
        ];
    }
}
