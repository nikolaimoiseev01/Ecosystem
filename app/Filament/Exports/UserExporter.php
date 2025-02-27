<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('login')->label('Логин'),
            ExportColumn::make('email'),
            ExportColumn::make('region')->label('Регион'),
            ExportColumn::make('name')->label('Имя'),
            ExportColumn::make('surname')->label('Фамилия'),
            ExportColumn::make('thirdname')->label('Отчество'),
            ExportColumn::make('birth_dt')->label('Дата рождения'),
            ExportColumn::make('telegram'),
            ExportColumn::make('type_of_activity')->label('Род деятельности'),
            ExportColumn::make('eco_part')->label('Участие в организациях'),
            ExportColumn::make('workplace')->label('Место работы'),
            ExportColumn::make('volunteer_experience')->label('Волонтерский опыт'),
            ExportColumn::make('telephone')->label('Телефон'),
            ExportColumn::make('created_at')->label('Создан'),
            ExportColumn::make('updated_at')->label('Обновлен'),
            ExportColumn::make('has_points')
                ->label('Набранно балов')
                ->state(function (User $record): float {
                    $has_points = $record->testResult->sum('applicant_points');
                    return $has_points;
                }),
            ExportColumn::make('has_tests')
                ->label('Пройдено тестов')
                ->state(function (User $record): float {
                    $has_tests = $record->testResult->count();
                    return $has_tests;
                })
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
