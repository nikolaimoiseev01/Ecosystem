<?php /** @noinspection ALL */

namespace App\Livewire\Components\Account;

use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LessonTest extends Component
{
    public $debug = False;
    public $test;
    public $questions;
    public $testResults;
    public $user;

    public function render()
    {
        $user = Auth::user();

//        dd($this->test->testResultForUser(Auth::id()));

        $this->testResults = $this->test->testResultForUser(Auth::id());
        // Делаем флаг, если верных ответов несколько
        $this->questions = $this->test['questions'];
        $newQuestions = []; // Новый массив для обновленных вопросов
        foreach ($this->questions as &$question) {
            // Подсчёт количества правильных ответов
            $correctAnswersCount = array_reduce($question['answers'], function ($count, $answer) {
                return $count + ($answer['correct_flg'] ? 1 : 0);
            }, 0);

            // Установка флага multiple_correct_answers
            $question['multiple_correct_answers'] = $correctAnswersCount > 1;
            unset($question); // Удаление ссылки
        }
        return view('livewire.components.account.lesson-test');
    }

    public function saveAnswers($applicant_answers)
    {
        // Общее количество баллов = количество вопросов
        $test_points = count($this->questions);
        $applicant_points = 0;

        foreach ($this->questions as $qIndex => &$question) {

            // Все правильные ответы для вопроса
            $correctAnswers = collect($question['answers'])
                ->where('correct_flg', true)
                ->pluck('text')
                ->values()
                ->all();

            // Ответы пользователя (на случай, если вопрос пропущен)
            $userAnswers = $applicant_answers[$qIndex] ?? [];

            // Приводим массивы к сопоставимому виду
            sort($correctAnswers);
            sort($userAnswers);

            // Полное совпадение = правильный ответ
            $question['answered_correct'] = ($correctAnswers === $userAnswers);

            if ($question['answered_correct']) {
                $applicant_points++;
            }

            // Отметим каждый ответ — нужно для UI / сохранения результата
            foreach ($question['answers'] as &$answer) {
                $answer['answered_correct'] = in_array($answer['text'], $userAnswers, true);
            }
            unset($answer);
        }
        unset($question);

        if (! $this->debug) {
            DB::transaction(function () use ($test_points, $applicant_points) {
                $result = TestResult::create([
                    'user_id' => Auth::id(),
                    'test_id' => $this->test['id'],
                    'lesson_id' => $this->test->lesson?->id,
                    'module_id' => $this->test->module?->id,
                    'test_points' => $test_points,
                    'applicant_points' => $applicant_points,
                    'result' => json_encode($this->questions),
                ]);
            });
        }

        $this->dispatch('swal:modal',
            title: 'Успешно',
            type: 'success',
            text: "Тест завершен. Вы набрали {$applicant_points} из {$test_points} баллов"
        );


    }

}
