<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JournalistResource\Pages;
use App\Filament\Resources\JournalistResource\RelationManagers;
use App\Models\Journalist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JournalistResource extends Resource
{
    protected static ?string $model = Journalist::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Журналисты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('smi_name')
                    ->required()
                    ->label('Название СМИ')
                    ->maxLength(255),
                Forms\Components\TextInput::make('fio')
                    ->label('ФИО')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone')
                    ->label('Телефон')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('devices')
                    ->label('Перечень ввозимого оборудования')
                    ->required(),
                Forms\Components\TextInput::make('position')
                    ->label('Должность')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('comment')
                    ->label('Комментарии')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('smi_name')
                    ->label('Название СМИ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fio')
                    ->label('ФИО')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->label('Телефон')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Должность')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Комментарии')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата регистрации')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageJournalists::route('/'),
        ];
    }
}
