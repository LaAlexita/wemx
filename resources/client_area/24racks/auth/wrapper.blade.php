<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', settings('app_name', '24racks Cloud'))</title>
    <link rel="icon" href="@settings('favicon', '/assets/core/img/logo.png')">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ __('messages.auth_intro_meta_desc') }}">
    <meta name="theme-color" content="#3b82f6">
    <meta name="robots" content="@settings('seo::robots', 'index, follow')">
    <meta property="og:title" content="{{ trim($__env->yieldContent('title')) }} - {{ settings('app_name', '24racks Cloud') }}">
    <meta property="og:description" content="{{ __('messages.auth_intro_meta_desc') }}">
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

    @vite(['resources/client_area/default/assets/css/app.css','resources/client_area/default/assets/js/app.js'])
    <link rel="stylesheet" href="{{ client_asset('css/app.css') }}">
    <script src="{{ client_asset('js/app.js') }}" defer></script>

    @yield('header')
</head>

<body class="auth-page">
    <div class="site-loader" aria-hidden="true"></div>
    <main class="auth-shell">
        <section class="auth-intro" aria-label="24racks Cloud">
            <div class="auth-intro-inner">
                <a href="/" class="auth-intro-logo" wire:navigate aria-label="{{ settings('app_name', '24racks Cloud') }}">
                    <img src="https://24racks.com/storage/products/logo1.webp" alt="">
                </a>
                <span class="auth-intro-tag">24RACKS CLOUD S.L. · AS214340</span>

                <h1 class="auth-intro-title">
                    {!! __('messages.auth_intro_title_html') !!}
                </h1>
                <p class="auth-intro-desc">{{ __('messages.auth_intro_desc') }}</p>

                <div class="auth-intro-divider" aria-hidden="true"></div>

                <div class="auth-intro-stats">
                    <div class="auth-intro-stat">
                        <strong>99.99%</strong>
                        <span>{{ __('messages.uptime') }} SLA</span>
                    </div>
                    <div class="auth-intro-stat">
                        <strong>24 / 7</strong>
                        <span>{{ __('messages.support') }}</span>
                    </div>
                    <div class="auth-intro-stat">
                        <strong>DDoS</strong>
                        <span>{{ __('messages.protection') }}</span>
                    </div>
                </div>
            </div>

            <div class="auth-intro-foot">
                <span>© {{ date('Y') }} 24racks · ES</span>
                <a href="https://status.24racks.com" target="_blank" rel="noopener noreferrer">{{ __('messages.network_status') }} ↗</a>
            </div>
        </section>

        <section class="auth-panel">
            <div class="auth-panel-top">
                <a href="/" class="auth-back-link" wire:navigate>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    {{ __('messages.go_to_home') }}
                </a>

                <button class="theme-toggle" type="button" data-theme-toggle data-tooltip-target="tooltip-dark" onclick="toggleDarkmode()" aria-label="{{ __('messages.toggle_color_mode') }}" aria-pressed="false">
                    @include('theme::layouts.theme-toggle-icon')
                    <span class="theme-toggle-text">{{ __('messages.dark_mode') }}</span>
                </button>
                <div id="tooltip-dark" role="tooltip" class="tooltip hidden">
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>

            <div class="auth-card rack-card">
                @yield('content')
            </div>
        </section>
    </main>
</body>
</html>
