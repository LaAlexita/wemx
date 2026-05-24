<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component
{
    public $first_name = '';

    public $last_name = '';

    public $username = '';

    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public function handleRegistration()
    {
        $this->resetErrorBag();

        User::authActions()->registerAsClient([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'log_user_in' => true,
        ]);

        $this->redirect('/');
    }
}

?>


<form class="auth-form" wire:submit="handleRegistration">
    <div class="auth-form-header">
        <span class="auth-form-eyebrow">{{ __('messages.sign_up') }}</span>
        <h1 class="auth-form-title">{{ __('messages.create_account') }}</h1>
        <p class="auth-form-subtitle">{{ __('messages.auth_register_subtitle') }}</p>
    </div>

    @foreach(extensionElements(['client-register-top-view']) as $element)
        @includeIf($element['view'])
    @endforeach

    @include('theme::auth.partials.social-buttons', ['context' => 'register'])

    <div class="auth-form-fields">
        <div class="auth-field-row">
            <div class="auth-field">
                <label for="first_name" class="auth-field-label">{{ __('messages.first_name') }}</label>
                <input type="text" id="first_name" wire:model="first_name" autocomplete="given-name"
                       class="auth-input" placeholder="Carlos">
                @error('first_name')
                    <span class="auth-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-field">
                <label for="last_name" class="auth-field-label">{{ __('messages.last_name') }}</label>
                <input type="text" id="last_name" wire:model="last_name" autocomplete="family-name"
                       class="auth-input" placeholder="Pérez">
                @error('last_name')
                    <span class="auth-field-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="auth-field">
            <label for="username" class="auth-field-label">{{ __('messages.username') }}</label>
            <input type="text" id="username" wire:model="username" autocomplete="username"
                   class="auth-input" placeholder="cperez">
            @error('username')
                <span class="auth-field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="email" class="auth-field-label">{{ __('messages.email') }}</label>
            <input type="email" id="email" wire:model="email" autocomplete="email"
                   class="auth-input" placeholder="you@24racks.com">
            @error('email')
                <span class="auth-field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field-row">
            <div class="auth-field">
                <label for="password" class="auth-field-label">{{ __('messages.password') }}</label>
                <div class="auth-input-wrap" data-password-wrap>
                    <input type="password" id="password" wire:model="password"
                           class="auth-input auth-input--password" placeholder="••••••••" autocomplete="new-password">
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

            <div class="auth-field">
                <label for="password_confirmation" class="auth-field-label">{{ __('messages.confirm_password') }}</label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation"
                       class="auth-input" placeholder="••••••••" autocomplete="new-password">
                @error('password_confirmation')
                    <span class="auth-field-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="auth-form-actions">
        <button type="submit" class="btn btn-primary auth-form-submit">
            <span wire:loading.remove wire:target="handleRegistration">{{ __('messages.continue_to_verification') }}</span>
            <span wire:loading wire:target="handleRegistration" class="auth-form-submit-loading">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
                    <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                </svg>
                {{ __('messages.creating_account') }}
            </span>
        </button>
        <p class="auth-form-disclaimer">{{ __('messages.auth_register_disclaimer') }}</p>
    </div>

    @foreach(extensionElements(['client-register-bottom-view']) as $element)
        @includeIf($element['view'])
    @endforeach

    <div class="auth-form-divider">
        <span>{{ __('messages.or') }}</span>
    </div>
    <p class="auth-form-foot">
        {{ __('messages.already_have_an_account') }}
        <a href="{{ route('login') }}" class="auth-form-foot-link" wire:navigate>
            {{ __('messages.sign_in') }}
        </a>
    </p>
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
