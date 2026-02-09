<?php

namespace App\Filament\Resources\ServicesPages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServicesPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('headline')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->required()
                            ->rows(5),
                    ]),
                Section::make('CTA')
                    ->schema([
                        Textarea::make('cta_text')
                            ->label('CTA Text')
                            ->required()
                            ->rows(3),
                        TextInput::make('cta_button_label')
                            ->label('Button Label')
                            ->required()
                            ->maxLength(255),
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
