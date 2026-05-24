@extends('theme::layouts.wrapper', [
    'activePage' => 'dashboard',
])

@section('title', __('messages.service_number_label', ['id' => $order->id]))

@if(in_array($order->status, ['pending', 'processing', 'failed']))
    @section('content')
        @livewire(client_view_path('orders.livewire.waiting-screen'), ['order' => $order])
    @endsection

@else
    @section('content')
        @php
            $statusBadge = match($order->status) {
                'active' => ['class' => 'status-badge--online', 'label' => __('messages.active')],
                'suspended' => ['class' => 'status-badge--warning', 'label' => __('messages.suspended')],
                'terminated' => ['class' => 'status-badge--danger', 'label' => __('messages.terminated')],
                default => ['class' => 'status-badge--info', 'label' => ucfirst($order->status)],
            };
        @endphp

        <div class="page-header reveal-delay-1">
            <div class="page-header-text">
                <p class="page-header-eyebrow">{{ __('messages.service_number_label', ['id' => $order->id]) }}</p>
                <h1 class="page-header-title">{{ $order->package->name ?? __('messages.service') }}</h1>
                @if($order->description ?? false)
                    <p class="page-header-subtitle">{{ $order->description }}</p>
                @endif
                <div class="page-header-meta">
                    <span>{{ __('messages.created_on_date', ['date' => $order->created_at->format('d M Y')]) }}</span>
                    @if($order->due_date)
                        <span>{{ __('messages.next_due_date', ['date' => $order->due_date->format('d M Y')]) }}</span>
                    @endif
                </div>
            </div>
            <div class="page-header-actions">
                <span class="status-badge {{ $statusBadge['class'] }}">{{ $statusBadge['label'] }}</span>
                @if($order->status === 'active' && $order->due_date && $order->due_date->lessThan(now()->addDays(30)))
                    <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        data-drawer-target="renew-order-drawer"
                        data-drawer-show="renew-order-drawer"
                        data-drawer-placement="right"
                        aria-controls="renew-order-drawer">
                        {{ __('messages.renew_service') }}
                    </button>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[260px_minmax(0,1fr)] gap-6 reveal-delay-2">
            <aside>
                <nav class="side-nav" aria-label="{{ __('messages.service_navigation') }}">
                    <span class="side-nav-label">{{ __('messages.service') }}</span>
                    <a href="{{ route('orders.view', $order->id) }}" wire:navigate class="side-nav-link {{ $activeTab === 'general' ? 'is-active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        {{ __('messages.general') }}
                    </a>
                    <a href="{{ route('orders.view.payments', ['order' => $order->id]) }}" wire:navigate class="side-nav-link {{ $activeTab === 'payments' ? 'is-active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="6" width="20" height="12" rx="2"/><path d="M2 10h20M6 14h2"/>
                        </svg>
                        {{ __('messages.payments') }}
                    </a>

                    @if($order->isRecurring() AND \App\Models\GatewayConfig::where('type', 'subscription')->where('is_active', true)->count() > 0)
                        <a href="{{ route('orders.view.subscription', ['order' => $order->id]) }}" wire:navigate class="side-nav-link {{ $activeTab === 'subscription' ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12a9 9 0 1 1-9-9"/><path d="M21 3v6h-6"/>
                            </svg>
                            {{ __('messages.subscription') }}
                        </a>
                    @endif

                    <a href="{{ route('orders.view.emails', ['order' => $order->id]) }}" wire:navigate class="side-nav-link {{ $activeTab === 'emails' ? 'is-active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16v12H4z"/><path d="m4 7 8 6 8-6"/>
                        </svg>
                        {{ __('messages.emails') }}
                    </a>
                    <a href="{{ route('orders.view.members', ['order' => $order->id]) }}" wire:navigate class="side-nav-link {{ $activeTab === 'members' ? 'is-active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75M22 21v-2a4 4 0 0 0-3-3.87"/>
                        </svg>
                        {{ __('messages.members') }}
                    </a>
                </nav>

                @foreach(extensionElements(['client-order-sidebar-bottom-view']) as $element)
                    <div class="mt-4">
                        @includeIf($element['view'], ['order' => $order])
                    </div>
                @endforeach
            </aside>

            <div class="min-w-0 stack-md">
                @yield('container')
            </div>
        </div>

        @livewire(client_view_path('orders.livewire.renew-order-drawer'), ['order' => $order])
    @endsection
@endif
