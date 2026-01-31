<div>
    <style>
        .attachment__caption {
            display: none;
        }
    </style>
    <div class="flex justify-between mb-8">
        <h1 class="text-green-500 font-bold">{{$lesson->name}}</h1>
        <div class="flex gap-8">
            <x-ui.link-simple href="{{route('account.courses')}}">К оглавлению</x-ui.link-simple>
            <x-ui.link-simple href="{{route('account.course', $lesson->id + 1)}}">Следующий урок</x-ui.link-simple>
        </div>
    </div>
    <h2 class="font-medium text-black mb-8">{{$lesson->title}}</h2>
    <section>
        {!! $lesson->content !!}
    </section>
</div>
