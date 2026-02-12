<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Components\ComponentRegistry;
use App\Models\Page;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

/**
 * Form schema for pages.
 */
class PageForm
{
    /**
     * Configure the page form schema.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Page')
                    ->tabs(fn (?Page $record): array => self::buildTabs($record))
                    ->columnSpanFull(),
            ]);
    }

    /**
     * Build all tabs for the page form.
     *
     * @return array<int, Tab>
     */
    private static function buildTabs(?Page $record): array
    {
        return [
            Tab::make('General')
                ->schema([
                    Section::make('Page Details')
                        ->schema([
                            TextInput::make('name')
                                ->required(),
                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true),
                            Select::make('author_id')
                                ->relationship('author', 'name')
                                ->searchable()
                                ->preload(),
                        ])
                        ->columns(3),
                ]),

            Tab::make('Components')
                ->schema(self::buildComponentSections($record)),

            Tab::make('SEO')
                ->schema([
                    Group::make()
                        ->relationship('seo')
                        ->schema([
                            Section::make('SEO Settings')
                                ->schema([
                                    TextInput::make('title')
                                        ->required(),
                                    Textarea::make('description')
                                        ->rows(3)
                                        ->required(),
                                ]),
                            Section::make('Open Graph')
                                ->schema([
                                    TextInput::make('og_title'),
                                    Textarea::make('og_description')
                                        ->rows(2),
                                    TextInput::make('og_image')
                                        ->url(),
                                ]),
                        ]),
                ]),
        ];
    }

    /**
     * Build sections for all components on this page.
     *
     * @return array<int, Section>
     */
    private static function buildComponentSections(?Page $record): array
    {
        if (! $record) {
            return [
                Section::make('Components')
                    ->description('Save the page first to manage components.'),
            ];
        }

        $components = $record->components()->with('data')->get();

        if ($components->isEmpty()) {
            return [
                Section::make('Components')
                    ->description('No components found for this page.'),
            ];
        }

        $sections = [];

        foreach ($components as $component) {
            $definition = ComponentRegistry::get($component->name);
            $label = $definition ? $definition::label() : $component->name;

            $sections[] = Section::make($label)
                ->schema(self::buildComponentFields($definition, $component->name))
                ->collapsible()
                ->collapsed();
        }

        return $sections;
    }

    /**
     * Build form fields for a component.
     *
     * @param  class-string<\App\Components\Definitions\BaseComponent>|null  $definition
     * @return array<int, mixed>
     */
    private static function buildComponentFields(?string $definition, string $componentName): array
    {
        if (! $definition) {
            return [];
        }

        $fields = [];

        // Single fields - simple text inputs
        foreach ($definition::singleFields() as $key => $config) {
            $fieldName = "component_{$componentName}_{$key}";
            $fields[] = match ($config['type']) {
                'textarea' => Textarea::make($fieldName)
                    ->label($config['label'])
                    ->rows(4),
                'url' => TextInput::make($fieldName)
                    ->label($config['label'])
                    ->url(),
                default => TextInput::make($fieldName)
                    ->label($config['label']),
            };
        }

        // Multiple fields - TagsInput for multiple string values
        foreach ($definition::multipleFields() as $key => $config) {
            $fieldName = "component_{$componentName}_{$key}";
            $fields[] = TagsInput::make($fieldName)
                ->label($config['label'])
                ->placeholder('Add item and press Enter');
        }

        // Repeater fields - for complex nested items
        foreach ($definition::repeaterFields() as $key => $config) {
            $fieldName = "component_{$componentName}_{$key}";
            $itemFields = [];

            foreach ($config['fields'] as $fieldKey => $fieldConfig) {
                $itemFields[] = match ($fieldConfig['type']) {
                    'textarea' => Textarea::make($fieldKey)
                        ->label($fieldConfig['label'])
                        ->rows(2),
                    default => TextInput::make($fieldKey)
                        ->label($fieldConfig['label']),
                };
            }

            $fields[] = Repeater::make($fieldName)
                ->label($config['label'])
                ->schema($itemFields)
                ->columns(count($config['fields']))
                ->collapsible()
                ->itemLabel(fn (array $state): ?string => $state['title'] ?? $state['label'] ?? null);
        }

        return $fields;
    }
}
