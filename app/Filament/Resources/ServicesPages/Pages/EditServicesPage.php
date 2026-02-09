<?php

namespace App\Filament\Resources\ServicesPages\Pages;

use App\Filament\Resources\ServicesPages\ServicesPageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServicesPage extends EditRecord
{
    protected static string $resource = ServicesPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
