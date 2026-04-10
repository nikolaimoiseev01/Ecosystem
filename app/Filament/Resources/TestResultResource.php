<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\Resources\TestResultResource\Pages\ListTestResults;
use App\Filament\Resources\TestResultResource\Pages\CreateTestResult;
use App\Filament\Resources\TestResultResource\Pages\EditTestResult;
use App\Filament\Resources\TestResultResource\Pages;
use App\Filament\Resources\TestResultResource\RelationManagers;
use App\Models\TestResult;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TestResultResource extends Resource
{
    protected static ?string $model = TestResult::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static string | \UnitEnum | null $navigationGroup = "Тестирование";
    protected static ?string $navigationLabel = 'Результаты';

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('result')
                    ->getStateUsing(function (TestResult $testResult): string {
                        return getUserFullName($testResult->user);
                    })
                    ->label('Пользователь'),
                TextEntry::make('lesson.name')
                    ->default('Вне уроков')
                    ->label('Тест для урока')
                    ->numeric(),
                TextEntry::make('module.name')
                    ->default('Вне модуля')
                    ->label('Тест для модуля')
                    ->numeric(),
                TextEntry::make('applicant_points')
                    ->label('Пользователь набрал баллов')
                    ->numeric(),
                TextEntry::make('test_points')
                    ->label('Баллов в тесте')
                    ->numeric(),
                Section::make('Подробное описание')->schema([
                    TextEntry::make('result')
                        ->label('')
                        ->formatStateUsing(function (TestResult $testResult): HtmlString {
                            $html = '<i>V - Ответ верный по тесту. · - Пользователь выбрал этот вариант</i> <br><br>';
                            $questions = json_decode($testResult['result']);
//                            dd($answers);
                            foreach ($questions as $question) {
                                $question_correct_string = 'Отвечен ' . ($question->answered_correct ? 'правильно' : 'неправильно');
                                $html .= "<b>{$question->question} ($question_correct_string)</b><br>";
                                foreach ($question->answers as $answer) {
                                    $correct_string = ($answer->correct_flg ? 'V' : '');
                                    $answered_correct_string = ($answer->answered_correct ? '·' : '');
                                    $html .= "$correct_string {$answer->text} $answered_correct_string <br>";
                                }
                            }
                            $html = new HtmlString($html);
                            return $html;
                        })
                        ->columnSpanFull()
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.id')
                    ->label('ID пользователя')
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Имя пользователя')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('lesson.name')
                    ->label('Тест для урока')
                    ->default('Вне уроков')
                    ->searchable()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('module.name')
                    ->label('Тест для модуля')
                    ->default('Вне модулей')
                    ->searchable()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('test_points')
                    ->label('Баллов в тесте')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('applicant_points')
                    ->label('Правильных ответов')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Создан')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('user')
                    ->relationship('user', 'id')
            ])
            ->recordUrl(
                fn (Model $record): string => '',
            )
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->toolbarActions([
                BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => ListTestResults::route('/'),
            'create' => CreateTestResult::route('/create'),
//            'view' => Pages\ViewTestResult::route('/{record}'),
            'edit' => EditTestResult::route('/{record}/edit'),
        ];
    }
}
