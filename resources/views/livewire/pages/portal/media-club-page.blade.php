<main>

    <section
        class="text-center h-screen bg-[linear-gradient(90deg,rgba(70,159,18,1)_0%,rgba(148,217,65,1)_100%)] mb-8">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-1.svg" class="absolute top-1/2 left-0 w-20"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-2.svg" class="absolute bottom-8 left-20 w-12"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-3.svg" class="absolute top-80 left-20 w-16 md:hidden"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-4.svg" class="absolute bottom-0 left-40 w-36"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-5.svg" class="absolute top-40 right-40 w-36"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-6.svg" class="absolute -bottom-8 right-40 w-24"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-7.svg" class="absolute top-80 right-28 w-20 md:hidden"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-8.svg" class="absolute top-0 right-4 w-36"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-9.svg" class="absolute top-1/2 right-28 w-14 md:hidden"
             alt="">
        <img src="/fixed/media-welcome-svgs/welcome-media-svg-10.svg" class="absolute bottom-4 right-0 w-36"
             alt="">
        <div
            class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col gap-4 lg:items-center lg:text-center">
            <h1 class="text-8xl md:text-5xl font-bold">ОТКРЫТИЕ</h1>
            <h1 class="text-8xl md:text-5xl font-bold text-white pl-40 whitespace-nowrap lg:pl-0">МЕДИА-КЛУБА</h1>
            <h1 class="text-4xl md:text-2xl font-bold">Всероссийского экологического движения<br>«Экосистема»</h1>
        </div>
        <div class="absolute left-0 top-20 py-4 px-16 bg-white rounded-r-xl">
            <x-logo-main-black/>
        </div>
    </section>

    <section
        class="flex flex-col font-bold  border border-green-600 rounded-2xl py-8 px-4 content items-center mb-8">
        <p class="text-center mb-10 text-2xl"><span class="font-bold text-green-600 uppercase">Организатор:</span><br>Всероссийское
            экологическое общественное движение «Экосистема»</p>
        <div class="w-full flex justify-between md:flex-col md:items-center md:text-center text-xl">
            <p><span class="text-green-600 ">Дата проведения:</span><br> 15 мая 2025 г.</p>
            <p><span class="text-green-600 ">Время:</span><br>14:00 – 20:30</p>
            <p><span class="text-green-600 ">Место проведения:</span><br>инновационный кластер «Ломоносов»<br> (г. Москва, Раменский бульвар, д. 1, зал «Архангельск»)</p>
        </div>
    </section>

    <section class="">
        <h1 class="text-6xl font-bold mx-auto mb-4 md:text-3xl text-center">Тайминг мероприятия</h1>
        <div
            class="flex flex-col font-bold text-lg py-8 px-4 content items-center mb-4 sm:gap-4 ">
            @foreach($timing as $key=>$event)
                <div class="flex w-full md:flex-col">
                    <div class="flex gap-2 w-52 min-w-52 items-start border-green-500 border-b sm:border-none border-r @if ($loop->last) !border-b-0 @endif">
                        <svg class="w-3 min-w-3 max-w-3 py-2" id="Слой_1" data-name="Слой 1" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 9.36 10.68">
                            <g id="Слой_2" data-name="Слой 2">
                                <g id="Слой_1-2" data-name="Слой 1-2">
                                    <polygon points="0 0 0.22 10.68 9.36 5.15 0 0" style="fill:#d9dada"/>
                                </g>
                            </g>
                        </svg>
                        <p class="text-green-500 pb-2 pt-[2px] flex-1">{{$event['time']}}</p>
                    </div>
                    <div class="pl-5 border-green-500 py-2 border-b flex-1 @if ($loop->last) !border-b-0 @endif">
                        <p>{!! $event['desc'] !!}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    {{--    <section--}}
    {{--        class="flex flex-col font-bold text-xl border border-green-600 rounded-2xl py-8 px-4 content items-center mb-8">--}}
    {{--        <p class="text-center mb-10"><span class="font-bold text-green-600 uppercase">Организатор:</span><br>Всероссийское--}}
    {{--            экологическое общественное движение «Экосистема»</p>--}}
    {{--        <div class="w-full flex justify-between md:flex-col md:items-center md:text-center">--}}
    {{--            <p><span class="text-green-600 ">Дата проведения:</span><br> 14 мая 2025 г.</p>--}}
    {{--            <p><span class="text-green-600 ">Сбор гостей:</span><br>14:00</p>--}}
    {{--            <p><span class="text-green-600 ">Место проведения:</span><br> Itten Holl, 2-й Кожуховский проезд, 29к6</p>--}}
    {{--        </div>--}}
    {{--    </section>--}}

