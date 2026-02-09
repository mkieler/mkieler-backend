<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Testimonial')
                    ->schema([
                        Textarea::make('quote')
                            ->required()
                            ->rows(4),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('Author')
                    ->schema([
                        TextInput::make('author_name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('author_role')
                            ->label('Role')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('author_company')
                            ->label('Company')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(3),
            ]);
    }
}
