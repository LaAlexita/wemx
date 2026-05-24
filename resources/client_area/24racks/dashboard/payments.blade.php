@extends('theme::dashboard.dashboard-layout', [
    'activePage' => 'payments',
])

@section('title', __('messages.invoices'))

@section('container')
    @livewire(client_view_path('livewire.table'), [
        'title' => __('messages.invoices_and_payments'),
        'description' => __('messages.invoices_table_desc'),
        'badge' => __('messages.historic'),
        'columns' => [
            __('messages.description'),
            __('messages.amount'),
            __('messages.currency'),
            __('messages.status'),
            __('messages.gateway'),
            __('messages.date'),
            __('messages.actions'),
        ],
        'rows' =>
            auth()->user()->payments->where('status', 'paid')->map(function($payment) {
                return [
                    '<span class="td-name">' . e($payment->description) . '</span>',
                    '<span style="font-variant-numeric: tabular-nums; color: var(--text-1); font-weight: 660;">' . priceIn($payment->total(), $payment->currency) . '</span>',
                    '<span class="font-mono text-xs" style="color: var(--text-3);">' . e($payment->currency) . '</span>',
                    '<span class="status-badge status-badge--success">' . __('messages.paid') . '</span>',
                    e($payment->gatewayConfig ? $payment->gatewayConfig->display_name : '—'),
                    '<span class="text-xs" style="color: var(--text-3);">' . $payment->created_at->format(settings('date_format', 'd M Y H:i')) . '</span>',
                    '<a href="'. route('payments.view', $payment->token) .'" wire:navigate class="rack-table-action">' . __('messages.view_invoice') . '</a>',
                ];
            })->toArray(),
    ])
@endsection
