<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResultResource\Pages;
use App\Filament\Resources\TestResultResource\RelationManagers;
use App\Models\TestResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResultResource extends Resource
{
    protected static ?string $model = TestResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = "Тестирование";
    protected static ?string $navigationLabel = 'Результаты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Пользователь')
                    ->required(),
                Forms\Components\Select::make('test_id')
                    ->relationship('test', 'id')
                    ->required(),
                Forms\Components\TextInput::make('total_correct_answers')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('applicant_correct_answers')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('result')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Имя пользователя')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('test.lesson.name')
                    ->label('Тест для урока')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_correct_answers')
                    ->label('Вопросов в тесте')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('applicant_correct_answers')
                    ->label('Правильных ответов')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Создан')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлен')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTestResults::route('/'),
            'create' => Pages\CreateTestResult::route('/create'),
//            'view' => Pages\ViewTestResult::route('/{record}'),
            'edit' => Pages\EditTestResult::route('/{record}/edit'),
        ];
    }
}
