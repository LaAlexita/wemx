@extends('theme::dashboard.dashboard-layout')

@section('container')

    @php
        $inviteCount = \App\Models\OrderMember::where('email', auth()->user()->email)->where('status', 'pending')->count();
        $renewingOrders = auth()->user()->orders()->where('status', 'active')->whereNotNull('due_date')->where('due_date', '<', now()->addDays(5))->get();
        $suspendedOrders = auth()->user()->orders()->where('status', 'suspended')->get();
    @endphp

    {{-- ── Pending Order Invites ── --}}
    @if($inviteCount > 0)
        <div class="alert alert-info reveal-delay-1">
            <svg class="alert-icon shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <div class="alert-body">
                <p class="alert-title">{{ __('messages.pending_invitations') }}</p>
                <p>{{ __('messages.pending_invitations_body', ['count' => $inviteCount]) }}</p>
            </div>
            <a href="{{ route('dashboard.order-invites') }}" wire:navigate class="btn btn-primary btn-sm shrink-0">
                {{ __('messages.review') }}
            </a>
        </div>
    @endif

    {{-- ── Renewal Warnings ── --}}
    @foreach($renewingOrders as $order)
        <div class="alert alert-warning reveal-delay-1">
            <svg class="alert-icon shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div class="alert-body">
                <p class="alert-title">{{ $order->package->name }} <span class="font-normal opacity-70 font-mono">#{{ $order->id }}</span></p>
                <p>{{ __('messages.expires_renew_message', ['time' => $order->due_date->diffForHumans()]) }}</p>
            </div>
            <a href="{{ route('orders.view', $order->id) }}" wire:navigate class="btn btn-secondary btn-sm shrink-0">
                {{ __('messages.renew') }}
            </a>
        </div>
    @endforeach

    {{-- ── Suspended Orders ── --}}
    @foreach($suspendedOrders as $order)
        <div class="alert alert-danger reveal-delay-1">
            <svg class="alert-icon shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
            </svg>
            <div class="alert-body">
                <p class="alert-title">{{ $order->package->name }} <span class="font-normal opacity-70 font-mono">#{{ $order->id }}</span> {{ __('messages.service_suspended_suffix') }}</p>
                <p>{{ __('messages.activate_to_avoid_deletion') }}</p>
            </div>
            <a href="{{ route('orders.view', $order->id) }}" wire:navigate class="btn btn-danger btn-sm shrink-0">
                {{ __('messages.activate') }}
            </a>
        </div>
    @endforeach

    {{-- ── Active Services workspace ── --}}
    <div class="reveal-delay-2">
        @livewire(client_view_path('orders.livewire.orders-table'))
    </div>

    {{-- ── Payment Ledger ── --}}
    <div class="reveal-delay-3">
        @livewire(client_view_path('livewire.table'), [
            'title'       => __('messages.payment_history'),
            'description' => __('messages.payment_history_desc'),
            'badge'       => __('messages.ledger'),
            'perPage'     => 5,
            'columns'     => [
                __('messages.description'),
                __('messages.gateway'),
                __('messages.transaction_id'),
                __('messages.amount'),
                __('messages.currency'),
                __('messages.status'),
                __('messages.date'),
                __('messages.actions'),
            ],
            'rows' =>
                auth()->user()->payments()->latest()->whereIn('status', ['paid', 'refunded'])->get()->map(function($payment) {
                    return [
                        Str::limit($payment->description, 50),
                        $payment->gatewayConfig ? $payment->gatewayConfig->display_name : '—',
                        $payment->transaction_id
                            ? '<span class="font-mono text-xs" style="color: var(--text-3);">' . Str::limit($payment->transaction_id, 18) . '</span>'
                            : '—',
                        '<span class="font-semibold" style="color: var(--text-1); font-variant-numeric: tabular-nums;">' . priceIn($payment->total(), $payment->currency) . '</span>',
                        '<span class="text-xs font-mono" style="color: var(--text-3);">' . $payment->currency . '</span>',
                        $payment->status === 'paid'
                            ? '<span class="status-badge status-badge--online">' . __('messages.paid') . '</span>'
                            : '<span class="status-badge status-badge--warning">' . __('messages.refunded') . '</span>',
                        '<span class="text-xs" style="color: var(--text-3);">' . ($payment->paid_at ? $payment->paid_at->format(settings('date_format', 'd M Y H:i')) : '—') . '</span>',
                        '<a href="' . route('payments.view', $payment->token) . '" wire:navigate class="text-sm font-semibold" style="color: var(--brand);">' . __('messages.view_invoice_arrow') . '</a>',
                    ];
                })->toArray(),
        ])
    </div>

@endsection
