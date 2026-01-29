<main>
    <section class="content uppercase text-center flex flex-col items-center mb-16">
        <h1 class="text-green-500">Корпоративный университет «Экосистема»</h1>
        <h1>Просветительская программа</h1>
        <h1 class="text-green-500">«мастерская экознаний»</h1>
    </section>

    <section class="w-full bg-green-500 mb-16">
        <video autoplay="" muted="" width="100%" loop="loop">
            <source src="/fixed/fn.mp4" type="video/mp4">
        </video>
    </section>

    <section class="content text-center text-xl mb-16 flex flex-col items-center">
        @auth()
            <x-link href="{{route('account.courses')}}" class="w-full px-8 py-4 max-w-md mt-4 mb-20">Личный кабинет
            </x-link>
        @else
            <x-link href="#login" class="w-full px-8 py-4 max-w-md mt-4 mb-20">Подать заявку</x-link>
        @endauth
        <h1 class="text-green-500">ПЛАН ПРОСВЕТИТЕЛЬСКОЙ ПРОГРАММЫ</h1>
        <h1 class="">«МАСТЕРСКАЯ ЭКОЗНАНИЙ»</h1>
    </section>

    <section id="lessons" class="bg-green-500 rounded-tr-[240px] rounded-bl-[240px] md:rounded-none py-24 mb-24">
        <div class="flex flex-col gap-4 content [&>*:nth-child(even)]:ml-auto">
            @foreach($lessons as $lesson)
                <div x-data="{ open: false }" class="flex bg-white py-10 pr-10 rounded w-1/2 md:w-full relative">
                    <div class="px-8 min-w-max flex items-center justify-center">
                        @if($lesson->getFirstMediaUrl('icon'))
                            <img src="{{$lesson->getFirstMediaUrl('icon') ?? '/fixed/default_lesson_icon.png'}}"
                                 alt="{{$lesson['name']}}"
                                 class="w-24 object-cover">
                        @else
                            <img src="/fixed/default_lesson_icon.png"
                                 alt="{{$lesson['name']}}"
                                 class="w-24">
                        @endif

                    </div>
                    <div class="flex flex-col">
                        <p class="uppercase">{{$lesson->module['name']}}. {{$lesson['name']}}</p>
                        <p class="font-bold mb-6">{{$lesson->module['title']}}</p>
                        <p>{{$lesson['title']}}</p>
                        <p x-show="open" class="mt-2">{{$lesson['desc']}}</p>
                    </div>
                    <!-- Треугольник -->
                    <div
                        @click="open = !open"
                        :class="open ? 'rotate-0 md:rotate-0' : '-rotate-90 md:rotate-180'"
                        class="absolute bottom-2 -right-8  w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-b-8 border-b-white transition-transform duration-300 cursor-pointer md:border-b-green-500 md:right-1/2 "
                    ></div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="speakers" class="content relative mx-auto mb-24">
        <h1 class="mx-auto mb-16"><span class="text-green-500">СПИКЕРЫ</span> КУРСА</h1>
        <x-ui.speakers-slider/>
    </section>

    <section id="faq" class="mb-32">
        <h1 class="mx-auto mb-16"><span class="text-green-500">ПОПУЛЯРНЫЕ</span> ВОПРОСЫ</h1>
        <div class="bg-gray-300 py-24 mb-24 ">
            <div class="content flex flex-col gap-10 relative">
                <svg class=" absolute w-24 h-auto -rotate-90 left-0 -top-[162px]" id="Слой_1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 227 317.6" style="enable-background:new 0 0 227 317.6;" xml:space="preserve">
<g>
    <defs>
        <rect id="SVGID_1_" x="0" y="0.2" width="227" height="157.5"/>
    </defs>
    <clipPath id="SVGID_00000147928381815892485800000004314386547326068097_">
        <use xlink:href="#SVGID_1_" style="overflow:visible;"/>
    </clipPath>

    <path
        style="clip-path:url(#SVGID_00000147928381815892485800000004314386547326068097_);fill-rule:evenodd;clip-rule:evenodd;fill:#78BE0A;"
        d="
		M226,159.3L113,0.2L0,159.3H226z M192.4,159.3L113,47.5L33.6,159.3H192.4z"/>
</g>
                    <g>
                        <defs>
                            <rect id="SVGID_00000120522871054874737380000017847625778002714535_" x="0" y="158.8"
                                  width="227" height="157.5"/>
                        </defs>
                        <clipPath id="SVGID_00000150070066417644749780000011864268922607637407_">
                            <use xlink:href="#SVGID_00000120522871054874737380000017847625778002714535_"
                                 style="overflow:visible;"/>
                        </clipPath>

                        <path
                            style="clip-path:url(#SVGID_00000150070066417644749780000011864268922607637407_);fill-rule:evenodd;clip-rule:evenodd;fill:#78BE0A;"
                            d="
		M226,317.9L113,158.8L0,317.9H226z M192.4,317.9L113,206.1L33.6,317.9H192.4z"/>
                    </g>
