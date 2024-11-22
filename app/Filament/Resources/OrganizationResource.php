<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Models\Organization;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $label = 'Organizace';
    protected static ?string $pluralLabel = 'Organizace';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NAME')
                    ->label('Název organizace')
                    ->required(),
                Forms\Components\RichEditor::make('INFO')
                    ->label('Informace')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\RichEditor::make('ACTUAL_INFO')
                    ->label('Aktuální informace')
                    ->columnSpan(2),
                Forms\Components\TextInput::make('WEB')
                    ->label('Webové stránky'),
                Forms\Components\TextInput::make('NUMBER')
                    ->label('Telefon'),
                Forms\Components\TextInput::make('EMAIL')
                    ->label('E-mail'),
                Forms\Components\Textarea::make('POSITION')
                    ->label('Pozice (adresa)'),
                Forms\Components\TextInput::make('COMPANY')
                    ->label('Společnost'),

                Section::make('Otevírací doba')->schema([
                    Grid::make()
                        ->schema([
                            Section::make('Nadpisy dní')
                                ->schema([
                                    TextInput::make('header_m1')->hiddenLabel(),
                                    TextInput::make('header_m2')->hiddenLabel()->hidden(fn ($get) => $get('header_m2') === 'Skrýt'),
                                ])
                                ->columns(5),
                            // Sekce pro Pondělí
                            Section::make('Pondělí')
                                ->schema([
                                    TextInput::make('monday_m1')->hiddenLabel(),
                                    TextInput::make('monday_m2')->hiddenLabel()->hidden(fn ($get) => $get('monday_m2') === 'Skrýt'),
                                ])
                                ->columns(5),

                            // Sekce pro Úterý
                            Section::make('Úterý')
                                ->schema([
                                    TextInput::make('tuesday_m1')->hiddenLabel(),
                                    TextInput::make('tuesday_m2')->hiddenLabel()->hidden(fn ($get) => $get('tuesday_m2') === 'Skrýt'),
                                ])
                                ->columns(5),

                            // Sekce pro Středu
                            Section::make('Středa')
                                ->schema([
                                    TextInput::make('wednesday_m1')->hiddenLabel(),
                                    TextInput::make('wednesday_m2')->hiddenLabel()->hidden(fn ($get) => $get('wednesday_m2') === 'Skrýt')
                                ])
                                ->columns(5),

                            // Sekce pro Čtvrtek
                            Section::make('Čtvrtek')
                                ->schema([
                                    TextInput::make('thursday_m1')->hiddenLabel(),
                                    TextInput::make('thursday_m2')->hiddenLabel()->hidden(fn ($get) => $get('thursday_m2') === 'Skrýt'),
                                ])
                                ->columns(5),

                            // Sekce pro Pátek
                            Section::make('Pátek')
                                ->schema([
                                    TextInput::make('friday_m1')->hiddenLabel(),
                                    TextInput::make('friday_m2')->hiddenLabel()->hidden(fn ($get) => $get('friday_m2') === 'Skrýt'),
                                ])
                                ->columns(5),

                            // Sekce pro Sobotu
                            Section::make('Sobota')
                                ->schema([
                                    TextInput::make('saturday_m1')->hiddenLabel(),
                                    TextInput::make('saturday_m2')->hiddenLabel()->hidden(fn ($get) => $get('saturday_m2') === 'Skrýt'),
                                ])
                                ->columns(5),

                            // Sekce pro Neděli
                            Section::make('Neděle')
                                ->schema([
                                    TextInput::make('sunday_m1')->hiddenLabel(),
                                    TextInput::make('sunday_m2')->hiddenLabel()->hidden(fn ($get) => $get('sunday_m2') === 'Skrýt'),
                                ])
                                ->columns(5),
                        ])
                        ->columns(1)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('NAME')->label('Název organizace'),
                Tables\Columns\TextColumn::make('EMAIL')->label('E-mail'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
