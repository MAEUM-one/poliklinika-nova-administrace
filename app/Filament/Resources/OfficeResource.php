<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeResource\Pages;
use App\Filament\Resources\OfficeResource\RelationManagers\PeopleRelationManager;
use App\Models\Office;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Rawilk\FilamentQuill\Filament\Forms\Components\QuillEditor;
use TomatoPHP\FilamentIcons\Components\IconPicker;

class OfficeResource extends Resource
{
    protected static ?string $model = Office::class;
    protected static ?string $recordTitleAttribute = 'NAME';
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $label = 'Ordinace';
    protected static ?string $pluralLabel = 'Ordinace';

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
        $persons = [];

        Person::all()->each(function ($person) use (&$persons) {
            $persons[$person->PERSON_ID] = $person->NAME . ' ' . $person->SURNAME . ' (' . $person->POSITION . ')';
        });
        return $form
            ->schema([
                TextInput::make('ICON')
                    ->label('Ikona'),
                Forms\Components\TextInput::make('NAME')
                    ->label('Název ordinace')
                    ->required(),

                Forms\Components\TextInput::make('WEB')
                    ->label('Webové stránky'),
                QuillEditor::make('INFO')
                    ->label('Informace')
                        ->columnSpan(2)
                    ->required(),
                QuillEditor::make('ACTUAL_INFO')
                    ->label('Aktuální informace')
                    ->columnSpan(2),
                Forms\Components\TextInput::make('NUMBER')
                    ->label('Telefon'),
                Forms\Components\TextInput::make('EMAIL')
                    ->label('E-mail'),
                Forms\Components\Textarea::make('POSITION')
                    ->label('Pozice (adresa)'),
                Forms\Components\TextInput::make('COMPANY')
                    ->label('Společnost'),
                Forms\Components\Toggle::make('HIDDEN')
                    ->label('Skryto'),
                /*Forms\Components\Repeater::make('people')
                    ->columnSpan(2)
                    ->label('Seznam osob')
                    ->relationship('people')
                    ->grid(4)
                    ->simple(
                        Forms\Components\Select::make('PERSON_ID')
                            ->label('Osoba')
                            ->options($persons)
                    ),*/
                Section::make('Otevírací doba')->schema([
                Grid::make()
                    ->schema([
                        Section::make('Nadpisy dní')
                            ->schema([
                                TextInput::make('header_m1')->hiddenLabel(),
                                TextInput::make('header_m2')->hiddenLabel()->hidden(fn ($get) => $get('header_m2') === 'Skrýt'),
                                TextInput::make('header_m3')->hiddenLabel()->hidden(fn ($get) => $get('header_m3') === 'Skrýt'),
                                TextInput::make('header_m4')->hiddenLabel()->hidden(fn ($get) => $get('header_m4') === 'Skrýt'),
                            ])
                            ->columns(5),
                        // Sekce pro Pondělí
                        Section::make('Pondělí')
                            ->schema([
                                TextInput::make('monday_m1')->hiddenLabel(),
                                TextInput::make('monday_m2')->hiddenLabel()->hidden(fn ($get) => $get('monday_m2') === 'Skrýt'),
                                TextInput::make('monday_m3')->hiddenLabel()->hidden(fn ($get) => $get('monday_m3') === 'Skrýt'),
                                TextInput::make('monday_m4')->hiddenLabel()->hidden(fn ($get) => $get('monday_m4') === 'Skrýt'),
                            ])
                            ->columns(5),

                        // Sekce pro Úterý
                        Section::make('Úterý')
                            ->schema([
                                TextInput::make('tuesday_m1')->hiddenLabel(),
                                TextInput::make('tuesday_m2')->hiddenLabel()->hidden(fn ($get) => $get('tuesday_m2') === 'Skrýt'),
                                TextInput::make('tuesday_m3')->hiddenLabel()->hidden(fn ($get) => $get('tuesday_m3') === 'Skrýt'),
                                TextInput::make('tuesday_m4')->hiddenLabel()->hidden(fn ($get) => $get('tuesday_m4') === 'Skrýt'),
                            ])
                            ->columns(5),

                        // Sekce pro Středu
                        Section::make('Středa')
                            ->schema([
                                TextInput::make('wednesday_m1')->hiddenLabel(),
                                TextInput::make('wednesday_m2')->hiddenLabel()->hidden(fn ($get) => $get('wednesday_m2') === 'Skrýt'),
                                TextInput::make('wednesday_m3')->hiddenLabel()->hidden(fn ($get) => $get('wednesday_m3') === 'Skrýt'),
                                TextInput::make('wednesday_m4')->hiddenLabel()->hidden(fn ($get) => $get('wednesday_m4') === 'Skrýt'),
                            ])
                            ->columns(5),

                        // Sekce pro Čtvrtek
                        Section::make('Čtvrtek')
                            ->schema([
                                TextInput::make('thursday_m1')->hiddenLabel(),
                                TextInput::make('thursday_m2')->hiddenLabel()->hidden(fn ($get) => $get('thursday_m2') === 'Skrýt'),
                                TextInput::make('thursday_m3')->hiddenLabel()->hidden(fn ($get) => $get('thursday_m3') === 'Skrýt'),
                                TextInput::make('thursday_m4')->hiddenLabel()->hidden(fn ($get) => $get('thursday_m4') === 'Skrýt'),
                            ])
                            ->columns(5),

                        // Sekce pro Pátek
                        Section::make('Pátek')
                            ->schema([
                                TextInput::make('friday_m1')->hiddenLabel(),
                                TextInput::make('friday_m2')->hiddenLabel()->hidden(fn ($get) => $get('friday_m2') === 'Skrýt'),
                                TextInput::make('friday_m3')->hiddenLabel()->hidden(fn ($get) => $get('friday_m3') === 'Skrýt'),
                                TextInput::make('friday_m4')->hiddenLabel()->hidden(fn ($get) => $get('friday_m4') === 'Skrýt'),
                            ])
                            ->columns(5),

                        // Sekce pro Sobotu
                        Section::make('Sobota')
                            ->schema([
                                TextInput::make('saturday_m1')->hiddenLabel(),
                                TextInput::make('saturday_m2')->hiddenLabel()->hidden(fn ($get) => $get('saturday_m2') === 'Skrýt'),
                                TextInput::make('saturday_m3')->hiddenLabel()->hidden(fn ($get) => $get('saturday_m3') === 'Skrýt'),
                                TextInput::make('saturday_m4')->hiddenLabel()->hidden(fn ($get) => $get('saturday_m4') === 'Skrýt'),
                            ])
                            ->columns(5),

                        // Sekce pro Neděli
                        Section::make('Neděle')
                            ->schema([
                                TextInput::make('sunday_m1')->hiddenLabel(),
                                TextInput::make('sunday_m2')->hiddenLabel()->hidden(fn ($get) => $get('sunday_m2') === 'Skrýt'),
                                TextInput::make('sunday_m3')->hiddenLabel()->hidden(fn ($get) => $get('sunday_m3') === 'Skrýt'),
                                TextInput::make('sunday_m4')->hiddenLabel()->hidden(fn ($get) => $get('sunday_m4') === 'Skrýt'),
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
                Tables\Columns\TextColumn::make('NAME')->label('Název ordinace'),
                Tables\Columns\TextColumn::make('EMAIL')->label('E-mail'),
                Tables\Columns\BooleanColumn::make('HIDDEN')->label('Skryto'),
            ])
            ->filters([]);
    }

    public static function getRelations(): array
    {
        return [PeopleRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffices::route('/'),
            'create' => Pages\CreateOffice::route('/create'),
            'edit' => Pages\EditOffice::route('/{record}/edit'),
        ];
    }
}
