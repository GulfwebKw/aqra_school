<?php

namespace App\Filament\Resources\ApplicationsResource\Pages;

use App\Filament\Resources\ApplicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
