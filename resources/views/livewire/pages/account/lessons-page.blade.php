<div>
    <div class="mb-16">
        <h2>Результаты тестов</h2>
        @foreach(\Illuminate\Support\Facades\Auth::user()->testResult as $testResult)
            <div class="flex flex-col p-8 bg-gray-300 rounded-xl">
                В тесте {{$testResult['id']}} набрал баллов: {{$testResult['applicant_correct_answers']}}
                из {{$testResult['total_correct_answers']}}
            </div>
        @endforeach
    </div>
    <div class="flex flex-col gap-8 mb-32">
        @foreach($lessons as $lesson)
            <div class="flex flex-col p-8 bg-gray-300 rounded-xl">
                <h2 class="text-green-500 text-2xl">{{$lesson->module['name']}}. {{$lesson['name']}}</h2>
                <p class="font-bold mb-6">{{$lesson->module['title']}}</p>
                <p>{{$lesson['title']}}</p>
                <p x-show="open" class="mt-2">{{$lesson['desc']}}</p>
                <video controls="" width="100%" height="auto">
                    <source src="{{$lesson->getFirstMediaUrl('video')}}" type="video/mp4">
                </video>

                @if($lesson->test ?? null)
                    <livewire:components.account.lesson-test :test="$lesson->test"/>
                @endif
            </div>
        @endforeach
    </div>

</div>
