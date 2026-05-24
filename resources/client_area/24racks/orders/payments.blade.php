@extends('theme::orders.layout', [
    'activeTab' => 'payments',
])

@section('container')
    @livewire(client_view_path('livewire.table'), [
        'title' => __('messages.service_payments'),
        'description' => __('messages.service_payments_desc'),
        'badge' => __('messages.payments_count', ['count' => $order->payments->where('status', 'paid')->count()]),
        'columns' => [
            __('messages.description'),
            __('messages.amount'),
            __('messages.currency'),
            __('messages.status'),
            __('messages.gateway'),
            __('messages.transaction'),
            __('messages.date'),
        ],
        'rows' =>
            $order->payments->where('status', 'paid')->map(function($payment) {
                return [
                    '<span class="td-name">' . e($payment->description) . '</span>',
                    '<span style="font-variant-numeric: tabular-nums; color: var(--text-1); font-weight: 660;">' . price($payment->total(), $payment->currency) . '</span>',
                    '<span class="font-mono text-xs" style="color: var(--text-3);">' . e($payment->currency) . '</span>',
                    '<span class="status-badge status-badge--success">' . __('messages.paid') . '</span>',
                    e($payment->gatewayConfig ? $payment->gatewayConfig->display_name : '—'),
                    '<span class="font-mono text-xs" style="color: var(--text-3);">' . e($payment->transaction_id ?? '—') . '</span>',
                    '<span class="text-xs" style="color: var(--text-3);">' . $payment->created_at->format(settings('date_format', 'd M Y H:i')) . '</span>',
                ];
            })->toArray(),
    ])
@endsection