{{--    <section class="">--}}
{{--        <h1 class="text-6xl font-bold mx-auto mb-4 md:text-3xl text-center">Главные темы</h1>--}}
{{--        <div--}}
{{--            class="flex font-bold text-lg border border-green-600 rounded-2xl py-8 px-4 gap-8 content items-center mb-4 md:flex-col">--}}
{{--            <div class="flex gap-4 max-w-[50%] md:max-w-full">--}}
{{--                <svg id="Слой_1" class="min-w-16 w-16 max-w-16 md:w-8 md:max-w-8 md:min-w-8" data-name="Слой 1"--}}
{{--                     xmlns="http://www.w3.org/2000/svg"--}}
{{--                     viewBox="0 0 41.04 41.04">--}}
{{--                    <g id="Слой_2" data-name="Слой 2">--}}
{{--                        <g id="Слой_1-2" data-name="Слой 1-2">--}}
{{--                            <circle cx="20.52" cy="20.52" r="19.81"--}}
{{--                                    style="fill:none;stroke:#55a52d;stroke-miterlimit:22.93000072719816;stroke-width:1.41999998321949px"/>--}}
{{--                            <path--}}
{{--                                d="M29.08,24.15l-.38-.59,5.59-3.63.77,1.19-5.59,3.63Zm6-3V19.93l.92.59Zm0,0L34.31,20v1.19l-5.59-3.63.77-1.19L35.08,20Zm-1.48.11H5.6V19.81h28Z"--}}
{{--                                style="fill:#1a1a18"/>--}}
{{--                        </g>--}}
{{--                    </g>--}}
{{--                </svg>--}}
{{--                <p>микропластик в окружающей среде и его влияние на экологию и здоровье человека</p>--}}
{{--            </div>--}}

