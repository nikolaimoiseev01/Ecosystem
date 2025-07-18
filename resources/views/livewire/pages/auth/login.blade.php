<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.portal')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(route('account.courses'), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form wire:submit="login" class="flex flex-col w-full max-w-lg gap-4 mx-auto items-center">
        <!-- Email Address -->
        <div class="w-full">
            <x-text-input placeholder="Email" wire:model="form.email" id="email" class="block mt-1 w-full" type="email"
                          name="email"
                          required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="w-full">
            <x-text-input placeholder="Пароль" wire:model="form.password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end w-full">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                       class="rounded  border-gray-300  text-green-500 shadow-sm focus:ring-none"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600 whitespace-nowrap">{{ __('Запомнить меня') }}</span>
            </label>
            <x-button class="ms-3 w-full">
                {{ __('Войти') }}
            </x-button>
        </div>

        <div class="flex gap-8">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Забыли пароль?') }}
                </a>
            @endif
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('register') }}" wire:navigate>
                {{ __('Регистрация') }}
            </a>
        </div>

    </form>

</div>
