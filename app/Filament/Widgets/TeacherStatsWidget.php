<?php

namespace App\Filament\Widgets;

use App\Models\StudentGrade;
use App\Models\Subject;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $teacherId = Auth::id();
        
        $totalStudents = StudentGrade::whereHas('subject', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->distinct('user_id')->count();

        $totalSubjects = Subject::where('teacher_id', $teacherId)->count();

        $averageScore = StudentGrade::whereHas('subject', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->avg('score');

        return [
            Stat::make('Total Students', $totalStudents)
                ->description('Students across all subjects')
                ->icon('heroicon-o-users'),
            
            Stat::make('Total Subjects', $totalSubjects)
                ->description('Subjects assigned')
                ->icon('heroicon-o-academic-cap'),
            
            Stat::make('Average Score', number_format($averageScore ?? 0, 2))
                ->description('Across all subjects')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
} 