{{--            <div class="flex gap-4 max-w-[50%] md:max-w-full">--}}
{{--                <svg id="Слой_1" class="min-w-16 w-16 max-w-16 md:w-8 md:max-w-8 md:min-w-8" data-name="Слой 1"--}}
{{--                     xmlns="http://www.w3.org/2000/svg"--}}
{{--                     viewBox="0 0 41.04 41.04">--}}
{{--                    <g id="Слой_2" data-name="Слой 2">--}}
{{--                        <g id="Слой_1-2" data-name="Слой 1-2">--}}
{{--                            <circle cx="20.52" cy="20.52" r="19.81"--}}
{{--                                    style="fill:none;stroke:#55a52d;stroke-miterlimit:22.93000072719816;stroke-width:1.41999998321949px"/>--}}
{{--                            <path--}}
{{--                                d="M29.08,24.15l-.38-.59,5.59-3.63.77,1.19-5.59,3.63Zm6-3V19.93l.92.59Zm0,0L34.31,20v1.19l-5.59-3.63.77-1.19L35.08,20Zm-1.48.11H5.6V19.81h28Z"--}}
{{--                                style="fill:#1a1a18"/>--}}
{{--                        </g>--}}
{{--                    </g>--}}
{{--                </svg>--}}
{{--                <p>ситуация с уборкой мазута на побережье Черного моря</p>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div--}}
{{--            class="flex text-lg border border-green-600 rounded-2xl py-8 px-4 content items-center gap-4 mb-4 md:flex-col">--}}
{{--            <svg id="Слой_1" class="min-w-16 w-16 max-w-16 md:hidden" data-name="Слой 1"--}}
{{--                 xmlns="http://www.w3.org/2000/svg"--}}
{{--                 viewBox="0 0 41.04 41.04">--}}
{{--                <g id="Слой_2" data-name="Слой 2">--}}
{{--                    <g id="Слой_1-2" data-name="Слой 1-2">--}}
{{--                        <circle cx="20.52" cy="20.52" r="19.81"--}}
{{--                                style="fill:none;stroke:#55a52d;stroke-miterlimit:22.93000072719816;stroke-width:1.41999998321949px"/>--}}
{{--                        <path--}}
{{--                            d="M29.08,24.15l-.38-.59,5.59-3.63.77,1.19-5.59,3.63Zm6-3V19.93l.92.59Zm0,0L34.31,20v1.19l-5.59-3.63.77-1.19L35.08,20Zm-1.48.11H5.6V19.81h28Z"--}}
{{--                            style="fill:#1a1a18"/>--}}
{{--                    </g>--}}
{{--                </g>--}}
{{--            </svg>--}}
{{--            <div class="flex flex-col">--}}
{{--                <p>На мероприятии журналисты смогут напрямую пообщаться с учеными,--}}
{{--                    экспертами и лидерами общественного мнения, которые:--}}
{{--                <ul class="!list-disc ml-5">--}}
{{--                    <li>помогут развенчать популярные мифы, связанные с этими темами</li>--}}
{{--                    <li>расскажут, почему кликбейт в научных вопросах вредит всем</li>--}}
{{--                    <li>разъяснят, как правильно интерпретировать научные исследования в этих областях и на что обращать--}}
{{--                        особое внимание.--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                </p>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--        <div class="flex text-lg border border-green-600 rounded-2xl py-8 px-4 content items-center gap-4">--}}
{{--            <svg id="Слой_1" class="min-w-16 w-16 max-w-16 md:hidden" data-name="Слой 1"--}}
{{--                 xmlns="http://www.w3.org/2000/svg"--}}
{{--                 viewBox="0 0 41.04 41.04">--}}
{{--                <g id="Слой_2" data-name="Слой 2">--}}
{{--                    <g id="Слой_1-2" data-name="Слой 1-2">--}}
{{--                        <circle cx="20.52" cy="20.52" r="19.81"--}}
{{--                                style="fill:none;stroke:#55a52d;stroke-miterlimit:22.93000072719816;stroke-width:1.41999998321949px"/>--}}
{{--                        <path--}}
{{--                            d="M29.08,24.15l-.38-.59,5.59-3.63.77,1.19-5.59,3.63Zm6-3V19.93l.92.59Zm0,0L34.31,20v1.19l-5.59-3.63.77-1.19L35.08,20Zm-1.48.11H5.6V19.81h28Z"--}}
{{--                            style="fill:#1a1a18"/>--}}
{{--                    </g>--}}
{{--                </g>--}}
{{--            </svg>--}}
{{--            <p>В рамках открытия медиаклуба состоятся две экспертные сессии,--}}
{{--                а завершится мероприятие презентацией корпоративного университета--}}
{{--                «Экосистемы», подведением первых итогов его работы,--}}
{{--                а также награждением первых отличников онлайн-курса--}}
{{--                «Мастерская экознаний».</p>--}}
{{--        </div>--}}
{{--    </section>--}}

    @foreach($sessions as $key => $session)
        <section class="content mt-16 mb-8">
            <div class="flex justify-between items-center mb-4 md:flex-col">
                <h1 class="text-6xl font-bold md:text-3xl md:mb-2">СЕССИЯ {{$key + 1}}</h1>
                <div class="flex items-center justify-center border border-green-600 rounded-2xl py-2 px-8">
                    <svg class="w-6" id="Слой_1" data-name="Слой 1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 13.3 16.99">
                        <g id="Слой_2" data-name="Слой 2">
                            <g id="Слой_1-2" data-name="Слой 1-2">
                                <path
                                    d="M13.28,15.67h-1A8.57,8.57,0,0,0,8.54,9.28a6.7,6.7,0,0,1-.77-.64L8,8.43c2.12-1.88,4.15-3.25,4.3-7.13h1V0H0V1.29H1C1.19,8.85,10.4,9,11,15.66H2.35c.26-3.39,2.91-4.93,3.18-5.39a4.94,4.94,0,0,0-1-.77A9.28,9.28,0,0,0,2.18,12,7.66,7.66,0,0,0,1,15.67H0V17H13.29ZM6.64,7.78a16,16,0,0,1-1.52-1.2,7.09,7.09,0,0,1-2.8-5.29H11A6.37,6.37,0,0,1,9.5,5.22,13.39,13.39,0,0,1,6.64,7.78Z"
                                    style="fill:#030304;fill-rule:evenodd"/>
                            </g>
                        </g>
                    </svg>
                    <h1 class="text-xl md:text-lg font-bold mx-auto">{{$session['time']}}</h1>
                </div>
            </div>
            <h1 class="text-2xl md:text-lg font-bold">{!! $session['desc'] !!}</h1>
        </section>
        <section
            class="flex flex-col text-lg border border-green-600 rounded-2xl gap-2 py-8 px-4 content mb-8">
            @foreach($session['questions'] as $question)
                <p class="flex gap-2">
                    <svg class="min-w-4 max-w-4 w-4" id="Слой_1" data-name="Слой 1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 13.76 10.18">
                        <g id="Слой_2" data-name="Слой 2">
                            <g id="Слой_1-2" data-name="Слой 1-2">
                                <polygon
                                    points="6.09 8.27 11.15 5.03 6.09 1.72 6.09 0.47 6.11 0.46 13.11 5.04 6.09 9.54 6.09 8.27"
                                    style="fill:none;stroke:#55a52d;stroke-miterlimit:22.93000030517578;stroke-width:0.7099999785423279px"/>
                                <polygon
                                    points="0.35 8.27 5.42 5.03 0.35 1.72 0.35 0.47 0.36 0.46 7.38 5.04 0.35 9.54 0.35 8.27"
                                    style="fill:none;stroke:#55a52d;stroke-miterlimit:22.93000030517578;stroke-width:0.7099999785423279px"/>
                            </g>
                        </g>
                    </svg>
                    {{$question}}
                </p>
            @endforeach
        </section>
        <section class="content mb-16">
            <h1 class="text-4xl font-bold mx-auto mb-4">ПРИГЛАШЕННЫЕ СПИКЕРЫ:</h1>
            <div class="flex flex-col gap-8 items-start">
                @foreach($session['speakers'] as $speaker)
                    <div class="flex gap-4 justify-center items-center">
                        <img class="w-[85px] h-[85px] md:w-[45px] md:h-[45px] rounded-full" src="{{$speaker['img']}}" alt="">
                        <div class="flex flex-col">
                            <h1 class="text-lg font-bold text-green-600 uppercase">{{$speaker['name']}}</h1>
                            <p>{{$speaker['desc']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
                <div class="flex gap-4 ml-auto justify-end mt-10">
                    <div class="flex flex-col">
                        <p class="text-lg font-bold">МОДЕРАТОР:</p>
                        <p class="font-bold">{{$session['moderator']['name']}}</p>
                        <p>{!! $session['moderator']['desc'] !!}</p>
                    </div>
                    <img src="{{$session['moderator']['img']}}" alt="">
                </div>
        </section>
    @endforeach
    <section
        class="flex font-bold justify-between text-lg border border-green-600 rounded-2xl py-2 px-4 content mb-8 md:flex-col">
        <p>Также на нашем мероприятии будет работать мобильная студия проекта «Кинобус ПРОЭКО», получивший две экологические премии: Eco Best Award 2024 за лучший образовательный проект и «Экопозитив» 2024 за вклад в экопросвещение.
            Ведущий Жора Каваносян вместе с участниками Шоу разоблачит и другие экологические мифы. После завершения мероприятия автодом проекта -
            Кинобус — отправится в тур по Архангельской области, посвященный Форуму «ЗЕМЛЯНЕ».
        </p>
    </section>
    <section class="content mb-16">
        <livewire:components.journalist-register/>
    </section>
    <section
        class="flex font-bold justify-between text-lg border border-green-600 rounded-2xl py-2 px-4 content mb-8 md:flex-col">
        <p>ПО ВСЕМ ВОПРОСАМ</p>
        <p>Дмитрий Шолик –<br>руководитель проекта</p>
        <p class="text-xl text-green-600">+7 (926) 165-00-70</p>
    </section>
</main>
