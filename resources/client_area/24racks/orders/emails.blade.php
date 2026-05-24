@extends('theme::orders.layout', [
    'activeTab' => 'emails',
])

@section('container')
    @livewire(client_view_path('livewire.table'), [
        'title' => __('messages.service_emails'),
        'description' => __('messages.service_emails_desc'),
        'badge' => __('messages.messages_count', ['count' => $order->emails->count()]),
        'columns' => [
            __('messages.subject'),
            __('messages.from_addr'),
            __('messages.to_addr'),
            __('messages.status'),
            __('messages.sent'),
            '',
        ],
        'rows' =>
            $order->emails->map(function($email) {
                return [
                    '<span class="td-name">' . e($email->subject) . '</span>',
                    '<span class="font-mono text-xs" style="color: var(--text-3);">' . e($email->from) . '</span>',
                    '<span class="font-mono text-xs" style="color: var(--text-3);">' . e($email->to) . '</span>',
                    '<span class="status-badge status-badge--info">' . e(ucfirst($email->status)) . '</span>',
                    '<span class="text-xs" style="color: var(--text-3);">' . $email->created_at->format(settings('date_format', 'd M Y H:i')) . '</span>',
                    $email->user_id == auth()->id() ? '<a target="_blank" href="'. route('emails.view', $email->id) .'" class="rack-table-action">' . __('messages.view') . '</a>' : '',
                ];
            })->toArray(),
    ])
@endsection
