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
            <div class="flex gap-8 md:flex-col">

                <div class="flex-1">
                    <x-input-label for="login" :value="__('Логин')"/>
                    <x-text-input required wire:model="login" id="login" class="block mt-1 w-full" type="text" name="login"

                                  autofocus autocomplete="login"/>
                    <x-input-error :messages="$errors->get('login')" class="mt-2"/>
                </div>
                <!-- Email Address -->
                <div class="flex-1">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input required wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"

                                  autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>
            </div>

            <div class="flex gap-8 md:flex-col">
                <div class="flex-1">
                    <x-input-label for="password" :value="__('Пароль')"/>

                    <x-text-input required wire:model="password" id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                   autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Confirm Password -->
                <div class="flex-1">
                    <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')"/>

                    <x-text-input required wire:model="password_confirmation" id="password_confirmation"
                                  class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation"  autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>
            </div>

            <div class="flex gap-8 md:flex-col">

                <div class="flex-1">
                    <x-input-label for="name" :value="__('Имя')"/>
                    <x-text-input required wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name"
                                  autofocus autocomplete="name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>
                <div class="flex-1">
                    <x-input-label for="surname" :value="__('Фамилия')"/>
                    <x-text-input required wire:model="surname" id="surname" class="block mt-1 w-full" type="text" name="surname"

                                  autofocus autocomplete="surname"/>
                    <x-input-error :messages="$errors->get('surname')" class="mt-2"/>
                </div>

            </div>

            <div class="flex gap-8 md:flex-col">
                <div class="flex-1">
                    <x-input-label for="thirdname" :value="__('Отчество')"/>
                    <x-text-input required wire:model="thirdname" id="thirdname" class="block mt-1 w-full" type="text"
                                  name="thirdname"
                                  autocomplete="thirdname"/>
                    <x-input-error :messages="$errors->get('thirdname')" class="mt-2"/>
                </div>

                <div class="flex-1">
                    <x-input-label for="telegram" :value="__('Дата рождения')"/>
                    <x-text-input required wire:model="birth_dt" id="birth_dt" class="block mt-1 w-full" type="date"
                                  name="birth_dt"
                                  autocomplete="birth_dt"/>
                    <x-input-error :messages="$errors->get('birth_dt')" class="mt-2"/>
                </div>
            </div>

            <div class="flex gap-8 md:flex-col">
                <div class="flex-1">
                    <x-input-label for="telegram" :value="__('Ник в телеграм')"/>
                    <x-text-input required wire:model="telegram" id="telegram" class="block mt-1 w-full" type="text"
                                  name="telegram"
                                  autofocus autocomplete="telegram"/>
                    <x-input-error :messages="$errors->get('telegram')" class="mt-2"/>
                </div>
                <div class="flex-1">
                    <x-input-label for="workplace" :value="__('Полное название места работы или учебы')"/>
                    <x-text-input required wire:model="workplace" id="workplace" class="block mt-1 w-full" type="text"
                                  name="workplace"
                                  autocomplete="workplace"/>
                    <x-input-error :messages="$errors->get('workplace')" class="mt-2"/>
                </div>
            </div>

            <div class="flex gap-8 md:flex-col">
                <div class="flex flex-col flex-1 gap-4">
                    <div class="flex-1">
                        <x-input-label for="telegram" :value="__('Род деятельности')"/>
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
                    <x-textarea wire:model="eco_part"
                                required
                                placeholder="Расскажите о своём опыте в волонтерской или просветительской деятельности в сфере экологии"
                                class="w-full h-full"/>
                </div>

            </div>

            <div class="flex gap-4 items-end">
                <div class="flex-1">
                    <x-input-label for="region" :value="__('Регион')"/>
                    <x-text-input required wire:model="region" id="region"
                                  class="block mt-1 w-full"
                                  placeholder=""
                                  type="text"
                                  name="region"  autocomplete="region"/>
                    <x-input-error :messages="$errors->get('region')" class="mt-2"/>
                </div>
                <div class="flex-1">
                    <x-input-label for="telephone" :value="__('Телефон')"/>
                    <x-text-input required wire:model="telephone" id="telephone"
                                  class="block mt-1 w-full mobile_input"
                                  placeholder="8 (123) 456 7890"
                                  type="text"
                                  name="telephone"  autocomplete="telephone"/>
                    <x-input-error :messages="$errors->get('telephone')" class="mt-2"/>
                </div>
                @if(!$sms_code_sent)
                    <x-link wire:click="getSms">Получить код</x-link>
                @endif
                @if($sms_code_sent)
                    <div class="flex-1">
                        <x-input-label for="sms_code_input" :value="__('СМС Код')"/>
                        <x-text-input required wire:model="sms_code_input" id="sms_code_input"
                                      class="block mt-1 w-full mobile_input"
                                      type="text"
                                      name="sms_code_input"  autocomplete="sms_code_input"/>
                    </div>
                @endif
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
