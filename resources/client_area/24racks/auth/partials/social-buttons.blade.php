@php
    $providers = collect([
        ['key' => 'google',  'enabled' => settings('oauth::google_enabled', false),  'route' => 'oauth.google',  'label' => 'Google'],
        ['key' => 'discord', 'enabled' => settings('oauth::discord_enabled', false), 'route' => 'oauth.discord', 'label' => 'Discord'],
        ['key' => 'github',  'enabled' => settings('oauth::github_enabled', false),  'route' => 'oauth.github',  'label' => 'GitHub'],
    ])->filter(fn($p) => $p['enabled'] && \Illuminate\Support\Facades\Route::has($p['route']));
@endphp

@if($providers->isNotEmpty())
    <div class="auth-form-social">
        @foreach($providers as $provider)
            <a href="{{ route($provider['route']) }}" class="auth-form-social-btn auth-form-social-btn--{{ $provider['key'] }}">
                @if($provider['key'] === 'google')
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#EA4335" d="M12 5.04c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.46 1.7 14.97.74 12 .74 7.32.74 3.27 3.43 1.31 7.36l3.67 2.84C5.95 7.34 8.75 5.04 12 5.04z"/>
                        <path fill="#4285F4" d="M23.04 12.26c0-.86-.07-1.69-.21-2.49H12v4.71h6.21c-.27 1.43-1.08 2.65-2.3 3.46l3.55 2.75c2.08-1.92 3.28-4.74 3.28-8.43z"/>
                        <path fill="#FBBC05" d="M4.98 14.2c-.21-.63-.33-1.31-.33-2.0s.12-1.37.33-2.0L1.31 7.36C.63 8.71.24 10.31.24 12.2s.39 3.49 1.07 4.84l3.67-2.84z"/>
                        <path fill="#34A853" d="M12 23.66c3.24 0 5.95-1.07 7.94-2.92l-3.55-2.75c-.99.66-2.26 1.06-3.84 1.06-2.95 0-5.45-1.99-6.34-4.66L2.54 17.2C4.5 21.13 8.55 23.66 12 23.66z"/>
                    </svg>
                @elseif($provider['key'] === 'discord')
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M20.32 4.37A19.79 19.79 0 0 0 16.06 3c-.21.37-.45.86-.61 1.25a18.27 18.27 0 0 0-5.5 0A12.8 12.8 0 0 0 9.34 3a19.74 19.74 0 0 0-4.26 1.37C2.06 8.94 1.31 13.4 1.69 17.79a19.91 19.91 0 0 0 5.6 2.85c.45-.62.85-1.27 1.2-1.96-.65-.24-1.27-.54-1.86-.89.16-.12.32-.24.47-.36 3.6 1.66 7.49 1.66 11.04 0 .15.13.31.25.47.36-.59.35-1.21.65-1.86.89.34.69.74 1.34 1.2 1.96a19.91 19.91 0 0 0 5.59-2.85c.45-5.07-.74-9.49-3.43-13.42zM8.52 15.32c-1.06 0-1.93-.99-1.93-2.2s.85-2.2 1.93-2.2c1.08 0 1.95.99 1.93 2.2 0 1.21-.85 2.2-1.93 2.2zm7.13 0c-1.06 0-1.93-.99-1.93-2.2s.85-2.2 1.93-2.2c1.08 0 1.95.99 1.93 2.2 0 1.21-.85 2.2-1.93 2.2z"/>
                    </svg>
                @elseif($provider['key'] === 'github')
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 .5C5.65.5.5 5.66.5 12.04c0 5.1 3.29 9.43 7.86 10.96.58.11.79-.25.79-.56v-2c-3.2.7-3.87-1.39-3.87-1.39-.52-1.34-1.28-1.7-1.28-1.7-1.04-.72.08-.7.08-.7 1.16.08 1.77 1.2 1.77 1.2 1.03 1.77 2.7 1.26 3.36.96.1-.75.4-1.26.73-1.55-2.55-.29-5.24-1.29-5.24-5.72 0-1.27.45-2.3 1.18-3.11-.12-.29-.51-1.46.11-3.05 0 0 .98-.31 3.2 1.18a11 11 0 0 1 5.83 0c2.22-1.5 3.2-1.18 3.2-1.18.62 1.6.23 2.77.11 3.05.74.81 1.18 1.84 1.18 3.11 0 4.45-2.69 5.42-5.26 5.71.42.36.78 1.07.78 2.15v3.19c0 .31.21.68.8.56 4.56-1.53 7.85-5.87 7.85-10.96C23.5 5.66 18.35.5 12 .5z"/>
                    </svg>
                @endif
                <span>{{ __('messages.continue_with', ['provider' => $provider['label']]) }}</span>
            </a>
        @endforeach
    </div>

    <div class="auth-form-divider">
        <span>{{ __('messages.or_continue_with_email') }}</span>
    </div>
@endif
