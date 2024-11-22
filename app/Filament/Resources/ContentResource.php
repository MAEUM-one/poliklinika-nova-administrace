<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Models\Content;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $label = 'Obsah';
    protected static ?string $pluralLabel = 'Obsahy';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('HEADER')
                    ->label('Nadpis')
                    ->required(),
                Forms\Components\Textarea::make('CONTENT')
                    ->label('Obsah')
                    ->required(),
                Forms\Components\TextInput::make('SLUG')
                    ->label('Slug')
                    ->required(),
                Forms\Components\TextInput::make('LANG')
                    ->label('Jazyk (ISO)')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('HEADER')
                    ->label('Nadpis'),
                Tables\Columns\TextColumn::make('LANG')
                    ->label('Jazyk'),
                Tables\Columns\TextColumn::make('SLUG')
                    ->label('Slug'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [

            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
