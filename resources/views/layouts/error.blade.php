<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    @yield('script-block')

    <!-- Styles -->
    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
</head>
<body class="flex flex-col bg-gray-100 min-h-screen antialiased leading-none">
    <div class="h-screen flex items-center justify-center">
        <div class="flex flex-col items-center">
            <div class="flex text-primary text-6xl font-semibold mb-2">
                Oops!
            </div>

            <div class="flex text-xl font-semibold uppercase mb-8">
                @yield('code') - @yield('message')
            </div>

            <a
                class="bg-primary text-white font-bold py-3 px-4 rounded-sm shadow focus:outline-none focus:shadow-outline mr-2"
                href={{ route('home') }}
            >
                Home
            </a>
        </div>
    </div>
</body>
</html>
