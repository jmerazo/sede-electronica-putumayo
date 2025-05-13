<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Putumayo') }}</title>
        <link rel="stylesheet" href="{{ asset('/css/global.css') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.css">
        
        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/api.js') }}" defer></script>
    </head>
    <body class="{{ request()->is('dashboard*') ? 'dashboard-layout' : 'public-layout' }}">
        <x-accesibility-bar />
        <x-jet-banner />

        @if (!request()->is('dashboard*'))
            <x-navbar />
        @endif

        <!-- Contenedor principal con clase flex -->
        <div id="container">
            @if (Auth::check() && request()->is('dashboard*'))
                @livewire('sidebar-menu')
            @endif

            <!-- Contenido Principal -->
            <div id="main-content">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div>
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="container-centered">
                    @yield('content')
                </main>
            </div>
        </div>

        @if (!request()->is('dashboard*'))
            <x-footer />
        @endif
        
        @stack('modals')
        @livewireScripts
        @stack('scripts')
        <script>
            function toggleSidebar() {
                let sidebar = document.getElementById("sidebar");
                let mainContent = document.getElementById("main-content");
                let body = document.body;

                sidebar.classList.toggle("collapsed");
                body.classList.toggle("sidebar-collapsed");

                // Ajustar el ancho del contenido dinámicamente
                if (sidebar.classList.contains("collapsed")) {
                    mainContent.style.width = "calc(100% - 80px)";
                } else {
                    mainContent.style.width = "calc(100% - 260px)";
                }
            }
        </script>
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.js"></script>