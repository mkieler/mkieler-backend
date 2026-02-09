<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Location Information')
                    ->schema([
                        TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('suffix')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('i København'),
                        TextInput::make('headline')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
                Section::make('Description')
                    ->schema([
                        Textarea::make('description')
                            ->required()
                            ->rows(3),
                        Textarea::make('long_description')
                            ->required()
                            ->rows(8),
                    ]),
                Section::make('Nearby Areas')
                    ->schema([
                        TagsInput::make('nearby_areas')
                            ->label('Nearby Areas')
                            ->required(),
                    ]),
                Section::make('SEO')
                    ->schema([
                        TextInput::make('seo_title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('seo_description')
                            ->label('Description')
                            ->required()
                            ->rows(3),
                        TextInput::make('seo_og_title')
                            ->label('OG Title')
                            ->maxLength(255),
                        TextInput::make('seo_og_description')
                            ->label('OG Description')
                            ->maxLength(255),
                    ]),
            ]);
    }
}
