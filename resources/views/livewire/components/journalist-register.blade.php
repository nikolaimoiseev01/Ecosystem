<form wire:submit="register()" class="max-w-4xl mx-auto" action="">
    <h1 class="mb-4">Регистрация журналистов</h1>
    <div class="flex flex-col gap-4">

        <div class="w-full">
            <x-text-input placeholder="Название СМИ" wire:model="smi_name" id="smi_name" class="block mt-1 w-full"
                          type="text"
                          name="smi_name"
                          required autofocus autocomplete="smi_name"/>
            <x-input-error :messages="$errors->get('smi_name')" class="mt-2"/>
        </div>
        <div class="w-full">
            <x-text-input placeholder="ФИО" wire:model="fio" id="fio" class="block mt-1 w-full" type="text"
                          name="fio"
                          required autofocus autocomplete="fio"/>
            <x-input-error :messages="$errors->get('fio')" class="mt-2"/>
        </div>
        <div class="w-full">
            <x-text-input placeholder="Должность" wire:model="position" id="position" class="block mt-1 w-full"
                          type="text"
                          name="position"
                          required autofocus autocomplete="position"/>
            <x-input-error :messages="$errors->get('position')" class="mt-2"/>
        </div>
        <div class="flex-1">
            <x-input-label for="telephone"/>
            <x-text-input wire:model="telephone" id="telephone"
                          class="block mt-1 w-full mobile_input"
                          placeholder="Телефон (8 (123) 456 7890)"
                          type="text"
                          name="telephone" autocomplete="telephone"/>
        </div>
        <div class="flex-1 flex flex-col">
            <x-textarea wire:model="comment"
                        placeholder="Комментарий (необязательно"
                        class="w-full h-full"/>
            <x-input-error :messages="$errors->get('comment')" class="mt-2"/>
        </div>
        <x-button type="submit" class="">
            {{ __('Зарегистрироваться') }}
        </x-button>
    </div>
</form>
