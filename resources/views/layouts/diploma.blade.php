<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/scss/portal.scss', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen">
<div class="w-[826px] h-[1167px]  m-auto relative">

    <div class="absolute w-[50px] top-[200px] left-[50px]">
        {!! file_get_contents(public_path('/fixed/diploma/svg_1.svg')) !!}
    </div>
    <div class="absolute w-[90px] top-[180px] right-[50px]">
        {!! file_get_contents(public_path('/fixed/diploma/svg_2.svg')) !!}
    </div>
    <div class="absolute w-[90px] bottom-[580px] left-0">
        {!! file_get_contents(public_path('/fixed/diploma/svg_3.svg')) !!}
    </div>
    <div class="absolute w-[80px] bottom-[300px] right-0">
        {!! file_get_contents(public_path('/fixed/diploma/svg_4.svg')) !!}
    </div>

    <div class="absolute w-[80px] bottom-[300px] left-[50px]">
        {!! file_get_contents(public_path('/fixed/diploma/svg_5.svg')) !!}
    </div>

    <div class="w-[730px] h-full flex flex-col items-center mx-auto">

        <div class="bg-green-500 h-10 w-full mb-16"></div>
        <div class="w-[35rem] mb-32">
            {!! file_get_contents(public_path('/fixed/diploma/svg_0.svg')) !!}
        </div>
        <div class="text-center flex flex-col items-center mb-56">
            <h1 class="text-7xl font-bold uppercase mb-6">СЕРТИФИКАТ</h1>
            <p class="text-2xl border border-black rounded-2xl px-10 py-3 w-fit mb-6">подтверждает, что</p>

            <p class="text-4xl font-semibold mt-8 border-b border-black !mb-10">{{$fio}}</p>

            <div class="text-2xl">
                <p class="font-bold">является {{$type}}</p>
                <p>просветительской программы</p>
                <p>«МАСТЕРСКАЯ ЭКОЗНАНИЙ»</p>
                <p>корпоративного университета</p>
                <p>«Экосистема»</p>
            </div>

        </div>

        <div class="w-full text-lg flex justify-between items-end mb-8 leading-[25px]">
            <p class="font-bold">Исполнительный директор<br>Всероссийского экологического движения<br>«ЭКОСИСТЕМА»</p>
            <img
                src="data:image/png; base64, {{ base64_encode(file_get_contents(public_path('/fixed/diploma/sign.png'))) }}"
                class="w-[200px]" alt="">
            <p class="text-lg font-bold">Камилов М.А.</p>
        </div>
        <p class="text-lg font-bold mx-auto w-fit">2025 год</p>
        <div class="bg-green-500 h-10 w-full mt-auto"></div>
    </div>
</div>
@stack('page-js')
</body>
</html>
