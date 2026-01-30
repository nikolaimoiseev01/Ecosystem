<a {{ $attributes->merge(['class' => 'block w-fit transition hover:text-green-500'])}} wire:navigate>
    {{$slot}}
</a>
