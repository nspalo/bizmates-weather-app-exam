<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Weather App') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-color: #aed6ff !important;
        }

        .display-4 {
            font-size: 5.5rem;
        }
    </style>
</head>
<body>
    <div id="app" class="col-lg-8 mx-auto p-1 py-md-5">
        @include("layouts.header")

        <main>
            @yield('content')
        </main>

        @include("layouts.footer")
    </div>

    @yield('custom-js')
</body>
</html>
