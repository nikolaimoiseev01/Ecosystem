<?php

namespace App\Livewire\Pages\Account;

use App\Models\Lesson;
use App\Models\Test;
use App\Models\TestResult;
use Livewire\Component;

class LessonsPage extends Component
{
    public $lessons;
    public $final_test;
    public $user;

    protected $listeners = ['refreshLessonsPage' => '$refresh'];

    public function render()
    {
        $this->lessons = Lesson::orderBy('sort')->get();
        $this->user = \Illuminate\Support\Facades\Auth::user();


        /* Логика доступа на основе тестов */

        $this->lessons = $this->lessons->map(function ($lesson) { // Сначала все недоступны
            $lesson->setAttribute('is_available', false);
            return $lesson;
        });

        foreach ($this->lessons as $index => $lesson) { /* Понимаем, проходили ли тест прошлоко урока */
            if ($index === 0) {
                $lesson->setAttribute('is_available', True);
            } else {
                $prevLessonTest = Test::where('lesson_id', $this->lessons[$index - 1]['id'])->first() ?? null;
                $prevLessonTestResult = TestResult::where('user_id', $this->user['id'])
                    ->where('lesson_id', $this->lessons[$index - 1]['id'])->first() ?? null;
                if ($prevLessonTest && !$prevLessonTestResult) {
                    break;
                } else {
                    $lesson->setAttribute('is_available', True);
                }
            }

        }

        $this->final_test = Test::where('lesson_id', null)->first() ?? null;
        return view('livewire.pages.account.lessons-page')->layout('layouts.account', ['page_title' => 'Уроки']);
    }
}
