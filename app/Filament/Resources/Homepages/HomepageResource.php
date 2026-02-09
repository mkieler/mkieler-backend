<?php

namespace App\Filament\Resources\Homepages;

use App\Filament\Resources\Homepages\Pages\CreateHomepage;
use App\Filament\Resources\Homepages\Pages\EditHomepage;
use App\Filament\Resources\Homepages\Pages\ListHomepages;
use App\Filament\Resources\Homepages\Schemas\HomepageForm;
use App\Filament\Resources\Homepages\Tables\HomepagesTable;
use App\Models\Homepage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomepageResource extends Resource
{
    protected static ?string $model = Homepage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HomepageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomepagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomepages::route('/'),
            'create' => CreateHomepage::route('/create'),
            'edit' => EditHomepage::route('/{record}/edit'),
        ];
    }
}
