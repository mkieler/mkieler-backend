<?php

namespace App\Filament\Resources\ServicesPages\Pages;

use App\Filament\Resources\ServicesPages\ServicesPageResource;
use App\Models\ServicesPage;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for ServicesPage resource.
 *
 * Automatically redirects to edit page if a services page record exists (singleton behavior).
 */
class ListServicesPages extends ListRecords
{
    protected static string $resource = ServicesPageResource::class;

    public function mount(): void
    {
        $servicesPage = ServicesPage::query()->first();

        if ($servicesPage) {
            $this->redirect(ServicesPageResource::getUrl('edit', ['record' => $servicesPage]));

            return;
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
