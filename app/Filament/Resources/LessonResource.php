<?php

namespace App\Filament\Resources;

use App\Enums\ActualityEnums;
use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Учебный процесс';
    protected static ?string $navigationLabel = 'Уроки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Общее')
                            ->schema([
                                Forms\Components\Grid::make()->schema([
                                    SpatieMediaLibraryFileUpload::make('icon')
                                        ->collection('icon')
                                        ->label('Иконка')
                                        ->required()
                                        ->columnSpan(1),
                                    Forms\Components\Grid::make()->schema([
                                        Forms\Components\Select::make('module_id')
                                            ->relationship('module', 'name')
                                            ->label('Модуль')
                                            ->required(),
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->label('Название')
                                            ->maxLength(255),
                                        Forms\Components\Select::make('actuality')
                                            ->options([
                                                ActualityEnums::OLD->value => ActualityEnums::OLD->value,
                                                ActualityEnums::NEW->value => ActualityEnums::NEW->value
                                            ])
                                            ->required()
                                            ->label('Актуальность')
                                            ->hint('Что означает это поле')
                                            ->hintIcon('heroicon-m-question-mark-circle')
                                            ->hintIconTooltip('Выберите, является ли запись актуальной или устаревшей')
                                    ])->columns(1)->columnSpan(1)
                                ])->columns(2),
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->label('Заголовок')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('desc')
                                    ->required()
                                    ->autosize()
                                    ->label('Описание')
                                    ->maxLength(65535)
                                    ->columnSpanFull()
                                    ->columnSpan(1),
                                SpatieMediaLibraryFileUpload::make('video')
                                    ->collection('video')
                                    ->label('Видео')
                                    ->previewable(false)
                            ]),
                        Tabs\Tab::make('Контент урока')
                            ->schema([
                                Forms\Components\RichEditor::make('content')
                            ]),
                    ])->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module.name')
                    ->numeric()
                    ->label('Модуль')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->limit(100)
                    ->searchable(),
                Tables\Columns\TextColumn::make('actuality')
                    ->label('Актуальность')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Создан')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Обновлен')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('actuality')
                    ->label('Актуальность')
                    ->options([
                        ActualityEnums::OLD->value => ActualityEnums::OLD->value,
                        ActualityEnums::NEW->value => ActualityEnums::NEW->value
                    ])->default(ActualityEnums::NEW->value)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('sort')
            ->reorderable('sort')
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
