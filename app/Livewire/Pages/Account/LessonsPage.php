<?php

namespace App\Livewire\Pages\Account;

use App\Models\Lesson;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as AuthAlias;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\LaravelPdf\Enums\Format;
//use Spatie\LaravelPdf\Facades\Pdf;

class LessonsPage extends Component
{
    public $lessons;
    public $final_test;
    public $user;
    public $final_test_flg_check;

    protected $listeners = ['refreshLessonsPage' => '$refresh'];

    public function render()
    {
        $this->lessons = Lesson::orderBy('sort')->get();
        $this->user = AuthAlias::user();


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
        $this->final_test_flg_check = TestResult::where('user_id', $this->user['id'])
            ->where('test_id', 9)
            ->exists();
        $this->final_test = Test::where('lesson_id', null)->first() ?? null;
        return view('livewire.pages.account.lessons-page')->layout('layouts.account', ['page_title' => 'Уроки']);
    }

    public function downloadDiploma() {

        $user = Auth::user();
        $user_fio = "{$user['surname']} {$user['name']} {$user['thirdname']}";
        $user_points =$user->testResult->sum('applicant_points');
        if ($user_points > 90) {
            $type = 'финалистом';
        } else {
            $type = 'участником';
        }

        // Генерируем случайное имя
        $fileName = Str::random(16) . '.pdf';
        $filePath = storage_path('app/' . $fileName); // используем временное хранилище

//        $pdf = App::make('dompdf.wrapper');
//        $html = '<h1>Test</h1>';
//        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
//        $pdf->loadHTML($html);
//        dd($pdf);
//        return $pdf->stream();


        // Генерируем PDF
        Pdf::loadView('layouts.diploma', ['fio' => $user_fio, 'type' => $type])
            ->save($filePath);

        // Отдаём пользователю и удаляем файл после отправки
        return response()->download($filePath, 'diploma.pdf')->deleteFileAfterSend(true);

    }
}
