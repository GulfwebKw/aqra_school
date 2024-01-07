<?php

namespace App\Filament\Resources\ApplicationsResource\Pages;

use App\Filament\Resources\ApplicationsResource;
use App\Models\Application;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApplications extends ViewRecord
{
    protected static string $resource = ApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('visit')
                ->label('Guest View')
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->openUrlInNewTab()
                ->color('info')
                ->url(function(Application $application) {
                    return  route('application.show', ['uuid' => $application->uuid]);
                }),
            Actions\Action::make('download')
                ->label('PDF Export')
                ->icon('heroicon-o-document-check')
                ->openUrlInNewTab()
                ->color('info')
                ->url(function(Application $application) {
                    return  route('application.export', ['uuid' => $application->uuid]);
                }),
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
