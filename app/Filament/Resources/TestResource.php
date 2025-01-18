<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Тесты';
    protected static ?string $navigationGroup = "Тестирование";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lesson_id')
                    ->relationship('lesson', 'name')
                    ->label('Урок')
                    ->required(),
                Forms\Components\Repeater::make('questions')
                    ->label('Вопросы теста')
                    ->addActionLabel('Добавить вопрос')
                    ->schema([
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make('question')
                                ->label('Вопрос')
                                ->columnSpan(5)
                                ->required()
                        ])->columns(6),

                        Forms\Components\Repeater::make('answers')
                            ->label('Ответы')
                            ->addActionLabel('Добавить ответ')
                            ->schema([
                                Forms\Components\Grid::make()->schema([
                                    Forms\Components\TextInput::make('text')
                                        ->label('Вариант ответа')
                                        ->columnSpan(3)
                                        ->required(),
                                    Forms\Components\Checkbox::make('correct_flg')
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
                Tables\Columns\TextColumn::make('lesson.name')
                    ->label('Для урока')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('questions')
                    ->label('Вопросов в тесте')
                    ->getStateUsing(function (Model $record) {
                        return collect($record['questions'])->count();
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Создан')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Обновлен')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
