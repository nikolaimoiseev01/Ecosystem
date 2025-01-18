<div wire:key="{{$test['id']}}">
    <h2 class="mb-2">Тест</h2>
    @if($testResults)
        <p>Вы успешно прошли тест! Набрали балов: {{$testResults['applicant_correct_answers']}}
            из {{$testResults['total_correct_answers']}} </p>
    @else
        <div x-data="{
        currentQuestionIndex: 0,
        answers: {},
        totalQuestions: {{ count($questions) }},
        nextQuestion() {
            this.currentQuestionIndex++;
        },
        prevQuestion() {
            if (this.currentQuestionIndex > 0) {
               this.currentQuestionIndex--;
            }
        },
        toggleAnswer(questionIndex, answer) {
            if (!this.answers[questionIndex]) {
                this.answers[questionIndex] = [];
            }

            if (this.answers[questionIndex].includes(answer)) {
                // Если ответ уже есть, удаляем его
                this.answers[questionIndex] = this.answers[questionIndex].filter(a => a !== answer);
            } else {
                // Иначе добавляем ответ
                this.answers[questionIndex].push(answer);
            }
        },
        saveAnswers() {
            @this.call('saveAnswers', this.answers);
        }
    }">
            @foreach($questions as $index => $question)
                <div x-show="currentQuestionIndex === {{ $index }}" class="question" x-cloak>
                    <h3 class="text-lg">{{ $question['question'] }}</h3>
                    <form action="" @submit.prevent="nextQuestion()">
                        @foreach($question['answers'] as $answer)
                            <div class="flex gap-2 items-center">
                                <input
                                    @if($question['multiple_correct_answers'])
                                        type="checkbox"
                                    @else
                                        required
                                    type="radio"
                                    @endif
                                    @change="toggleAnswer({{ $index }}, '{{ $answer['text'] }}')"
                                    id="answer_{{ $index }}_{{ $loop->index }}"
                                    name="question_{{ $index }}"
                                    :value="'{{ $answer['text'] }}'">
                                <label
                                    for="answer_{{ $index }}_{{ $loop->index }}"
                                    class="text-lg cursor-pointer">
                                    {{ $answer['text'] }}
                                </label>
                            </div>
                        @endforeach
                        <div class="flex gap-4 mt-4 items-center">
                            <x-button>Следующий вопрос</x-button>
                            <x-link-simlpe @click.prevent="prevQuestion()"  x-show="currentQuestionIndex > 0">Назад</x-link-simlpe>
                        </div>

                    </form>
                </div>
            @endforeach

            <div x-show="currentQuestionIndex === totalQuestions" class="completion" x-cloak>
                <h3>На этом все!</h3>
                <x-button
                    @click="saveAnswers()"
                    class="mt-4">
                    Сохранить ответы
                </x-button>
            </div>
        </div>
    @endif
</div>
