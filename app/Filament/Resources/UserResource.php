<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ExportAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Exports\UserExporter;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Test;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Пользователи';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('login')
                        ->label('Логин')
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('name')
                        ->label('Имя')
                        ->maxLength(255),
                    TextInput::make('surname')
                        ->label('Фамилия')
                        ->maxLength(255),
                    TextInput::make('thirdname')
                        ->label('Отчество')
                        ->maxLength(255),
                    DatePicker::make('birth_dt')->label('Дата рождения'),
                    TextInput::make('telegram')
                        ->maxLength(255),
                    TextInput::make('type_of_activity')->label('Род деятельности')
                        ->maxLength(255),
                    TextInput::make('eco_part')->label('Участие в организациях')
                        ->maxLength(255),
                    TextInput::make('workplace')->label('Место работы')
                        ->maxLength(255),
                    TextInput::make('volunteer_experience')->label('Волонтерский опыт')
                        ->maxLength(255),
                    TextInput::make('telephone')->label('Телефон')
                        ->maxLength(255),
                    DateTimePicker::make('created_at')->label('Создан'),
                    Placeholder::make('has_points')
                        ->label('Набранно балов:')
                        ->content(function (User $record) {
                            $has_points = $record->testResult->sum('applicant_points');
                            $total_points = $record->testResult->sum('test_points');
                            $text = "{$has_points}/$total_points";
                            return $text;
                        }),
                    Placeholder::make('has_tests')
                        ->label('Пройдено тестов:')
                        ->content(function (User $record) {
                            $has_tests = $record->testResult->count();
                            $total_tests = Test::count();
                            $text = "{$has_tests}/$total_tests";
                            return $text;
                        })
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('login')
                    ->label('Логин')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                TextColumn::make('surname')
                    ->label('Фамилия')
                    ->searchable(),
                TextColumn::make('thirdname')
                    ->label('Отчество')
                    ->searchable(),
                TextColumn::make('birth_dt')
                    ->label('Дата рождения')
                    ->date()
                    ->sortable(),
                TextColumn::make('test_result_sum_applicant_points')
                    ->sum('testResult', 'applicant_points')
                    ->sortable()
                    ->label('Всего балов'),
                TextColumn::make('test_result_count')
                    ->counts('testResult')
                    ->sortable()
                    ->label('Пройдено тестов'),
                TextColumn::make('telegram')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('type_of_activity')
                    ->label('Вид деятельности')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('eco_part')
                    ->label('Экологическое участие')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('workplace')
                    ->label('Место работы')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('volunteer_experience')
                    ->label('Опыт волонтерства')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('telephone')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Телефон')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Создан')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Экспорт')
                    ->tooltip('Будут скачаны отфильтрованные пользователи')
                    ->exporter(UserExporter::class)
            ])
            ->defaultSort('created_at', 'desc')
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
