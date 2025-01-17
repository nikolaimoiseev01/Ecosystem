<?php

namespace App\Livewire\Pages\Portal;

use App\Models\Lesson;
use Livewire\Component;

class IndexPage extends Component
{
    public $lessons;

    public function render()
    {
        $this->lessons = Lesson::all();
        return view('livewire.pages.portal.index-page');
    }
}
