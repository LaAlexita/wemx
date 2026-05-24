@extends('theme::layouts.wrapper', [
    'activePage' => 'dashboard',
])

@section('title', __('messages.dashboard'))

@section('content')
@php
    $user = auth()->user();
    $activeOrdersCount = $user->orders()->whereStatus('active')->count();
    $suspendedOrdersCount = $user->orders()->whereStatus('suspended')->count();
    $terminatedOrdersCount = $user->orders()->whereStatus('terminated')->count();
    $activeSubscriptionsCount = $user->subscriptions()->where(function ($query) {
        $query->where('status', 'active')
            ->orWhere(function ($q) {
                $q->where('status', 'cancelled')
                    ->whereNotNull('next_billing_at')
                    ->where('next_billing_at', '>', now());
            });
    })->count();
    $totalSubscriptionsCount = $user->subscriptions()->count();
    $paidPaymentsCount = $user->payments()->whereStatus('paid')->count();
    $pendingPaymentsCount = $user->payments()->whereStatus('pending')->count();
@endphp

<div class="dashboard-grid reveal-delay-1">

    {{-- ═══════════════════════════════════════
        SIDEBAR
    ═══════════════════════════════════════ --}}
    <aside class="dashboard-sidebar stack-md">

        {{-- Profile mini-card --}}
        <div class="rack-card profile-mini">
            <div class="profile-mini-accent"></div>
            <div class="profile-mini-body">
                <div class="profile-mini-head">
                    <div class="profile-mini-avatar">
                        <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->full_name }}">
                        <span class="profile-mini-status" title="{{ __('messages.online') }}"></span>
                    </div>
                    <div class="profile-mini-info">
                        <p class="profile-mini-eyebrow">{{ __('messages.my_account') }}</p>
                        <h2 class="profile-mini-name">{{ $user->full_name }}</h2>
                        <p class="profile-mini-email">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="profile-mini-row">
                    <span class="profile-mini-row-label">{{ __('messages.credit') }}</span>
                    <span class="profile-mini-row-value is-brand">{{ price($user->balance) }}</span>
                </div>

                <div class="profile-mini-row">
                    <span class="profile-mini-row-label">{{ __('messages.security_2fa') }}</span>
                    @if($user->tfa_enabled)
                        <span class="status-badge status-badge--online">{{ __('messages.active') }}</span>
                    @else
                        <span class="status-badge status-badge--offline">{{ __('messages.inactive') }}</span>
                    @endif
                </div>

                <div class="profile-mini-row" style="border-bottom: 1px solid var(--border-dim); padding-bottom: 14px;">
                    <a href="#"
                       class="profile-mini-action"
                       data-drawer-target="add-balance-drawer"
                       data-drawer-show="add-balance-drawer"
                       data-drawer-placement="right"
                       aria-controls="add-balance-drawer">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('messages.add_funds') }}
                    </a>
                    @if($user->tfa_enabled)
                        <a href="{{ route('disable-2fa') }}" wire:navigate
                           class="profile-mini-action" style="color: var(--danger);">{{ __('messages.deactivate_arrow') }}</a>
                    @else
                        <a href="{{ route('enable-2fa') }}" wire:navigate class="profile-mini-action">{{ __('messages.activate_arrow') }}</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Side navigation (quick links). Active state driven by $activePage. --}}
        @php($side = $activePage ?? 'dashboard')
        <nav class="side-nav" aria-label="{{ __('messages.shortcuts') }}">
            <span class="side-nav-label">{{ __('messages.shortcuts') }}</span>

            <a href="{{ route('dashboard') }}" wire:navigate class="side-nav-link @if($side === 'dashboard') is-active @endif">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                {{ __('messages.dashboard') }}
            </a>
            <a href="{{ route('account.settings') }}" wire:navigate class="side-nav-link @if($side === 'account-settings') is-active @endif">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
                {{ __('messages.account_settings') }}
            </a>
            <a href="{{ route('subscriptions.index') }}" wire:navigate class="side-nav-link @if($side === 'subscriptions') is-active @endif">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 1 1-9-9"/><path d="M21 3v6h-6"/>
                </svg>
                {{ __('messages.subscriptions') }}
            </a>
            <a href="{{ route('dashboard.email-inbox') }}" wire:navigate class="side-nav-link @if($side === 'email-inbox') is-active @endif">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16v12H4z"/><path d="m4 7 8 6 8-6"/>
                </svg>
                {{ __('messages.inbox') }}
            </a>
            <a href="{{ route('dashboard.payments') }}" wire:navigate class="side-nav-link @if($side === 'payments') is-active @endif">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="6" width="20" height="12" rx="2"/><path d="M2 10h20M6 14h2"/>
                </svg>
                {{ __('messages.invoices') }}
            </a>
            <a href="{{ route('categories.index') }}" wire:navigate class="side-nav-link @if($side === 'categories') is-active @endif">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 7l9-4 9 4-9 4-9-4z"/><path d="M3 12l9 4 9-4M3 17l9 4 9-4"/>
                </svg>
                {{ __('messages.services') }}
            </a>
        </nav>

        {{-- Extension sidebar widgets --}}
        @foreach(extensionElements(['client-dashboard-sidebar-view']) as $element)
            <div class="rack-card p-5">
                @includeIf($element['view'], ['user' => $user])
            </div>
        @endforeach
    </aside>

    {{-- ═══════════════════════════════════════
        MAIN CONTENT
    ═══════════════════════════════════════ --}}
    <div class="dashboard-main stack-lg">

        {{-- Welcome row — eyebrow + name + date + status --}}
        <div class="welcome-row reveal-delay-1">
            <div class="welcome-row-text">
                <p class="welcome-row-eyebrow">{{ __('messages.welcome_back') }}</p>
                <h1 class="welcome-row-title">{{ $user->first_name }}</h1>
                <p class="welcome-row-meta">{{ now()->locale(app()->getLocale())->isoFormat('LLLL') }} · AS214340</p>
            </div>
            <div class="welcome-row-pulse">
                <span class="status-dot is-info"></span>
                {{ __('messages.network_operational') }}
            </div>
        </div>

        {{-- KPI grid --}}
        <div class="kpi-grid reveal-on-scroll">

            <div class="kpi-card reveal-child {{ $activeOrdersCount > 0 ? 'is-accent' : '' }}">
                <div class="kpi-card-head">
                    <span class="kpi-card-label">{{ __('messages.active_services') }}</span>
                    <span class="kpi-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="8" rx="2"/>
                            <rect x="2" y="14" width="20" height="8" rx="2"/>
                            <circle cx="6" cy="6" r=".8" fill="currentColor"/>
                            <circle cx="6" cy="18" r=".8" fill="currentColor"/>
                        </svg>
                    </span>
                </div>
                <p class="kpi-card-value" data-counter="{{ $activeOrdersCount }}">{{ $activeOrdersCount }}</p>
                <p class="kpi-card-meta">
                    {{ __('messages.suspended_terminated_meta', ['suspended' => $suspendedOrdersCount, 'terminated' => $terminatedOrdersCount]) }}
                </p>
            </div>

            <div class="kpi-card reveal-child">
                <div class="kpi-card-head">
                    <span class="kpi-card-label">{{ __('messages.available_credit') }}</span>
                    <span class="kpi-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </span>
                </div>
                <p class="kpi-card-value" style="color: var(--brand);">{{ price($user->balance) }}</p>
                <p class="kpi-card-meta">{{ __('messages.account_balance') }}</p>
            </div>

            <div class="kpi-card reveal-child">
                <div class="kpi-card-head">
                    <span class="kpi-card-label">{{ __('messages.subscriptions') }}</span>
                    <span class="kpi-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </span>
                </div>
                <p class="kpi-card-value" data-counter="{{ $activeSubscriptionsCount }}">{{ $activeSubscriptionsCount }}</p>
                <p class="kpi-card-meta">{{ __('messages.active_of_total', ['total' => $totalSubscriptionsCount]) }}</p>
            </div>

            <div class="kpi-card reveal-child">
                <div class="kpi-card-head">
                    <span class="kpi-card-label">{{ __('messages.paid_invoices') }}</span>
                    <span class="kpi-card-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                </div>
                <p class="kpi-card-value" data-counter="{{ $paidPaymentsCount }}">{{ $paidPaymentsCount }}</p>
                <p class="kpi-card-meta">
                    @if($pendingPaymentsCount > 0)
                        {{ $pendingPaymentsCount }} {{ __('messages.pending_lower') }}
                    @else
                        {{ __('messages.no_pending_invoices') }}
                    @endif
                </p>
            </div>
        </div>

        {{-- Extension top views --}}
        @foreach(extensionElements(['client-dashboard-top-view']) as $element)
            <div class="rack-card p-5">
                @includeIf($element['view'], ['user' => $user])
            </div>
        @endforeach

        {{-- Main container content --}}
        <div class="reveal-delay-3 stack-lg">
            @yield('container')
        </div>

        {{-- Extension bottom views --}}
        @foreach(extensionElements(['client-dashboard-bottom-view']) as $element)
            <div class="rack-card p-5">
                @includeIf($element['view'], ['user' => $user])
            </div>
        @endforeach
    </div>

</div>

{{-- Balance drawer (hidden until triggered) --}}
@livewire(client_view_path('dashboard.livewire.add-balance-drawer'))

@endsection
