<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\TestResource\Pages\ListTests;
use App\Filament\Resources\TestResource\Pages\CreateTest;
use App\Filament\Resources\TestResource\Pages\EditTest;
use App\Enums\ActualityEnums;
use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Тесты';
    protected static string | \UnitEnum | null $navigationGroup = "Тестирование";

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lesson_id')
                    ->relationship('lesson', 'name')
                    ->label('Урок'),
                Select::make('module_id')
                    ->relationship('module', 'name')
                    ->label('Модуль'),
                Select::make('actuality')
                    ->options([
                        ActualityEnums::OLD->value => ActualityEnums::OLD->value,
                        ActualityEnums::NEW->value => ActualityEnums::NEW->value
                    ]),
                Repeater::make('questions')
                    ->label('Вопросы теста')
                    ->addActionLabel('Добавить вопрос')
                    ->schema([
                        Grid::make()->schema([
                            TextInput::make('question')
                                ->label('Вопрос')
                                ->columnSpan(5)
                                ->required()
                        ])->columns(6),

                        Repeater::make('answers')
                            ->label('Ответы')
                            ->addActionLabel('Добавить ответ')
                            ->schema([
                                Grid::make()->schema([
                                    TextInput::make('text')
                                        ->label('Вариант ответа')
                                        ->columnSpan(3)
                                        ->required(),
                                    Checkbox::make('correct_flg')
                                        ->label('Верный')
                                        ->columnSpan(1)
                                ])->columns(4)
                            ])->grid(2)
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.name')
                    ->label('Для урока')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('module.name')
                    ->label('Для модуля')
                    ->sortable(),
                TextColumn::make('questions')
                    ->label('Вопросов в тесте')
                    ->getStateUsing(function (Model $record) {
                        return collect($record['questions'])->count();
                    }),
                TextColumn::make('actuality')
                    ->label('Актуальность')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Создан')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Обновлен')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('actuality')
                    ->label('Актуальность')
                    ->options([
                        ActualityEnums::OLD->value => ActualityEnums::OLD->value,
                        ActualityEnums::NEW->value => ActualityEnums::NEW->value
                    ])->default(ActualityEnums::NEW->value)
            ])
            ->paginated(['all'])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTests::route('/'),
            'create' => CreateTest::route('/create'),
            'edit' => EditTest::route('/{record}/edit'),
        ];
    }
}
