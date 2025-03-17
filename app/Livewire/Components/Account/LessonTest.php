<?php

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
        $result = [];
//        dd($this->questions);

        // Проходим по каждому вопросу
        foreach ($this->questions as $qIndex => &$question) {
            foreach ($question['answers'] as &$answer) {
                // Проверяем, содержит ли ответы пользователя текущий ответ
                $answer['answered_correct'] = in_array($answer['text'], $applicant_answers[$qIndex]);
            }
            // Извлекаем правильные ответы из массива answers
            $correctAnswers = array_map(function ($answer) {
                return $answer['correct_flg'] ? $answer['text'] : null;
            }, $question['answers']);

            // Удаляем null из массива правильных ответов
            $correctAnswers = array_filter($correctAnswers);

            // Сравниваем правильные ответы с ответами пользователя
            $userAnswerSet = $applicant_answers[$qIndex];

            // Проверяем на полное совпадение
            $question['answered_correct'] = empty(array_diff($correctAnswers, $userAnswerSet)) && empty(array_diff($userAnswerSet, $correctAnswers));

            unset($answer); // На всякий случай для избежания ошибок ссылок
        }
        unset($question);


        if ($this->test['lesson_id']) {
            $test_points = collect($this->questions)->count();
            $applicant_points = collect($this->questions)->where('answered_correct', True)->count();
        } else {

            $test_points = 0;

            foreach ($this->questions as $qIndex => &$question) {
                $question_score = 0;
                if ($question['multiple_correct_answers']) {
                    // Если вопрос с несколькими правильными ответами,
                    // то за каждый ответ, где значение chosen_by_user совпадает с correct_flg, даем 2.5 балла.
                    $add_points = 2.5;
                } else {
                    $add_points = 5;
                }
                foreach ($question['answers'] as $answer) {
                    if ($answer['correct_flg']) {
                        $test_points += $add_points;
                    }
                    if ($answer['answered_correct'] === $answer['correct_flg'] && $answer['correct_flg']) {
                        $question_score += $add_points;
                    }
                    if ($answer['answered_correct'] && !$answer['correct_flg']) {
                        $question_score -= $add_points;
                    }
                }
                $question['question_score'] = max(0, $question_score);
            }
            $applicant_points = collect($this->questions)->sum('question_score');
        };

//        dd($this->questions, $test_points, $applicant_points);

        if (!$this->debug) {

            DB::transaction(function () use ($test_points, $applicant_points, $result) {
                $testResult = TestResult::create([
                    'user_id' => Auth::user()->id,
                    'test_id' => $this->test['id'],
                    'lesson_id' => $this->test->lesson ? $this->test->lesson['id'] : null,
                    'test_points' => $test_points,
                    'applicant_points' => $applicant_points,
                    'result' => json_encode($this->questions),
                ]);
            });
            $this->dispatch('refreshLessonsPage');
        }

        $this->dispatch('swal:modal',
            title: 'Успешно',
            type: 'success',
            text: "Тест завершен. Вы набрали $applicant_points из $test_points балов"
        );


    }
}
