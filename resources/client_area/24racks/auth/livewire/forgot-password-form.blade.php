<?php

use Livewire\Volt\Component;

new class extends Component
{
    public $email = '';

    public function handlePasswordResetRequest()
    {
        $this->resetErrorBag();

        \App\Models\User::authActions()->requestPasswordAsClient([
            'email' => $this->email,
        ]);

        $this->redirect(route('forgot-password-sent', ['email' => $this->email]), true);
    }
}

?>


<form class="auth-form" wire:submit="handlePasswordResetRequest">
    <div class="auth-form-header">
        <span class="auth-form-eyebrow">{{ __('messages.password_reset') }}</span>
        <h1 class="auth-form-title">{{ __('messages.forgot_your_password') }}</h1>
        <p class="auth-form-subtitle">{{ __('messages.auth_forgot_subtitle') }}</p>
    </div>

    <div class="auth-form-fields">
        <div class="auth-field">
            <label for="email" class="auth-field-label">{{ __('messages.email') }}</label>
            <input type="email" id="email" wire:model="email" autocomplete="email"
                   class="auth-input" placeholder="you@24racks.com">
            @error('email')
                <span class="auth-field-error">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="auth-form-actions">
        <button type="submit" class="btn btn-primary auth-form-submit">
            <span wire:loading.remove wire:target="handlePasswordResetRequest">{{ __('messages.send_reset_link') }}</span>
            <span wire:loading wire:target="handlePasswordResetRequest" class="auth-form-submit-loading">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
                    <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                </svg>
                {{ __('messages.sending') }}
            </span>
        </button>
    </div>

    <div class="auth-form-divider">
        <span>{{ __('messages.or') }}</span>
    </div>
    <p class="auth-form-foot">
        {{ __('messages.remember_your_password') }}
        <a href="{{ route('login') }}" class="auth-form-foot-link" wire:navigate>
            {{ __('messages.sign_in') }}
        </a>
    </p>
</form>
