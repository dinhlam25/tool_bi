<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('wbc/js/custom.js?id=2024053015') }}" defer></script>
    <script src="{{ asset('wbc/js/md5.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.ts'])
</head>
<body class="@if(\Route::currentRouteName() === 'login' ||
                 \Route::currentRouteName() === 'dashboard')
                 pdm-bg-gray
             @else
                 pdm-bg-white
             @endif
             ">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KDVQJ2J"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="app">
        @include('layouts.header')
        <!-- フラッシュメッセージ -->
        @if (session('flash'))
            <div class="alert {{ session('type') }} text-center py-2 my-0">
                {{ session('flash') }}
            </div>
        @endif
        <main>
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
        @include('layouts.footer')
    </div>
    @vite(['resources/js/app.ts'])
</body>
</html>