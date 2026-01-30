<div class=" max-w-md">
    <h1 class="text-green-500 mb-8 font-bold">Настройки</h1>
    <div class="mb-16">
        <livewire:pages.profile.update-profile-information-form/>
    </div>
    <div class="mb-16">
        <livewire:pages.profile.update-password-form/>
    </div>
    <x-danger-button wire:click.prevent="logout" class="mb-16 w-full text-start">Выйти</x-danger-button>
</div>
