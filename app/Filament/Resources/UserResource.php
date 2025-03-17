<?php

namespace App\Filament\Resources;

use App\Filament\Exports\UserExporter;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Test;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Пользователи';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('login')
                        ->label('Логин')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('name')
                        ->label('Имя')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('surname')
                        ->label('Фамилия')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('thirdname')
                        ->label('Отчество')
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('birth_dt')->label('Дата рождения'),
                    Forms\Components\TextInput::make('telegram')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('type_of_activity')->label('Род деятельности')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('eco_part')->label('Участие в организациях')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('workplace')->label('Место работы')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('volunteer_experience')->label('Волонтерский опыт')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('telephone')->label('Телефон')
                        ->maxLength(255),
                    Forms\Components\DateTimePicker::make('created_at')->label('Создан'),
                    Forms\Components\Placeholder::make('has_points')
                        ->label('Набранно балов:')
                        ->content(function (User $record) {
                            $has_points = $record->testResult->sum('applicant_points');
                            $total_points = $record->testResult->sum('questions_number');
                            $text = "{$has_points}/$total_points";
                            return $text;
                        }),
                    Forms\Components\Placeholder::make('has_tests')
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
                Tables\Columns\TextColumn::make('login')
                    ->label('Логин')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Фамилия')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thirdname')
                    ->label('Отчество')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_dt')
                    ->label('Дата рождения')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telegram')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_of_activity')
                    ->label('Вид деятельности')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('eco_part')
                    ->label('Экологическое участие')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('workplace')
                    ->label('Место работы')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('volunteer_experience')
                    ->label('Опыт волонтерства')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Телефон')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
