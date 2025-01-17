<?php

namespace App\Livewire\Pages\Account;

use App\Models\Lesson;
use Livewire\Component;

class LessonsPage extends Component
{
    public $lessons;
    public function render()
    {
        $this->lessons = Lesson::all();
        return view('livewire.pages.account.lessons-page')->layout('layouts.account', ['page_title' => 'Уроки']);
    }
}
