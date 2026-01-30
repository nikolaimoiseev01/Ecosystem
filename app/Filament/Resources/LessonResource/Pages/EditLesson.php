<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLesson extends EditRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('lesson_page')
                ->label('Страница урока')
                ->url(fn() => route('account.course', $this->record->id)),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return $this->record['name'];
    }
}
