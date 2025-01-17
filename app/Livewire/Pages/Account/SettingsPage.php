<?php

namespace App\Livewire\Pages\Account;

use Livewire\Component;

class SettingsPage extends Component
{
    public function render()
    {
        return view('livewire.pages.account.settings-page')->layout('layouts.account', ['page_title' => 'Настройки']);
    }
}
