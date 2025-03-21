<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TeacherQuickActionsWidget;
use App\Filament\Widgets\TeacherStatsWidget;
use App\Models\Subject;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class TeacherDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Teacher Dashboard';
    protected static ?string $slug = 'teacher-dashboard';
    protected static ?string $navigationGroup = 'Teacher';
    protected static ?int $navigationSort = 1;
    protected static bool $shouldRegisterNavigation = true;

    protected static string $view = 'filament.pages.teacher-dashboard';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::check() && Auth::user()->hasRole('teacher');
    }

    public function mount(): void
    {
        if (!Auth::user()->hasRole('teacher')) {
            abort(403);
        }
    }

    public function getSubjects()
    {
        return Subject::where('teacher_id', Auth::id())->get();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TeacherStatsWidget::class,
            TeacherQuickActionsWidget::class,
        ];
    }
} 