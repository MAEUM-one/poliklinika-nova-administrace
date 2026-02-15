<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonResource\Pages;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $label = 'Osoba';
    protected static ?string $pluralLabel = 'Osoby';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NAME')
                    ->label('Jméno')
                    ->required(),
                Forms\Components\TextInput::make('SURNAME')
                    ->label('Příjmení')
                    ->required(),
                Forms\Components\Select::make('IMAGE')
                    ->options([
                        'doctor_male' => 'Doktor',
                        'doctor_female' => 'Doktorka',
                        'nurse_male' => 'Zdravotní bratr',
                        'nurse_female' => 'Zdravotní sestra',
                        'assistant_male' => 'Asistent',
                        'assistant_female' => 'Asistentka',
                        'administrative_male' => 'Administrativní pracovník',
                        'administrative_female' => 'Administrativní pracovnice',
                        'ceo_male' => 'Jednatel',
                        'ceo_female' => 'Jednatelka',
                        'jicin_nurse' => 'Sestra Jičín',
                        'jicin_rental' => 'Sestra - Půjčovna pomůcek'
                    ])
                    ->label('Obrázek osoby')
                    ->required()
                    ->helperText('Upravuje obrázek osoby'),
                Forms\Components\TextInput::make('TITLE')
                    ->label('Titul'),
                Forms\Components\TextInput::make('POSITION')
                    ->label('Pozice'),
                Forms\Components\TextInput::make('EMAIL')
                    ->label('E-mail')
                    ->email(),
                Forms\Components\TextInput::make('PHONE')
                    ->label('Telefon'),
                Forms\Components\TextInput::make('CELL')
                    ->label('Mobil'),
                Forms\Components\TextInput::make('WEB')
                    ->label('Webové stránky'),
                Forms\Components\Textarea::make('QUALIFICATION')
                    ->label('Kvalifikace'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('NAME')->label('Jméno'),
                Tables\Columns\TextColumn::make('SURNAME')->label('Příjmení'),
                Tables\Columns\TextColumn::make('EMAIL')->label('E-mail'),
                Tables\Columns\TextColumn::make('POSITION')->label('Pozice'),
            ])
            ->filters([])
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}
