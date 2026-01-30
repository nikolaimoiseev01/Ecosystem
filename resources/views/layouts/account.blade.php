<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$page_title}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/scss/portal.scss', 'resources/js/app.js'])
        <script src="/plugins/sweetalert2/swal.min.js"></script>
        <link rel="stylesheet" href="/plugins/sweetalert2/swal.min.css">
    </head>
    <body class="flex flex-col min-h-screen">
    <livewire:components.header/>
    <div
        x-data="{
        isActive(href) {
            return window.location.pathname.startsWith(href);
        }
    }"
        class="flex gap-8 content mb-16"
    >
        <a
            href="{{ route('account.courses') }}"
            wire:navigate
            :class="isActive('{{ parse_url(route('account.courses'), PHP_URL_PATH) }}')
            ? 'text-green-500 font-semibold border-b-2 border-green-500 pb-1'
            : 'text-gray-500 hover:text-green-500 transition'"
        >
            Уроки
        </a>

        <a
            href="{{ route('account.settings') }}"
            wire:navigate
            :class="isActive('{{ parse_url(route('account.settings'), PHP_URL_PATH) }}')
            ? 'text-green-500 font-semibold border-b-2 border-green-500 pb-1'
            : 'text-gray-500 hover:text-green-500 transition'"
        >
            Настройки
        </a>
    </div>
    <main class="content">
        {{ $slot }}
    </main>
    <livewire:components.footer/>
    @stack('page-js')
    </body>
{{--    <body class="font-sans antialiased">--}}
    {{--        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">--}}
    {{--            <livewire:layout.navigation />--}}

    {{--            <!-- Page Heading -->--}}
    {{--            @if (isset($header))--}}
    {{--                <header class="bg-white dark:bg-gray-800 shadow">--}}
    {{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
    {{--                        {{ $header }}--}}
    {{--                    </div>--}}
    {{--                </header>--}}
    {{--            @endif--}}

    {{--            <!-- Page Content -->--}}
    {{--            <main>--}}
    {{--                {{ $slot }}--}}
    {{--            </main>--}}
    {{--        </div>--}}
    {{--    </body>--}}
</html>
