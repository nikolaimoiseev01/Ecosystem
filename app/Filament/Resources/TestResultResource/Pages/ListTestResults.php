<?php

namespace App\Filament\Resources\TestResultResource\Pages;

use App\Filament\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestResults extends ListRecords
{
    protected static string $resource = TestResultResource::class;
    protected static ?string $title = "Результаты тестов";

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
