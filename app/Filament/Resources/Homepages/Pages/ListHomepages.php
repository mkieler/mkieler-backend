<?php

namespace App\Filament\Resources\Homepages\Pages;

use App\Filament\Resources\Homepages\HomepageResource;
use App\Models\Homepage;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for Homepage resource.
 *
 * Automatically redirects to edit page if a homepage record exists (singleton behavior).
 */
class ListHomepages extends ListRecords
{
    protected static string $resource = HomepageResource::class;

    public function mount(): void
    {
        $homepage = Homepage::query()->first();

        if ($homepage) {
            $this->redirect(HomepageResource::getUrl('edit', ['record' => $homepage]));

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
