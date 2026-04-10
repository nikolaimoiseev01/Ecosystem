<?php

namespace App\Filament\Resources\TestResultResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\TestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestResult extends EditRecord
{
    protected static string $resource = TestResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
