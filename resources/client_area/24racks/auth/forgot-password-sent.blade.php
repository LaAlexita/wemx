@extends('theme::auth.wrapper')

@section('title', __('messages.password_reset_email_sent'))

@section('content')
    @php($email = request()->get('email'))

    <div class="auth-form auth-form--success">
        <div class="auth-form-header">
            <div class="auth-form-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m4 7 8 6 8-6"/>
                    <rect x="4" y="5" width="16" height="14" rx="2"/>
                </svg>
            </div>
            <span class="auth-form-eyebrow">{{ __('messages.password_reset') }}</span>
            <h1 class="auth-form-title">{{ __('messages.check_your_email') }}</h1>
            <p class="auth-form-subtitle">
                {!! __('messages.password_reset_email_sent_to', [
                    'email' => '<strong class="auth-form-email">' . e($email ?: '—') . '</strong>'
                ]) !!}
            </p>
        </div>

        <div class="auth-form-actions">
            <a href="{{ route('login') }}" class="btn btn-primary auth-form-submit" wire:navigate>
                {{ __('messages.back_to_sign_in') }}
            </a>
        </div>
    </div>
@endsection
