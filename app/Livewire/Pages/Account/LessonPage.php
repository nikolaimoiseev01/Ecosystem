<?php

namespace App\Livewire\Pages\Account;

use App\Models\Lesson;
use Livewire\Component;

class LessonPage extends Component
{
    public $lesson;
    public function render()
    {
        return view('livewire.pages.account.lesson-page')->layout('layouts.account', ['page_title' => "{$this->lesson->module->name}. {$this->lesson->name}"]);
    }

    public function mount($id) {
        $this->lesson = Lesson::query()->where('id', $id)->with('module')->first();
    }
}
