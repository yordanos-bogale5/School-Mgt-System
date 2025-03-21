<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TeacherQuickActionsWidget extends Widget
{
    protected static string $view = 'filament.widgets.teacher-quick-actions-widget';

    protected int | string | array $columnSpan = 'full';
} 