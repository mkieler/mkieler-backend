<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Components\ComponentRegistry;
use App\Filament\Resources\Pages\PageResource;
use App\Models\Page;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page with component data handling.
 */
class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    /**
     * Load component data into form state.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var Page $record */
        $record = $this->record;

        foreach ($record->components()->with('data')->get() as $component) {
            $definition = ComponentRegistry::get($component->name);

            if (! $definition) {
                continue;
            }

            // Load single fields
            foreach ($definition::singleFields() as $key => $config) {
                $fieldName = "component_{$component->name}_{$key}";
                $data[$fieldName] = $component->getValue($key);
            }

            // Load multiple fields (as array)
            foreach ($definition::multipleFields() as $key => $config) {
                $fieldName = "component_{$component->name}_{$key}";
                $data[$fieldName] = $component->getValues($key);
            }

            // Load repeater fields (JSON items as array of arrays)
            foreach ($definition::repeaterFields() as $key => $config) {
                $fieldName = "component_{$component->name}_{$key}";
                $data[$fieldName] = array_map(
                    fn (string $json) => json_decode($json, true),
                    $component->getValues($key)
                );
            }
        }

        return $data;
    }

    /**
     * Save component data from form state.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        /** @var Page $record */
        $record = $this->record;

        foreach ($record->components()->with('data')->get() as $component) {
            $definition = ComponentRegistry::get($component->name);

            if (! $definition) {
                continue;
            }

            // Clear existing data for this component
            $component->data()->delete();

            // Save single fields
            foreach ($definition::singleFields() as $key => $config) {
                $fieldName = "component_{$component->name}_{$key}";
                if (isset($data[$fieldName]) && $data[$fieldName] !== null && $data[$fieldName] !== '') {
                    $component->data()->create(['key' => $key, 'value' => $data[$fieldName]]);
                }
                unset($data[$fieldName]);
            }

            // Save multiple fields
            foreach ($definition::multipleFields() as $key => $config) {
                $fieldName = "component_{$component->name}_{$key}";
                if (isset($data[$fieldName]) && is_array($data[$fieldName])) {
                    foreach ($data[$fieldName] as $value) {
                        if ($value !== null && $value !== '') {
                            $component->data()->create(['key' => $key, 'value' => $value]);
                        }
                    }
                }
                unset($data[$fieldName]);
            }

            // Save repeater fields (as JSON)
            foreach ($definition::repeaterFields() as $key => $config) {
                $fieldName = "component_{$component->name}_{$key}";
                if (isset($data[$fieldName]) && is_array($data[$fieldName])) {
                    foreach ($data[$fieldName] as $item) {
                        if (is_array($item)) {
                            $component->data()->create(['key' => $key, 'value' => json_encode($item)]);
                        }
                    }
                }
                unset($data[$fieldName]);
            }
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
