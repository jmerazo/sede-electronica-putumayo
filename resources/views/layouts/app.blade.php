<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Putumayo') }}</title>
        <link rel="stylesheet" href="{{ asset('/css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/sidebar.css') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/api.js') }}" defer></script>
    </head>
    <body>
        <x-accesibility-bar />
        <x-jet-banner />
        <x-navbar />
        @if (!request()->routeIs('home') && isset($breadcrumbItems) && count($breadcrumbItems) > 0)
            <div class="container">
                <x-breadcrumb :breadcrumbItems="$breadcrumbItems" />
            </div>
        @endif
        <div class="min-h-screen">
            @if (Auth::check())
                @livewire('navigation-menu')
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="container-centered ">
                @yield('content')
            </main>
        </div>
        <x-footer />
        @stack('modals')
        @livewireScripts
        @stack('scripts')
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
