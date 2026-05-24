<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component
{
    public $username = '';

    public $password = '';

    public $remember = false;

    public function handleLogin()
    {
        $this->resetErrorBag();

        User::authActions()->loginAsClient([
            'username' => $this->username,
            'password' => $this->password,
            'remember' => $this->remember,
        ]);

        $this->redirect('/');
    }
}

?>


<form class="auth-form" wire:submit="handleLogin">
    <div class="auth-form-header">
        <span class="auth-form-eyebrow">{{ __('messages.sign_in') }}</span>
        <h1 class="auth-form-title">{{ __('messages.welcome_back') }}</h1>
        <p class="auth-form-subtitle">{{ __('messages.auth_login_subtitle') }}</p>
    </div>

    @foreach(extensionElements(['client-login-top-view']) as $element)
        @includeIf($element['view'])
    @endforeach

    @include('theme::auth.partials.social-buttons', ['context' => 'login'])

    <div class="auth-form-fields">
        <div class="auth-field">
            <label for="username" class="auth-field-label">{{ __('messages.email_or_username') }}</label>
            <input type="text" id="username" wire:model="username" autocomplete="username"
                   class="auth-input" placeholder="you@24racks.com">
            @error('username')
                <span class="auth-field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <div class="auth-field-label-row">
                <label for="password" class="auth-field-label">{{ __('messages.password') }}</label>
                <a href="{{ route('forgot-password') }}" class="auth-field-link" wire:navigate>
                    {{ __('messages.forgot_password') }}
                </a>
            </div>
            <div class="auth-input-wrap" data-password-wrap>
                <input type="password" id="password" wire:model="password"
                       class="auth-input auth-input--password" placeholder="••••••••" autocomplete="current-password">
                <button type="button" class="auth-input-toggle" data-password-toggle aria-label="{{ __('messages.show_password') }}">
                    <svg class="auth-input-toggle-show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="auth-input-toggle-hide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M9.88 9.88a3 3 0 0 0 4.24 4.24"/>
                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c6.5 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                        <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3.5 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                        <line x1="2" y1="2" x2="22" y2="22"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <span class="auth-field-error">{{ $message }}</span>
            @enderror
        </div>

        <label class="auth-checkbox">
            <input type="checkbox" wire:model="remember">
            <span class="auth-checkbox-box" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </span>
            <span class="auth-checkbox-label">{{ __('messages.remember_me') }}</span>
        </label>
    </div>

    <div class="auth-form-actions">
        <button type="submit" class="btn btn-primary auth-form-submit">
            <span wire:loading.remove wire:target="handleLogin">{{ __('messages.sign_in_to_your_account') }}</span>
            <span wire:loading wire:target="handleLogin" class="auth-form-submit-loading">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
                    <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                </svg>
                {{ __('messages.signing_in') }}
            </span>
        </button>
    </div>

    @foreach(extensionElements(['client-login-bottom-view']) as $element)
        @includeIf($element['view'])
    @endforeach

    @if(settings('enable_registrations', true))
        <div class="auth-form-divider">
            <span>{{ __('messages.or') }}</span>
        </div>
        <p class="auth-form-foot">
            {{ __('messages.dont_have_an_account') }}
            <a href="{{ route('register') }}" class="auth-form-foot-link" wire:navigate>
                {{ __('messages.create_account') }}
            </a>
        </p>
    @endif
</form>

<script>
    (function () {
        function bindToggles() {
            document.querySelectorAll('[data-password-toggle]').forEach((btn) => {
                if (btn.dataset.bound) return;
                btn.dataset.bound = '1';
                btn.addEventListener('click', () => {
                    const wrap = btn.closest('[data-password-wrap]');
                    const input = wrap?.querySelector('input');
                    if (!input) return;
                    const isPassword = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPassword ? 'text' : 'password');
                    wrap.classList.toggle('is-visible', isPassword);
                });
            });
        }
        bindToggles();
        document.addEventListener('livewire:navigated', bindToggles);
    })();
</script>
