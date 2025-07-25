<header x-data="{ isMedia: window.location.pathname === '/media-club' }"
        :class="isMedia ?
        'hidden'
        :'w-full mb-8'" class="">
    <div class="content flex items-center justify-between py-2">
        <div class="flex gap-4 items-center">
            <x-logo-main-black/>
            <x-logo-rosatom class="pt-3"/>
        </div>

        <div class="flex justify-center">
            <div class="flex justify-center">
                <div x-data="{ open: false }" class="relative flex flex-col justify-center">
                    <div @click="open = !open"
                         class="tham tham-e-squeeze tham-w-8"
                         :class="open ? 'tham-active' : ''"
                    >
                        <div class="tham-box">
                            <div class="tham-inner"></div>
                        </div>
                    </div>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="absolute right-0 top-6 mt-2 w-48 bg-white rounded-md shadow-lg overflow-hidden z-20">
                        <ul class="py-2">
                            <li>
                                <a href="/#lessons" class="block px-4 py-2 text-gray-800 ">Программа курса</a>
                            </li>
                            <li>
                                <a href="/#speakers" class="block px-4 py-2 text-gray-800 ">Спикеры курса</a>
                            </li>
                            <li>
                                <a href="/#faq" class="block px-4 py-2 text-gray-800 ">Популярные вопросы</a>
                            </li>
                            <li class="hidden md:block">
                                <a href="{{route('account.courses')}}" class="block px-4 py-2 text-gray-800 " wire:navigate>Личный кабинет ({{$user_name}})</a>
                            </li>

                        </ul>
                    </div>
                </div>


            </div>
            <div>
                @auth
                    <div class="flex md:hidden">
                        <a href="{{route('account.courses')}}" class="block px-4 py-2 text-gray-800 " wire:navigate>Личный кабинет ({{$user_name}})</a>
                        <x-heroicon-o-arrow-right-on-rectangle wire:click.prevent="logout" class="cursor-pointer w-6"/>
                    </div>

                @else
                    <a href="/#login" class="block px-4 py-2 text-gray-800 ">Войти</a>
                @endauth
            </div>
        </div>

        @script
        <script> /* Чтобы выполнялось каждый раз при wire:navigate */
            setTimeout(function () {
                mobileInputCreate()
            }, 1)
        </script>
        @endscript


    </div>
</header>
