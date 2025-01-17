<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.portal')] class extends Component {
    public string $name = '';
    public string $surname = '';
    public string $thirdname = '';
    public string $birth_dt = '';
    public string $login = '';
    public string $email = '';
    public string $password = '';
    public string $telegram = '';
    public string $type_of_activity = '';
    public string $eco_part = '';
    public string $workplace = '';
    public string $volunteer_experience = '';
    public string $telephone = '';
    public string $password_confirmation = '';


    /**
     * Handle an incoming registration request.
     */

    public array $types_of_activity = [
        [
            'id' => 1,
            'name' => 'Студент',
        ],
        [
            'id' => 2,
            'name' => 'Наемный сотрудник',
        ],
        [
            'id' => 3,
            'name' => 'Пенсионер',
        ]
    ];

    public array $volunteer_exps = [
        [
            'id' => 1,
            'name' => 'Да, в НКО',
        ],
        [
            'id' => 2,
            'name' => 'Да, в Движении "Экосистема',
        ],
        [
            'id' => 3,
            'name' => 'Да, в студенческом экологическом клубе',
        ],
        [
            'id' => 4,
            'name' => 'Нет, не состою',
        ]
    ];

    public function register(): void
    {

        $validated = $this->validate([
            'login' => ['required', 'string', 'lowercase', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'thirdname' => ['required', 'string', 'max:255'],
            'birth_dt' => ['required', 'string'],
            'telegram' => ['required', 'string', 'max:255'],
            'type_of_activity' => ['required', 'string', 'max:255'],
            'eco_part' => ['required', 'string', 'max:255'],
            'workplace' => ['required', 'string', 'max:255'],
            'volunteer_experience' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<main class="flex-1">

    <style>
        .form-saver {
            display: none;
            visibility: hidden;
        }

        .js-form-saver .form-saver {
            display: block;
            visibility: visible;
        }
    </style>
    <script src="/fixed/form-saver.js"></script>

    <h1 class="mx-auto mb-8"><span class="text-green-500">РЕГИСТРАЦИЯ</span> УЧАСТНИКА</h1>
    <div class="content mb-32">
        <form id="form-id" wire:submit="register" class="max-w-3xl mx-auto flex flex-col gap-4">
            <div class="flex gap-8">

                <div class="flex-1">
                    <x-input-label for="login" :value="__('Логин')"/>
                    <x-text-input wire:model="login" id="login" class="block mt-1 w-full" type="text" name="login"
                                  required
                                  autofocus autocomplete="login"/>
                    <x-input-error :messages="$errors->get('login')" class="mt-2"/>
                </div>
                <!-- Email Address -->
                <div class="flex-1">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                                  required
                                  autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>
            </div>

            <div class="flex gap-8">
                <div class="flex-1">
                    <x-input-label for="password" :value="__('Пароль')"/>

                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Confirm Password -->
                <div class="flex-1">
                    <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')"/>

                    <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                  class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>
            </div>

            <div class="flex gap-8">

                <div class="flex-1">
                    <x-input-label for="name" :value="__('Имя')"/>
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                                  autofocus autocomplete="name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>
                <div class="flex-1">
                    <x-input-label for="surname" :value="__('Фамилия')"/>
                    <x-text-input wire:model="surname" id="surname" class="block mt-1 w-full" type="text" name="surname"
                                  required
                                  autofocus autocomplete="surname"/>
                    <x-input-error :messages="$errors->get('surname')" class="mt-2"/>
                </div>

            </div>

            <div class="flex gap-8">
                <div class="flex-1">
                    <x-input-label for="thirdname" :value="__('Отчество')"/>
                    <x-text-input wire:model="thirdname" id="thirdname" class="block mt-1 w-full" type="text"
                                  name="thirdname" required
                                  autocomplete="thirdname"/>
                    <x-input-error :messages="$errors->get('thirdname')" class="mt-2"/>
                </div>

                <div class="flex-1">
                    <x-input-label for="telegram" :value="__('Дата рождения')"/>
                    <x-text-input wire:model="birth_dt" id="birth_dt" class="block mt-1 w-full" type="date"
                                  name="birth_dt" required
                                  autocomplete="birth_dt"/>
                    <x-input-error :messages="$errors->get('birth_dt')" class="mt-2"/>
                </div>
            </div>

            <div class="flex gap-8">
                <div class="flex-1">
                    <x-input-label for="telegram" :value="__('Ник в телеграм')"/>
                    <x-text-input wire:model="telegram" id="telegram" class="block mt-1 w-full" type="text"
                                  name="telegram" required
                                  autofocus autocomplete="telegram"/>
                    <x-input-error :messages="$errors->get('telegram')" class="mt-2"/>
                </div>
                <div class="flex-1">
                    <x-input-label for="workplace" :value="__('Полное название места работы или учебы')"/>
                    <x-text-input wire:model="workplace" id="workplace" class="block mt-1 w-full" type="text"
                                  name="workplace" required
                                  autocomplete="workplace"/>
                    <x-input-error :messages="$errors->get('workplace')" class="mt-2"/>
                </div>
            </div>

            <div class="flex gap-8">
                <div class="flex flex-col flex-1 gap-4">
                    <div class="flex-1">
                        <x-input-label for="telegram" :value="__('Ник в телеграм')"/>
                        <x-dropdown-select
                            class="w-full"
                            model="type_of_activity"
                            :options="$types_of_activity"
                        />
                        <x-input-error :messages="$errors->get('type_of_activity')" class="mt-2"/>
                    </div>
                    <div class="flex-1">
                        <x-input-label for="telegram"
                                       :value="__('Состоите ли вы в экологической общественной организации?')"/>
                        <x-dropdown-select
                            class="w-full"
                            model="volunteer_experience"
                            :options="$volunteer_exps"
                        />
                        <x-input-error :messages="$errors->get('volunteer_experience')" class="mt-2"/>
                    </div>
                </div>
                <div class="flex-1">
                    <textarea
                        wire:model="eco_part"
                        placeholder="Расскажите о своём опыте в волонтерской или просветительской деятельности в сфере экологии"
                        class="rounded w-full h-full"></textarea>
                </div>

            </div>

            <div class="flex-1">
                <x-input-label for="telephone" :value="__('Телефон')"/>

                <x-text-input wire:model="telephone" id="telephone"
                              class="block mt-1 w-full"
                              type="text"
                              name="telephone" required autocomplete="telephone"/>

                <x-input-error :messages="$errors->get('telephone')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('login') }}" wire:navigate>
                    {{ __('Войти') }}
                </a>

                <x-button type="submit" class="ms-4">
                    {{ __('Зарегестрироваться') }}
                </x-button>
            </div>


        </form>


    </div>
</main>
