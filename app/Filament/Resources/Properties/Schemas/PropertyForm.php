<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->default(null),
                Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->default(null),
                TextInput::make('property_type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('purpose')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                TextInput::make('price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                TextInput::make('rent_price')
                    ->numeric()
                    ->default(null),
                TextInput::make('currency')
                    ->required()
                    ->default('USD'),
                TextInput::make('country')
                    ->default(null),
                TextInput::make('city')
                    ->default(null),
                TextInput::make('address')
                    ->default(null),
                TextInput::make('lat')
                    ->numeric()
                    ->default(null),
                TextInput::make('lng')
                    ->numeric()
                    ->default(null),
                TextInput::make('bedrooms')
                    ->numeric()
                    ->default(null),
                TextInput::make('bathrooms')
                    ->numeric()
                    ->default(null),
                TextInput::make('area_sq_m')
                    ->numeric()
                    ->default(null),
                Toggle::make('furnished')
                    ->required(),
                Textarea::make('attributes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
