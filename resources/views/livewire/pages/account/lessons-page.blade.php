<div>
    <h1 class="text-green-500 mb-8 font-bold">Уроки</h1>
    <div class="space-y-4 mb-16">
        @foreach ($modules as $module)
            @php
                $testResult = $module->test?->testResultForUser(Auth::id());
            @endphp
            <div
                x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }"
                class="border rounded-xl bg-white
                            {{ $testResult
                ? 'bg-green-100 border-green-500'
                : ''}}
                "
            >
                {{-- Header --}}
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-4 text-left"
                >
                    <div class="font-semibold">
                        Модуль {{ $loop->iteration }}. {{ $module['title'] }}
                    </div>

                    <div class="flex items-center gap-4">
                        @if($testResult)
                            <span class="text-sm font-bold text-green-500">
                            {{$testResult['applicant_points']}} / {{$testResult['test_points']}} баллов
                        </span>
                        @endif
                        <svg
                            class="w-5 h-5 transition-transform"
                            :class="open ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>

                {{-- Content --}}
                <div
                    x-show="open"
                    x-collapse
                    class="px-6 pb-4 space-y-3"
                >
                    {{-- Lessons --}}
                    @foreach ($module->lessons as $lesson)
                        <div
                            class="flex items-center gap-3 text-sm">
                            @if ($lesson['is_seen'])
                                <span wire:click="markLesson({{$lesson->id}}, 0)"
                                      class="cursor-pointer w-4 h-4 rounded-full border-2 border-green-500 flex items-center justify-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            </span>
                            @else
                                <span wire:click="markLesson({{$lesson->id}}, 1)"
                                      class="cursor-pointer w-4 h-4 rounded-full border border-gray-500"></span>
                            @endif

                            <a wire:navigate href="{{route('account.course', $lesson->id)}}"
                               class="{{ $lesson['completed'] ? 'text-gray-900' : 'text-gray-500' }}">
                                Урок {{ $loop->iteration }}. {{ $lesson['title'] }}
                            </a>
                        </div>
                    @endforeach

                    {{-- Test --}}
                    @if ($module->test)
                        <div
                            x-data="{ open: false }"
                            class="mt-4 rounded-lg border transition-all
            {{ $testResult
                ? 'bg-green-50 border-green-300'
                : 'bg-gray-50 border-gray-200 hover:bg-gray-100 cursor-pointer'
            }}"
                        >
                            {{-- Header --}}
                            <div
                                @if (! $testResult)
                                    @click="open = !open"
                                @endif
                                class="px-4 py-3 flex items-center justify-between"
                            >
                                <div
                                    class="flex items-center gap-3 text-sm font-medium text-gray-800">
                                    {{-- Icon --}}
                                    <svg
                                        class="w-5 h-5 {{ $testResult ? 'text-green-500' : 'text-gray-400' }}"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                                    </svg>

                                    <span>
                    Тест. {{ $module['name'] }}
                                        @if ($testResult)
                                            => Пройден!
                                        @endif
                </span>
                                </div>

                                {{-- Right side --}}
                                @if($testResult)
                                    <span class="text-sm font-medium text-green-500">
                            {{$testResult['applicant_points']}} / {{$testResult['test_points']}} баллов
                        </span>
                                @else
                                    <svg
                                        class="w-4 h-4 text-gray-400 transition-transform"
                                        :class="open ? 'rotate-180' : ''"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                @endif
                            </div>

                            {{-- Collapsible content (only if not completed) --}}
                            @if(!$testResult)
                                <div
                                    x-show="open"
                                    x-collapse
                                    class="px-4 pb-4 pt-2"
                                >
                                    <div wire:ignore>
                                        <livewire:components.account.lesson-test
                                            :test="$module->test"
                                            wire:key="lesson-test-{{ $module->id }}-{{ $module->test->id }}"
                                        />
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        @endforeach
    </div>


    {{--    <div class="mb-16">--}}
    {{--        <h2 class="mb-4">Результаты тестов</h2>--}}
    {{--        <p>Пройдено тестов: {{$user->testResult->count()}}; Всего--}}
    {{--            балов: {{$user->testResult->sum('applicant_points')}}--}}
    {{--            из {{$user->testResult->sum('questions_number')}}</p>--}}
    {{--        </div>--}}
    {{--    <x-button wire:click="downloadDiploma()" class="mb-8 text-lg">Скачать сертификат</x-button>--}}
    {{--    <div class="flex flex-col gap-8 mb-32">--}}
    {{--        @foreach($modules as $module)--}}
    {{--            <div class="flex flex-col p-8 bg-gray-300 rounded-xl">--}}
    {{--                <h2 class="text-green-500">{{$module->module['name']}}. {{$module['name']}}</h2>--}}
    {{--                <p class="font-bold mb-6">{{$module->module['title']}}</p>--}}
    {{--                <p>{{$module['title']}}</p>--}}
    {{--                @if($module['is_available'] || 1==1)--}}
    {{--                    <p x-show="open" class="mt-2">{{$module['desc']}}</p>--}}
    {{--                    @if($module->getFirstMediaUrl('video'))--}}
    {{--                        <video controls="" width="100%" height="auto">--}}
    {{--                            <source src="{{$module->getFirstMediaUrl('video')}}" type="video/mp4">--}}
    {{--                        </video>--}}
    {{--                    @endif--}}
    {{--                    @if($module->test ?? null)--}}
    {{--                        <div class="mt-6">--}}
    {{--                            <p>Прохождение теста уже недоступно</p>--}}
    {{--                            <livewire:components.account.lesson-test wire:key="" :test="$module->test"/>--}}
    {{--                        </div>--}}
    {{--                    @endif--}}
    {{--                @else--}}
    {{--                    <p class="mt-2 font-bold">Вы не прошли предыдущий тест, поэтому этот урок еще недоступен</p>--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--        @endforeach--}}

    {{--        @if($final_test && $final_test_flg_check || 1==1)--}}
    {{--                <p>Прохождение финального теста уже недоступно</p>--}}
    {{--            <livewire:components.account.lesson-test wire:key="" :test="$final_test"/>--}}
    {{--        @endif--}}
    {{--        @if(!$final_test_flg_check)--}}
    {{--            <p>Чтобы получить доступ к финальному тесту, необходимо пройти все тесты уроков. </p>--}}
    {{--        @endif--}}
    {{--    </div>--}}

</div>
