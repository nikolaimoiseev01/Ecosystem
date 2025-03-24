<div>
    {{--    <div class="mb-16">--}}
    {{--        <h2 class="mb-4">Результаты тестов</h2>--}}
    {{--        <p>Пройдено тестов: {{$user->testResult->count()}}; Всего--}}
    {{--            балов: {{$user->testResult->sum('applicant_points')}}--}}
    {{--            из {{$user->testResult->sum('questions_number')}}</p>--}}
{{--        </div>--}}
    <x-button wire:click="downloadDiploma()" class="mb-8 text-lg">Скачать сертификат</x-button>
    <div class="flex flex-col gap-8 mb-32">
{{--        @foreach($lessons as $lesson)--}}
{{--            <div class="flex flex-col p-8 bg-gray-300 rounded-xl">--}}
{{--                <h2 class="text-green-500">{{$lesson->module['name']}}. {{$lesson['name']}}</h2>--}}
{{--                <p class="font-bold mb-6">{{$lesson->module['title']}}</p>--}}
{{--                <p>{{$lesson['title']}}</p>--}}
{{--                @if($lesson['is_available'] || 1==1)--}}
{{--                    <p x-show="open" class="mt-2">{{$lesson['desc']}}</p>--}}
{{--                    @if($lesson->getFirstMediaUrl('video'))--}}
{{--                        <video controls="" width="100%" height="auto">--}}
{{--                            <source src="{{$lesson->getFirstMediaUrl('video')}}" type="video/mp4">--}}
{{--                        </video>--}}
{{--                    @endif--}}
{{--                    @if($lesson->test ?? null)--}}
{{--                        <div class="mt-6">--}}
{{--                            <p>Прохождение теста уже недоступно</p>--}}
{{--                            <livewire:components.account.lesson-test wire:key="" :test="$lesson->test"/>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @else--}}
{{--                    <p class="mt-2 font-bold">Вы не прошли предыдущий тест, поэтому этот урок еще недоступен</p>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        @endforeach--}}

        @if($final_test && $final_test_flg_check || 1==1)
{{--                <p>Прохождение финального теста уже недоступно</p>--}}
{{--            <livewire:components.account.lesson-test wire:key="" :test="$final_test"/>--}}
        @endif
{{--        @if(!$final_test_flg_check)--}}
{{--            <p>Чтобы получить доступ к финальному тесту, необходимо пройти все тесты уроков. </p>--}}
{{--        @endif--}}
    </div>

</div>
