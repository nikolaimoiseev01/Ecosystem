<?php

namespace App\Livewire\Components\Account;

use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LessonTest extends Component
{
    public $test;
    public $questions;
    public $testResults;
    public $user;

    public function render()
    {
        $user = Auth::user();

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

//        dd($applicant_answers);
        // Обработка вопросов
        foreach ($this->questions as $questionIndex => $question) {
            $userAnswers = $applicant_answers[$questionIndex] ?? []; // Ответы пользователя для текущего вопроса

            // Подсчет правильных ответов в массиве вопроса
            $totalCorrectAnswers = count(array_filter($question['answers'], function ($answer) {
                return $answer['correct_flg'] === true;
            }));

            // Собираем массив applicant_answer
            $applicantAnswerDetails = [];
            $applicantCorrectAnswers = 0;

            foreach ($userAnswers as $userAnswer) {
                $isCorrect = false;

                // Проверяем, есть ли ответ пользователя среди правильных
                foreach ($question['answers'] as $answer) {
                    if ($answer['text'] === $userAnswer) {
                        $isCorrect = $answer['correct_flg'];
                        if ($isCorrect) {
                            $applicantCorrectAnswers++; // Увеличиваем счетчик правильных ответов пользователя
                        }
                        break;
                    }
                }

                // Добавляем ответ пользователя и правильность в массив
                $applicantAnswerDetails[] = [
                    'text' => $userAnswer,
                    'is_correct' => $isCorrect,
                ];
            }

            // Добавляем данные к текущему вопросу
            $question['applicant_answer'] = $applicantAnswerDetails;
            $question['total_correct_answers'] = $totalCorrectAnswers;
            $question['applicant_correct_answers'] = $applicantCorrectAnswers;
            $question['flg_question_answered_correct'] = ($question['total_correct_answers'] == $question['applicant_correct_answers']);

            $result[] = $question;
        }

        $questions_number = collect($result)->count();
        $applicant_points = collect($result)->where('flg_question_answered_correct', True)->count();

        DB::transaction(function () use ($questions_number, $applicant_points, $result) {
            $testResult = TestResult::create([
                'user_id' => Auth::user()->id,
                'test_id' => $this->test['id'],
                'lesson_id' => $this->test->lesson['id'],
                'questions_number' => $questions_number,
                'applicant_points' => $applicant_points,
                'result' => json_encode($result),
            ]);
        });


        $this->dispatch('refreshLessonsPage');

        $this->dispatch('swal:modal',
            title: 'Успешно',
            type: 'success',
            text: "Тест завершен. Вы набрали $applicant_points из $questions_number балов"
        );


    }
}
