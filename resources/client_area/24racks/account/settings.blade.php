@extends('theme::layouts.wrapper', [
    'activePage' => 'account-settings',
])

@section('title', __('messages.account_settings'))

@section('content')
    <div class="page-header reveal-delay-1">
        <div class="page-header-text">
            <p class="page-header-eyebrow">{{ __('messages.account') }}</p>
            <h1 class="page-header-title">{{ __('messages.account_settings') }}</h1>
            <p class="page-header-subtitle">{{ __('messages.account_settings_subtitle') }}</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('dashboard') }}" wire:navigate class="btn btn-secondary btn-sm">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                {{ __('messages.back_to_panel') }}
            </a>
        </div>
    </div>

    @livewire(client_view_path('account.livewire.account-settings'))
@endsection
