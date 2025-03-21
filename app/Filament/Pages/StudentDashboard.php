<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StudentGradesTableWidget;
use App\Filament\Widgets\StudentGradesWidget;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class StudentDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Student Dashboard';
    protected static ?string $slug = 'student-dashboard';
    protected static ?string $navigationGroup = 'Student';
    protected static ?int $navigationSort = 1;
    protected static bool $shouldRegisterNavigation = true;

    protected static string $view = 'filament.pages.student-dashboard';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::check() && Auth::user()->hasRole('student');
    }

    public function mount(): void
    {
        if (!Auth::user()->hasRole('student')) {
            abort(403);
        }
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StudentGradesWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            StudentGradesTableWidget::class,
        ];
    }

    protected function getHeaderWidgetsData(): array
    {
        return [];
    }

    protected function getFooterWidgetsData(): array
    {
        return [];
    }
} 