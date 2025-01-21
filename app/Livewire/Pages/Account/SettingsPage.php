<?php

namespace App\Livewire\Pages\Account;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SettingsPage extends Component
{
    public function render()
    {
        return view('livewire.pages.account.settings-page')->layout('layouts.account', ['page_title' => 'Настройки']);
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}
