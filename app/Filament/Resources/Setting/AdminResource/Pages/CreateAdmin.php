<?php

namespace App\Filament\Resources\Setting\UserResource\Pages;

use App\Filament\Resources\Setting\AdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;
}
