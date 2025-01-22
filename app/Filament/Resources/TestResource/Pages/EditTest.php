<?php

namespace App\Filament\Resources\TestResource\Pages;

use App\Filament\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditTest extends EditRecord
{
    use HasPreviewModal;
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            PreviewAction::make()->label('Предпросмотр'),

        ];
    }

    protected function getPreviewModalUrl(): ?string
    {
        // Generate a unique token for this preview
        $test = $this->previewModalData['record'];
        $testId = $this->previewModalData['record']->id ?: uniqid();
        $userId = auth()->user()->id;
        $token = md5("test-{$testId}-{$userId}");

        // Store the preview data in the cache to be retrieved from the controller
        cache()->put("preview-{$token}", $this->previewModalData, 5 * 60); // 5 minutes

        // Return the preview URL
        return route('preview-test', $token);
    }
}
