<div>
{{--    <div class="mb-16">--}}
{{--        <h2 class="mb-4">Результаты тестов</h2>--}}
{{--        <p>Пройдено тестов: {{$user->testResult->count()}}; Всего--}}
{{--            балов: {{$user->testResult->sum('applicant_points')}}--}}
{{--            из {{$user->testResult->sum('questions_number')}}</p>--}}
{{--    </div>--}}
    <div class="flex flex-col gap-8 mb-32">
        @foreach($lessons as $lesson)
            <div class="flex flex-col p-8 bg-gray-300 rounded-xl">
                <h2 class="text-green-500">{{$lesson->module['name']}}. {{$lesson['name']}}</h2>
                <p class="font-bold mb-6">{{$lesson->module['title']}}</p>
                <p>{{$lesson['title']}}</p>
                @if($lesson['is_available'])
                    <p x-show="open" class="mt-2">{{$lesson['desc']}}</p>
                    @if($lesson->getFirstMediaUrl('video'))
                        <video controls="" width="100%" height="auto">
                            <source src="{{$lesson->getFirstMediaUrl('video')}}" type="video/mp4">
                        </video>
                    @endif
                    @if($lesson->test ?? null)
                        <div class="mt-6">
                            <livewire:components.account.lesson-test wire:key="" :test="$lesson->test"/>
                        </div>
                    @endif
                @else
                    <p class="mt-2 font-bold">Вы не прошли предыдущий тест, поэтому этот урок еще недоступен</p>
                @endif
            </div>
        @endforeach

            <livewire:components.account.lesson-test wire:key="" :test="$final_test"/>
    </div>

</div>
