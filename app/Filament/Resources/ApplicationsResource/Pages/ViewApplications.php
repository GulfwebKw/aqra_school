<?php

namespace App\Filament\Resources\ApplicationsResource\Pages;

use App\Filament\Resources\ApplicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApplications extends ViewRecord
{
    protected static string $resource = ApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
