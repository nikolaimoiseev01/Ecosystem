<div {{ $attributes->merge(['class' => 'relative inline-block']) }}>
    <select wire:model.live="{{$model}}"
            class="border w-full rounded py-2 pr-10 text-lg text-black focus:outline-none focus:ring-0 "
    >

        @if($alltext)
            <option value="999">{{$alltext}}</option>
        @endif
        @foreach($options as $option)
            <option value="{{$option['id']}}">{{$option['name']}}</option>
        @endforeach
    </select>
</div>
