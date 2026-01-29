<?php

namespace App\Livewire\Pages\Portal;

use App\Enums\ActualityEnums;
use App\Models\Lesson;
use App\Models\Module;
use Livewire\Component;

class IndexPage extends Component
{
    public $modules;

    public function render()
    {
        $this->modules = Module::where('actuality', ActualityEnums::NEW)->with('lessons')->get();
        return view('livewire.pages.portal.index-page');
    }
}
