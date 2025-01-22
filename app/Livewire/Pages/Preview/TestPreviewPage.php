<?php

namespace App\Livewire\Pages\Preview;

use App\Models\Test;
use Livewire\Component;

class TestPreviewPage extends Component
{
    public $test;
    public function render()
    {
        return view('livewire.pages.preview.test-preview-page')->layout('layouts.preview');
    }

    public function mount($token) {
        $previewData = cache("preview-{$token}");
        abort_unless($previewData, 404);
        $this->test = $previewData['record'];
    }
}
