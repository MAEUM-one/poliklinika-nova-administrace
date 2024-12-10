<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MetadataResource\Pages;
use App\Models\Metadata;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Rawilk\FilamentQuill\Filament\Forms\Components\QuillEditor;

class MetadataResource extends Resource
{
    protected static ?string $model = Metadata::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $label = 'Článek';
    protected static ?string $pluralLabel = 'Články';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('IMAGES')->default(' -'),
                Forms\Components\Hidden::make('IMAGES_CAPTION')->default('- '),

                Forms\Components\Hidden::make('AUTHOR')
                    ->label('Autor')
                    ->default('fjid-fj4-5f6f95ddc562cu')
                    ->required(),
                Forms\Components\FileUpload::make('IMAGE')
                    ->image()
                    ->imageEditor()
                    ->required()
                    ->uploadingMessage('Vkládám obrázek do vnitra serveru, pomalu, ale jistě')
                    ->imagePreviewHeight('250')
                    ->label('Obrázek'),
                Forms\Components\TextInput::make('SLUG')
                    ->label('Zkratka')
                    ->placeholder('kratky-text-bez-diakritiky')
                    ->hiddenOn('edit')
                    ->required(),
                Forms\Components\DateTimePicker::make('DATE')
                    ->label('Datum')
                    ->required(),
                Forms\Components\Repeater::make('content')
                    ->columnSpan(2)
                    ->label('Obsah článku')
                    ->relationship('content')
                    ->deletable(false)
                    ->maxItems(1)
                    ->schema([
                        Forms\Components\TextInput::make('HEADER')
                            ->label('Nadpis')
                            ->required(),
                        QuillEditor::make('CONTENT')
                            ->label('Obsah')
                            ->required(),
                        Forms\Components\Hidden::make('LANG')
                            ->label('Jazyk (ISO)')
                            ->default('cs')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('IMAGE')
                    ->label('Obrázek'),
                Tables\Columns\TextColumn::make('HEADER')
            ->label('Nadpis'),
                Tables\Columns\TextColumn::make('SLUG')
                    ->label('Slug'),
                Tables\Columns\TextColumn::make('DATE')
                    ->label('Datum')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\DeleteAction::make('delete')
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMetadata::route('/'),
            'create' => Pages\CreateMetadata::route('/create'),
            'edit' => Pages\EditMetadata::route('/{record}/edit'),
        ];
    }
}
