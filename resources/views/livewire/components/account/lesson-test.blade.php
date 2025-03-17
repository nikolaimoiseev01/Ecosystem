<div wire:key="{{$test['id']}}">
    @if($test['lesson_id'])
        <h2 class="mb-2">Тест</h2>
    @else
        <h2 class="mb-2">Финальный тест</h2>
    @endif

    @if($testResults && !$debug)
        <p>Вы успешно прошли тест! Набрали балов: {{$testResults['applicant_points']}}
            из {{$testResults['test_points']}} </p>
    @else
        <div x-data="{
        currentQuestionIndex: 0,
        answers: {},
        totalQuestions: {{ count($questions) }},
        errorMessage: '',
        nextQuestion() {
            const currentAnswers = this.answers[this.currentQuestionIndex];
            if (!currentAnswers || currentAnswers.length === 0) {
                this.errorMessage = 'Выберите ответ';
                return;
            }
            this.errorMessage = '';
            this.currentQuestionIndex++;
        },
        prevQuestion() {
            if (this.currentQuestionIndex > 0) {
               this.currentQuestionIndex--;
               this.errorMessage = '';
            }
        },
    toggleAnswer(questionIndex, answer, isRadio) {
        if (isRadio) {
            // Если это radio, просто записываем одно значение
            this.answers[questionIndex] = [answer];
        } else {
            // Если checkbox, обрабатываем как раньше
            if (!this.answers[questionIndex]) {
                this.answers[questionIndex] = [];
            }

            if (this.answers[questionIndex].includes(answer)) {
                this.answers[questionIndex] = this.answers[questionIndex].filter(a => a !== answer);
            } else {
                this.answers[questionIndex].push(answer);
            }
        }
    },
        saveAnswers() {
            @this.call('saveAnswers', this.answers);
        }
    }">
            @if($test['lesson_id'])
            @else
                <p class="italic mb-2">Если несколько вариантов ответа => 2.5 балла за каждый верный. Если один вариант
                    ответа, то 5 баллов
                    за верный.</p>
            @endif
            @foreach($questions as $index => $question)
                <div x-show="currentQuestionIndex === {{ $index }}" class="question" x-cloak>
                    <h3 class="text-lg">{{ $question['question'] }}</h3>
                    <form action="" @submit.prevent="nextQuestion()">
                        @foreach($question['answers'] as $answer)
                            @if($test['lesson_id'] || $question['multiple_correct_answers'])
                                <div class="flex gap-2 items-center">
                                    <input
                                        type="checkbox"
                                        @change="toggleAnswer({{ $index }}, '{{ $answer['text'] }}')"
                                        id="test_{{$test['id']}}_answer_{{ $index }}_{{ $loop->index }}"
                                        name="question_{{ $index }}"
                                        :value="'{{ $answer['text'] }}'">
                                    <label
                                        for="test_{{$test['id']}}_answer_{{ $index }}_{{ $loop->index }}"
                                        class="text-lg cursor-pointer">
                                        {{ $answer['text'] }}
                                    </label>
                                </div>
                            @else
                                <div class="flex gap-2 items-center">
                                    <input
                                        type="radio"
                                        @change="toggleAnswer({{ $index }}, '{{ $answer['text'] }}')"
                                        id="test_{{$test['id']}}_answer_{{ $index }}_{{ $loop->index }}"
                                        name="question_{{ $index }}"
                                        :value="'{{ $answer['text'] }}'">
                                    <label
                                        for="test_{{$test['id']}}_answer_{{ $index }}_{{ $loop->index }}"
                                        class="text-lg cursor-pointer">
                                        {{ $answer['text'] }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                        <div class="text-red-500 mt-2" x-show="errorMessage" x-text="errorMessage"></div>
                        <div class="flex gap-4 mt-4 items-center">
                            <x-button>Следующий вопрос</x-button>
                            <x-link-simlpe @click.prevent="prevQuestion()" x-show="currentQuestionIndex > 0">Назад
                            </x-link-simlpe>
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
