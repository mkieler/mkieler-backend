<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Models\Author;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

/**
 * Form schema for testimonial resource.
 */
class TestimonialForm
{
    /**
     * Configure the testimonial form schema.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Testimonial')
                    ->schema([
                        Textarea::make('quote')
                            ->required()
                            ->rows(4),
                        Select::make('author_id')
                            ->label('Author')
                            ->relationship('author', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Author $record): string => "{$record->name} - {$record->company}")
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