</svg>

                <div>
                    <p class="font-bold mb-2">Что нужно для того, чтобы начать обучение?</p>
                    <p>Для того, чтобы начать обучение, необходимо зарегистрироваться, нажав на копку «ПОДАТЬ ЗАЯВКУ» на
                        главной странице сайта. Для активации личного кабинета вам нужно подтвердить номер телефона.</p>
                </div>
                <div>
                    <p class="font-bold mb-2">Это платная программа?</p>
                    <p>Программа бесплатная.</p>
                </div>
                <div>
                    <p class="font-bold mb-2">Мне 16 лет, могу ли я получить доступ и пройти просветительскую программу
                        «Мастерская экознаний»?</p>
                    <p>Принять участие в просветительской программе «Мастерская экознаний» можно от 18 лет.</p>
                </div>
                <div>
                    <p class="font-bold mb-2">Из чего состоит программа?</p>
                    <p>Программа состоит из четырёх модулей, в которых содержатся 10 видеолекций. В первом модуле вы
                        познакомитесь с основами экологии и экологического мышления. Весь второй модуль связан с
                        экологическими коммуникациями и тем, как человек и экология влияют друг на друга. Третий модуль
                        посвящён экологическим вызовам и решениям. В четвёртом — узнаете о законодательных аспектах
                        экологического движения в Российской Федерации.</p>
                </div>
                <div>
                    <p class="font-bold mb-2">Что будет, если я не смогу посмотреть лекцию именно в день выхода? Она
                        будет доступна позже?</p>
                    <p>Если вы подключитесь позже, вам будет доступно прохождение всех материалов программы.</p>
                </div>
                <div>
                    <p class="font-bold mb-2">Тесты нужны для самопроверки или же полученные за их выполнение баллы идут
                        в общий зачёт?</p>
                    <p>За тесты даются баллы, которые вносят вклад в итоговую оценку. На прохождение теста даётся 1
                        попытка.</p>
                </div>
                <div>
                    <p class="font-bold mb-2">Предполагается ли какой-то экзамен в конце программы? Получу ли я какое-то
                        свидетельство о ее окончании?</p>
                    <p>Да, в конце четвёртого модуля предполагается выполнение итоговых заданий по всем изученным
                        материалам. Всем участникам, прошедшим просветительскую программу, будет направлен электронный
                        сертификат.</p>
                </div>
                <div>
                    <p class="font-bold mb-2">Куда обращаться, если возникли вопросы?</p>
                    <p>Пишите на почту программы cu_ecosistema@mail.ru или звоните по телефону +79932875359. Мы
                        обязательно вам ответим.</p>
                </div>
                <svg class=" absolute w-24 h-auto rotate-90 right-0 -bottom-[162px]" id="Слой_1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 227 317.6" style="enable-background:new 0 0 227 317.6;" xml:space="preserve">
<g>
    <defs>
        <rect id="SVGID_1_" x="0" y="0.2" width="227" height="157.5"/>
    </defs>
    <clipPath id="SVGID_00000147928381815892485800000004314386547326068097_">
        <use xlink:href="#SVGID_1_" style="overflow:visible;"/>
    </clipPath>

    <path
        style="clip-path:url(#SVGID_00000147928381815892485800000004314386547326068097_);fill-rule:evenodd;clip-rule:evenodd;fill:#78BE0A;"
        d="
		M226,159.3L113,0.2L0,159.3H226z M192.4,159.3L113,47.5L33.6,159.3H192.4z"/>
</g>
                    <g>
                        <defs>
                            <rect id="SVGID_00000120522871054874737380000017847625778002714535_" x="0" y="158.8"
                                  width="227" height="157.5"/>
                        </defs>
                        <clipPath id="SVGID_00000150070066417644749780000011864268922607637407_">
                            <use xlink:href="#SVGID_00000120522871054874737380000017847625778002714535_"
                                 style="overflow:visible;"/>
                        </clipPath>

                        <path
                            style="clip-path:url(#SVGID_00000150070066417644749780000011864268922607637407_);fill-rule:evenodd;clip-rule:evenodd;fill:#78BE0A;"
                            d="
		M226,317.9L113,158.8L0,317.9H226z M192.4,317.9L113,206.1L33.6,317.9H192.4z"/>
                    </g>
</svg>

            </div>
    </section>

    <section id="login" class="content mb-32 text-center">
        @auth()
            <x-link class="mx-auto px-8" href="{{route('account.courses')}}" wire:navigate>Личный кабинет</x-link>
        @else
            <h1 class="mx-auto mb-16">Авторизация</h1>
            <livewire:pages.auth.login/>
        @endauth
    </section>
</main>
