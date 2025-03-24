<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->url(fn(User $record): string => "/admin/test-results?tableFilters[user][value]={$record['id']}")
                ->label('Все ответы пользователя'),
            Action::make('edit')
                ->action(function($record) {
                    Auth::loginUsingId($record['id']);
                    return redirect()->route('account.courses');
                })
                ->label('Войти в его аккаунт'),
            Actions\DeleteAction::make()
                ->label('Удалить пользователя'),
        ];
    }

    public function getTitle(): string
    {
        return getUserFullName($this->record);
    }
}
