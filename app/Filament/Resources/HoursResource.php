<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HoursResource\Pages;
use App\Models\Hours;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class HoursResource extends Resource
{
    protected static ?string $model = Hours::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $label = 'Hodiny';
    protected static ?string $pluralLabel = 'Hodiny';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('HOURS_ID')
                    ->label('ID hodin')
                    ->required(),
                Forms\Components\TextInput::make('HEADER')
                    ->label('Nadpis')
                    ->required(),
                Forms\Components\TextInput::make('MON')->label('Pondělí'),
                Forms\Components\TextInput::make('TUE')->label('Úterý'),
                Forms\Components\TextInput::make('WED')->label('Středa'),
                Forms\Components\TextInput::make('THU')->label('Čtvrtek'),
                Forms\Components\TextInput::make('FRI')->label('Pátek'),
                Forms\Components\TextInput::make('SAT')->label('Sobota'),
                Forms\Components\TextInput::make('SUN')->label('Neděle'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('HOURS_ID')->label('ID hodin'),
                Tables\Columns\TextColumn::make('HEADER')->label('Nadpis'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHours::route('/'),
            'create' => Pages\CreateHours::route('/create'),
            'edit' => Pages\EditHours::route('/{record}/edit'),
        ];
    }
}
