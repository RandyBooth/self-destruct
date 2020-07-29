<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex flex-col bg-gray-100 min-h-screen antialiased leading-none">
    <header class="bg-white border-t-8 border-blue-500 shadow-sm">
        <nav class="container mx-auto px-6 py-8">
            <div class="flex {{-- items-center justify-center --}}">
                <div class="mr-6">
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-900 no-underline">
                        {{ config('app.name') }}
                    </a>
                </div>
{{--                 <div class="flex-1 text-right">
                    @guest
                        <a class="no-underline hover:underline text-gray-900 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline text-gray-900 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span class="text-gray-900 text-sm pr-4">{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                            class="no-underline hover:underline text-gray-900 text-sm p-3"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </div> --}}
            </div>
        </nav>
    </header>

    <main class="flex-grow container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <footer class="bg-blue-500 text-white">
        <div class="container mx-auto px-6 py-8">
            Footer
        </div>
    </footer>
</body>
</html>
