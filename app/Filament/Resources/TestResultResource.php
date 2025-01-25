<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResultResource\Pages;
use App\Filament\Resources\TestResultResource\RelationManagers;
use App\Models\TestResult;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TestResultResource extends Resource
{
    protected static ?string $model = TestResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = "Тестирование";
    protected static ?string $navigationLabel = 'Результаты';

    public static function infolist(Infolist $infolist): infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('result')
                    ->getStateUsing(function (TestResult $testResult): string {
                        return getUserFullName($testResult->user);
                    })
                    ->label('Пользователь'),
                TextEntry::make('lesson.name')
                    ->label('Тест для урока')
                    ->numeric(),
                TextEntry::make('applicant_points')
                    ->label('Пользователь набрал баллов')
                    ->numeric(),
                TextEntry::make('questions_number')
                    ->label('Всего вопросов')
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Имя пользователя')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lesson.name')
                    ->label('Тест для урока')
                    ->searchable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('questions_number')
                    ->label('Вопросов в тесте')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('applicant_points')
                    ->label('Правильных ответов')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Создан')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordUrl(
                fn (Model $record): string => '',
            )
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListTestResults::route('/'),
            'create' => Pages\CreateTestResult::route('/create'),
//            'view' => Pages\ViewTestResult::route('/{record}'),
            'edit' => Pages\EditTestResult::route('/{record}/edit'),
        ];
    }
}
