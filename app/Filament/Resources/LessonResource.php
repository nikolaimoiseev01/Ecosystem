<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\LessonResource\Pages\ListLessons;
use App\Filament\Resources\LessonResource\Pages\CreateLesson;
use App\Filament\Resources\LessonResource\Pages\EditLesson;
use App\Enums\ActualityEnums;
use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Учебный процесс';
    protected static ?string $navigationLabel = 'Уроки';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Общее')
                            ->schema([
                                Grid::make()->schema([
                                    SpatieMediaLibraryFileUpload::make('icon')
                                        ->collection('icon')
                                        ->label('Иконка')
                                        ->columnSpan(1),
                                    Grid::make()->schema([
                                        Select::make('module_id')
                                            ->relationship('module', 'name')
                                            ->label('Модуль')
                                            ->required(),
                                        TextInput::make('name')
                                            ->required()
                                            ->label('Название')
                                            ->maxLength(255),
                                        Select::make('actuality')
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
                                TextInput::make('title')
                                    ->required()
                                    ->label('Заголовок')
                                    ->maxLength(255),
                                Textarea::make('desc')
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
                        Tab::make('Контент урока')
                            ->schema([
                                RichEditor::make('content')
                            ]),
                    ])->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('module.name')
                    ->numeric()
                    ->label('Модуль')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->limit(100)
                    ->searchable(),
                TextColumn::make('actuality')
                    ->label('Актуальность')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Создан')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            ->recordActions([
                EditAction::make(),
            ])
            ->defaultSort('sort')
            ->reorderable('sort')
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
            'index' => ListLessons::route('/'),
            'create' => CreateLesson::route('/create'),
            'edit' => EditLesson::route('/{record}/edit'),
        ];
    }
}
