<?php

namespace App\Filament\Resources\Homepages\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomepagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('seo_title')
                    ->label('Title')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('hero_headline')
                    ->label('Hero Headline')
                    ->limit(50),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
