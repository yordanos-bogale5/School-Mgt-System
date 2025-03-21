<?php

namespace App\Filament\Resources\SubjectRegistrationResource\Pages;

use App\Filament\Resources\SubjectRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubjectRegistrations extends ListRecords
{
    protected static string $resource = SubjectRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 