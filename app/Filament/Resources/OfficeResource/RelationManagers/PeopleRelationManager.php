<?php

namespace App\Filament\Resources\OfficeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeopleRelationManager extends RelationManager
{
    protected static string $relationship = 'people';
    protected static ?string $title = 'Lidé';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NAME')
                    ->required()
                    ->label('Jméno')
                    ->maxLength(255),

                Forms\Components\TextInput::make('SURNAME')
                    ->required()
                    ->label('Příjmení')
                    ->maxLength(255),

                Forms\Components\TextInput::make('POSITION')
                    ->required()
                    ->label('Pozice')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('NAME')
            ->recordTitle(fn (Model $record) => $record->full_name)
            ->reorderable('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('NAME')->label('Jméno'),
                Tables\Columns\TextColumn::make('SURNAME')->label('Příjmení'),
                Tables\Columns\TextColumn::make('POSITION')->label('Pozice'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make()
            ])
            ->defaultSort('sort_order', 'asc')
            ->bulkActions([
            ]);
    }
}
