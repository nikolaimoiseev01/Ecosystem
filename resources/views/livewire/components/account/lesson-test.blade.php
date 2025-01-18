<div>
    <h2>Тест</h2>
    <div x-data="{
        currentQuestionIndex: 0,
        answers: {},
        totalQuestions: {{ count($questions) }},
        nextQuestion() {
            this.currentQuestionIndex++;
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
                <h3>{{ $question['question'] }}</h3>
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
                    <button
                        class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
                        Next
                    </button>
                </form>
            </div>
        @endforeach

        <div x-show="currentQuestionIndex === totalQuestions" class="completion" x-cloak>
            <h3>Thank you for completing the test!</h3>
            <button
                @click="saveAnswers()"
                class="mt-4 px-4 py-2 bg-green-500 text-white rounded">
                Save Answers
            </button>
        </div>
    </div>
</div>
