<?php

namespace App\Filament\Resources\Stacks\Schemas;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Stack Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('headline')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(3),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('Content')
                    ->schema([
                        TagsInput::make('bullets')
                            ->label('Bullet Points')
                            ->required(),
                        TagsInput::make('tags')
                            ->label('Technology Tags')
                            ->required(),
                    ]),
            ]);
    }
}
