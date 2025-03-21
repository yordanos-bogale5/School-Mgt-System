<?php

namespace App\Filament\Widgets;

use App\Models\StudentGrade;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StudentGradesWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = Auth::user();
        $grades = $user->studentGrades;

        $averageScore = $grades->avg('score') ?? 0;
        $highestScore = $grades->max('score') ?? 0;
        $lowestScore = $grades->min('score') ?? 0;

        return [
            Stat::make('Average Score', number_format($averageScore, 1))
                ->description('Your overall average grade')
                ->descriptionIcon('heroicon-m-star')
                ->color($averageScore >= 70 ? 'success' : ($averageScore >= 50 ? 'warning' : 'danger')),

            Stat::make('Highest Score', number_format($highestScore, 1))
                ->description('Your best grade')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Lowest Score', number_format($lowestScore, 1))
                ->description('Your lowest grade')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
        ];
    }
}
