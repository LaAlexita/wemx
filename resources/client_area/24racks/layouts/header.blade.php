@props([
    'activePage' => '',
])

<header id="site-header" class="site-header">
    <div class="site-header-inner">
        <a href="/" class="site-brand" aria-label="{{ __('messages.go_to_home') }}" wire:navigate>
            <img class="site-logo" src="https://24racks.com/storage/products/logo1.webp" alt="{{ settings('app_name', '24racks Cloud') }} logo">
        </a>

        <nav class="site-nav" aria-label="{{ __('messages.main_navigation') }}">
            <a href="{{ route('dashboard') }}" wire:navigate class="site-nav-link @if($activePage === 'dashboard') is-active @endif">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                {{ __('messages.panel') }}
            </a>
            <a href="{{ route('categories.index') }}?type=vps" wire:navigate class="site-nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="2" y="3" width="20" height="6" rx="1.5"/><rect x="2" y="15" width="20" height="6" rx="1.5"/>
                    <path d="M6 6h.01M6 18h.01"/>
                </svg>
                {{ __('messages.vps') }}
            </a>
            <a href="{{ route('categories.index') }}?type=dedicated" wire:navigate class="site-nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="5" y="2" width="14" height="20" rx="2"/>
                    <path d="M9 6h6M9 10h6M9 14h4"/>
                </svg>
                {{ __('messages.dedicated') }}
            </a>
            <a href="{{ route('categories.index') }}?type=game" wire:navigate class="site-nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="2" y="7" width="20" height="11" rx="3"/>
                    <path d="M7 12h3M8.5 10.5v3M15 11h.01M17 13h.01"/>
                </svg>
                {{ __('messages.games') }}
            </a>
            <a href="{{ route('categories.index') }}" wire:navigate class="site-nav-link @if($activePage === 'categories') is-active @endif">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                </svg>
                {{ __('messages.services') }}
            </a>

            @foreach(extensionElements(['navigation-item']) as $element)
                <a href="{{ $element['attributes']['href'] ?? '#' }}" wire:navigate class="site-nav-link @if($activePage == ($element['attributes']['active'] ?? null)) is-active @endif">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"/><path d="M9 9h.01M15 9h.01M9 14a4 4 0 0 0 6 0"/>
                    </svg>
                    {{ $element['attributes']['name'] ?? 'Link' }}
                </a>
            @endforeach
        </nav>

        <div class="site-actions">
            <button class="theme-toggle" type="button" data-theme-toggle data-tooltip-target="tooltip-dark" onclick="toggleDarkmode()" aria-label="{{ __('messages.toggle_color_mode') }}" aria-pressed="false">
                @include('theme::layouts.theme-toggle-icon')
                <span class="theme-toggle-text">{{ __('messages.dark_mode') }}</span>
            </button>
            <div id="tooltip-dark" role="tooltip" class="tooltip hidden">
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            <div class="desktop-only">
                @livewire(client_view_path('livewire.widgets.currency-dropdown'))
            </div>

            @auth
                @php($unreadEmailCount = auth()->user()->emails()->where('seen_at', null)->count())
                <a href="{{ route('dashboard.email-inbox') }}" wire:navigate class="site-icon-button notif-bell desktop-only" aria-label="{{ __('messages.email_inbox') }}{{ $unreadEmailCount ? ' ('.__('messages.unread_count_aria', ['count' => $unreadEmailCount]).')' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    @if($unreadEmailCount > 0)
                        <span class="notif-dot" aria-hidden="true"></span>
                        <span class="sr-only">{{ __('messages.unread_count_aria', ['count' => $unreadEmailCount]) }}</span>
                    @endif
                </a>
            @endauth

            <div class="desktop-only">
                @livewire(client_view_path('livewire.widgets.cart-nav-dropdown'))
            </div>

            @auth
                <button
                    type="button"
                    id="user-menu-button"
                    data-dropdown-toggle="user-dropdown"
                    class="desktop-only site-nav-button"
                    aria-expanded="false"
                >
                    <img class="h-7 w-7 rounded-full object-cover" src="{{ auth()->user()->getAvatarUrl() }}" alt="Avatar de {{ auth()->user()->full_name }}">
                    <span class="hidden xl:inline max-w-[120px] truncate">{{ auth()->user()->username ?? auth()->user()->first_name }}</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>

                <div id="user-dropdown" class="z-50 hidden">
                    <div class="user-dropdown-header">
                        <p class="user-dropdown-name">{{ auth()->user()->full_name }}</p>
                        <p class="user-dropdown-email truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <ul>
                        <li><a href="{{ route('account.settings') }}" wire:navigate>{{ __('messages.account_settings') }}</a></li>
                        <li><a href="{{ route('subscriptions.index') }}" wire:navigate>{{ __('messages.subscriptions') }}</a></li>
                        @foreach(extensionElements('client-dropdown-item') as $element)
                            <li>
                                <a href="{{ $element['attributes']['href'] }}"
                                   @isset($element['attributes']['target']) target="{{ $element['attributes']['target'] }}" @endisset
                                   @isset($element['attributes']['navigate']) wire:navigate @endisset>
                                    {{ $element['attributes']['name'] }}
                                </a>
                            </li>
                        @endforeach
                        @if(auth()->user()->isStaff())
                            <li><a href="{{ route('admin.index') }}" class="admin-link">{{ __('messages.admin_panel') }}</a></li>
                        @endif
                    </ul>
                    <ul>
                        <li><a href="{{ route('logout') }}">{{ __('messages.sign_out') }}</a></li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary desktop-only">{{ __('messages.sign_in') }}</a>
                @if(settings('enable_registrations', true))
                    <a href="{{ route('register') }}" class="btn btn-primary desktop-only">{{ __('messages.sign_up') }}</a>
                @endif
            @endauth

            <details class="site-mobile-details">
                <summary class="site-icon-button" aria-label="{{ __('messages.open_menu') }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
                </summary>
                <div class="site-mobile-panel">
                    <a href="{{ route('dashboard') }}" wire:navigate class="site-nav-link">{{ __('messages.dashboard') }}</a>
                    <a href="{{ route('categories.index') }}" wire:navigate class="site-nav-link">{{ __('messages.services') }}</a>
                    <a href="{{ route('categories.index') }}?type=vps" wire:navigate class="site-nav-link">{{ __('messages.vps') }}</a>
                    <a href="{{ route('categories.index') }}?type=dedicated" wire:navigate class="site-nav-link">{{ __('messages.dedicated') }}</a>
                    <a href="{{ route('categories.index') }}?type=game" wire:navigate class="site-nav-link">{{ __('messages.game_hosting') }}</a>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-secondary">{{ __('messages.sign_in') }}</a>
                        @if(settings('enable_registrations', true))
                            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('messages.sign_up') }}</a>
                        @endif
                    @endguest
                </div>
            </details>
        </div>
    </div>
</header>

@if(session('impersonate'))
    <div class="max-w-screen-xl mx-auto px-4 mt-3">
        <div class="alert alert-warning">
            <span>
                {{ __('messages.impersonating_as') }}: <strong>{{ auth()->user()->username }}</strong>
                ({{ Str::mask(auth()->user()->email, '*', 3, strpos(auth()->user()->email, '@') - 3) }})
            </span>
            <x-theme::button.primary href="{{ route('admin.users.exit-impersonate') }}" text="{{ __('messages.exit') }}" />
        </div>
    </div>
@endif
