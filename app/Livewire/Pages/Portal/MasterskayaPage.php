<?php

namespace App\Livewire\Pages\Portal;

use App\Models\Lesson;
use Livewire\Component;

class MasterskayaPage extends Component
{
    public $lessons;
    public function render()
    {
        $this->lessons = Lesson::orderBy('sort')->get();
        return view('livewire.pages.portal.masterskaya-page');
    }
}
