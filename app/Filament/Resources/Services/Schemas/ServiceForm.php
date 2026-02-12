<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Service')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                Section::make('Basic Information')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('slug')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255),
                                        TextInput::make('headline')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('icon')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('i-lucide-code'),
                                        TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                        Toggle::make('featured')
                                            ->label('Featured on homepage')
                                            ->default(false),
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
                            ]),
                        Tab::make('Content')
                            ->schema([
                                TagsInput::make('features')
                                    ->label('Features')
                                    ->required(),
                                TagsInput::make('technologies')
                                    ->label('Technologies')
                                    ->required(),
                                TagsInput::make('benefits')
                                    ->label('Benefits')
                                    ->required(),
                                TagsInput::make('use_cases')
                                    ->label('Use Cases')
                                    ->required(),
                                TagsInput::make('related_services')
                                    ->label('Related Services (slugs)'),
                            ]),
                        Tab::make('Process')
                            ->schema([
                                Repeater::make('processes')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('step')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('description')
                                            ->required()
                                            ->rows(2),
                                    ])
                                    ->columns(3)
                                    ->orderColumn('step')
                                    ->defaultItems(5),
                            ]),
                        Tab::make('FAQ')
                            ->schema([
                                Repeater::make('faqs')
                                    ->relationship()
                                    ->schema([
                                        Textarea::make('question')
                                            ->required()
                                            ->rows(2),
                                        Textarea::make('answer')
                                            ->required()
                                            ->rows(3),
                                        TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                    ])
                                    ->orderColumn('sort_order')
                                    ->defaultItems(3),
                            ]),
                        Tab::make('SEO')
                            ->schema([
                                Group::make()
                                    ->relationship('seo')
                                    ->schema([
                                        Section::make('SEO Settings')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->required()
                                                    ->maxLength(255),
                                                Textarea::make('description')
                                                    ->required()
                                                    ->rows(3),
                                            ]),
                                        Section::make('Open Graph')
                                            ->schema([
                                                TextInput::make('og_title')
                                                    ->maxLength(255),
                                                Textarea::make('og_description')
                                                    ->rows(2),
                                                TextInput::make('og_image')
                                                    ->url(),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
