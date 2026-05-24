<?php

use Livewire\Volt\Component;

new class extends Component
{
    // due to a global middleware checking for email verification, we can't use livewire methods as they call api in the background
}

?>

@php
    $verificationEmailsSent = auth()->user()->emails()->where('identifier', 'email_verification')->latest();
    $lastVerificationEmail = $verificationEmailsSent->first();
    $cooldown = 120;
    $lastSentAt = optional($lastVerificationEmail?->created_at)->timestamp ?? 0;
    $now = now()->timestamp;
    $remaining = max(0, $cooldown - ($now - $lastSentAt));
@endphp


<div class="auth-form auth-form--center">
    <div class="auth-form-header">
        <div class="auth-form-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m4 7 8 6 8-6"/>
                <rect x="4" y="5" width="16" height="14" rx="2"/>
            </svg>
        </div>
        <span class="auth-form-eyebrow">{{ __('messages.verify_email') }}</span>
        <h1 class="auth-form-title">{{ __('messages.verify_your_email_address') }}</h1>
        <p class="auth-form-subtitle">
            {{ __('messages.verify_email_instructions') }}
        </p>
        <p class="auth-form-meta">
            {{ __('messages.weve_emailed_link_to') }}
            <strong class="auth-form-email">{{ auth()->user()->email }}</strong>
        </p>
    </div>

    @if($verificationEmailsSent->count() <= 6)
        <div class="auth-form-resend">
            <span class="auth-form-resend-label">{{ __('messages.didnt_receive_email') }}</span>
            <span id="resend-wrapper">
                @if ($remaining > 0)
                    <span class="auth-form-resend-cooldown">
                        {{ __('messages.please_wait') }} <span id="cooldown">{{ $remaining }}</span>s
                    </span>
                @else
                    <a id="resend-button" href="{{ route('resend-verify-email') }}"
                       class="auth-form-foot-link" wire:navigate>{{ __('messages.resend_email') }}</a>
                @endif
            </span>
        </div>
    @endif

    <div class="auth-form-divider">
        <span>{{ __('messages.or') }}</span>
    </div>

    <a href="{{ route('logout') }}" onclick="return confirm('{{ __('messages.are_you_sure') }}');"
       class="auth-form-foot-link auth-form-foot-link--danger">{{ __('messages.logout') }}</a>
</div>

<script>
    document.addEventListener('livewire:navigated', (event) => {
        const cooldownSpan = document.getElementById('cooldown');
        const resendWrapper = document.getElementById('resend-wrapper');

        if (!cooldownSpan) return;

        let seconds = parseInt(cooldownSpan.textContent);

        const interval = setInterval(() => {
            seconds--;

            if (seconds <= 0) {
                clearInterval(interval);

                resendWrapper.innerHTML = `
                    <a id="resend-button"
                       href="{{ route('resend-verify-email') }}" wire:navigate
                       class="auth-form-foot-link"
                    >{{ __('messages.resend_email') }}</a>
                `;
            } else {
                cooldownSpan.textContent = seconds;
            }
        }, 1000);
    });
</script>
