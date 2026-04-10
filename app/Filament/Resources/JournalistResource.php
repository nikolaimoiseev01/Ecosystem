<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\JournalistResource\Pages\ManageJournalists;
use App\Filament\Resources\JournalistResource\Pages;
use App\Filament\Resources\JournalistResource\RelationManagers;
use App\Models\Journalist;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JournalistResource extends Resource
{
    protected static ?string $model = Journalist::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Журналисты';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('smi_name')
                    ->required()
                    ->label('Название СМИ')
                    ->maxLength(255),
                TextInput::make('fio')
                    ->label('ФИО')
                    ->required()
                    ->maxLength(255),
                TextInput::make('telephone')
                    ->label('Телефон')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Textarea::make('devices')
                    ->label('Перечень ввозимого оборудования')
                    ->required(),
                TextInput::make('position')
                    ->label('Должность')
                    ->required()
                    ->maxLength(255),
                Textarea::make('comment')
                    ->label('Комментарии')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('smi_name')
                    ->label('Название СМИ')
                    ->searchable(),
                TextColumn::make('fio')
                    ->label('ФИО')
                    ->searchable(),
                TextColumn::make('telephone')
                    ->label('Телефон')
                    ->searchable(),
                TextColumn::make('position')
                    ->label('Должность')
                    ->searchable(),
                TextColumn::make('comment')
                    ->label('Комментарии')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Дата регистрации')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageJournalists::route('/'),
        ];
    }
}
