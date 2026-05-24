<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title') - {{ settings('app_name', '24racks Cloud') }}</title>
    <link rel="icon" href="@settings('favicon', '/assets/core/img/logo.png')">

    {{-- Meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="24racks Cloud — Hosting Premium con protección Anti-DDoS, VPS NVMe y servidores dedicados en España.">
    <meta name="theme-color" content="#3b82f6">
    <meta name="keywords" content="cloud, hosting, vps, anti-ddos, servidores dedicados, game hosting">
    <meta name="robots" content="@settings('seo::robots', 'index, follow')">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ trim($__env->yieldContent('title')) }} - {{ settings('app_name', '24racks Cloud') }}">
    <meta property="og:description" content="24racks Cloud — Hosting Premium con protección Anti-DDoS, VPS NVMe y servidores dedicados en España.">
    <meta property="og:image" content="@settings('seo::image', '/static/wemx.png')">

    <script>
        (function () {
            const savedTheme = localStorage.getItem('color-theme') || localStorage.getItem('theme') || sessionStorage.getItem('color-theme') || sessionStorage.getItem('theme');
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (prefersDark ? 'dark' : 'light');

            document.documentElement.dataset.theme = theme;
            document.documentElement.classList.toggle('dark', theme === 'dark');
        })();
    </script>

    {{-- Core Tailwind / Flowbite (compiled from default theme) --}}
    @vite(['resources/client_area/default/assets/css/app.css','resources/client_area/default/assets/js/app.js'])

    {{-- 24racks Cloud Design System --}}
    <link rel="stylesheet" href="{{ client_asset('css/app.css') }}">
    <script src="{{ client_asset('js/app.js') }}" defer></script>

    @livewireStyles

    @yield('header')
</head>

<body class="min-h-screen antialiased flex flex-col relative selection:bg-blue-500/20 selection:text-blue-100">

    <div class="site-loader" aria-hidden="true"></div>

    @include('theme::layouts.header', ['activePage' => $activePage ?? ''])

    <main class="app-main app-shell flex-1 w-full">
        @yield('content')
    </main>

    @include('theme::layouts.footer')

    {{-- Re-init Flowbite on Livewire navigation; close mobile nav after navigation --}}
    <script>
        document.addEventListener('livewire:navigated', function () {
            if (typeof initFlowbite === 'function') {
                initFlowbite();
            }

            const nav    = document.getElementById('client-main-navigation');
            const toggle = document.getElementById('client-nav-toggle');
            if (nav && toggle && window.matchMedia('(max-width: 1023px)').matches && !nav.classList.contains('hidden')) {
                toggle.click();
            }
        });
    </script>

    @livewireScripts
</body>
</html>
