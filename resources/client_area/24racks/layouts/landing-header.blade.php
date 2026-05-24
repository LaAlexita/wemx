{{--
    24racks Cloud — Landing header partial
    Mismo wrapper visual que layouts/header.blade.php (área cliente).
    Solo cambia el contenido de la nav: enlaces de marketing en lugar de panel.
--}}
@props(['activeAnchor' => null])

<header id="site-header" class="site-header">
    <div class="site-header-inner">
        <a href="/" class="site-brand" aria-label="Inicio">
            <picture>
                <source media="(max-width: 720px)" srcset="https://beta.24racks.com/assets/common/img/logo-6.png">
                <img class="site-logo" src="https://24racks.com/storage/products/logo1.webp" alt="{{ settings('app_name', '24racks Cloud') }} logo">
            </picture>
        </a>

        <nav class="site-nav" aria-label="Navegación principal">
            <div class="site-dropdown" data-dropdown>
                <button type="button" class="site-nav-link site-dropdown-trigger" aria-haspopup="true" aria-expanded="false">
                    Servicios
                    <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>
                <div class="site-dropdown-menu" role="menu">
                    <a href="/#vps-section" class="site-dropdown-item" role="menuitem">
                        <span class="site-dropdown-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="4" width="18" height="6" rx="1.5"/><rect x="3" y="14" width="18" height="6" rx="1.5"/><path d="M7 7h.01M7 17h.01"/>
                            </svg>
                        </span>
                        <span class="site-dropdown-text">
                            <span class="site-dropdown-title">VPS</span>
                            <span class="site-dropdown-desc">Ryzen, Xeon y económicos</span>
                        </span>
                    </a>
                    <a href="{{ route('categories.index') }}?type=dedicated" class="site-dropdown-item" role="menuitem">
                        <span class="site-dropdown-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h8M8 11h8M8 15h4"/>
                            </svg>
                        </span>
                        <span class="site-dropdown-text">
                            <span class="site-dropdown-title">Dedicados</span>
                            <span class="site-dropdown-desc">Hardware exclusivo, sin compartir</span>
                        </span>
                    </a>
                    <a href="/#game-section" class="site-dropdown-item" role="menuitem">
                        <span class="site-dropdown-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="7" width="18" height="10" rx="3"/><path d="M8 12h4M10 10v4M17 11h.01M19 13h.01"/>
                            </svg>
                        </span>
                        <span class="site-dropdown-text">
                            <span class="site-dropdown-title">Game hosting</span>
                            <span class="site-dropdown-desc">FiveM, Minecraft y más</span>
                        </span>
                    </a>
                    <a href="{{ route('categories.index') }}" class="site-dropdown-item" role="menuitem">
                        <span class="site-dropdown-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>
                            </svg>
                        </span>
                        <span class="site-dropdown-text">
                            <span class="site-dropdown-title">Catálogo completo</span>
                            <span class="site-dropdown-desc">Todos los servicios disponibles</span>
                        </span>
                    </a>
                </div>
            </div>

            <a href="/#antiddos-section" class="site-nav-link @if($activeAnchor === 'antiddos') is-active @endif">Anti-DDoS</a>
            <a href="/#network-section" class="site-nav-link @if($activeAnchor === 'network') is-active @endif">Red</a>
            <a href="/#testimonials-section" class="site-nav-link">Opiniones</a>
            <a href="https://discord.gg/njjhDfYW6m" target="_blank" rel="noopener noreferrer" class="site-nav-link">Discord</a>
        </nav>

        <div class="site-actions">
            <button class="theme-toggle" type="button" data-theme-toggle data-tooltip-target="tooltip-dark" onclick="toggleDarkmode()" aria-label="Cambiar modo de color" aria-pressed="false">
                @include('theme::layouts.theme-toggle-icon')
                <span class="theme-toggle-text">Modo oscuro</span>
            </button>
            <div id="tooltip-dark" role="tooltip" class="tooltip hidden">
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary desktop-only">Área de clientes</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost desktop-only">Iniciar sesión</a>
                @if(settings('enable_registrations', true))
                    <a href="{{ route('register') }}" class="btn btn-primary desktop-only">Registrarse</a>
                @endif
            @endauth

            <details class="site-mobile-details">
                <summary class="site-icon-button" aria-label="Abrir menú">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
                </summary>
                <div class="site-mobile-panel">
                    <span class="site-mobile-label">Servicios</span>
                    <a href="/#vps-section" class="site-nav-link">VPS</a>
                    <a href="{{ route('categories.index') }}?type=dedicated" class="site-nav-link">Dedicados</a>
                    <a href="/#game-section" class="site-nav-link">Game hosting</a>
                    <a href="{{ route('categories.index') }}" class="site-nav-link">Catálogo</a>
                    <span class="site-mobile-divider"></span>
                    <a href="/#antiddos-section" class="site-nav-link">Anti-DDoS</a>
                    <a href="/#network-section" class="site-nav-link">Red</a>
                    <a href="/#testimonials-section" class="site-nav-link">Opiniones</a>
                    <a href="https://discord.gg/njjhDfYW6m" target="_blank" rel="noopener noreferrer" class="site-nav-link">Discord</a>
                    <span class="site-mobile-divider"></span>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-ghost">Iniciar sesión</a>
                        @if(settings('enable_registrations', true))
                            <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                        @endif
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Área de clientes</a>
                    @endguest
                </div>
            </details>
        </div>
    </div>
</header>
