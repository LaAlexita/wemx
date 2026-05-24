@extends('theme::dashboard.dashboard-layout', [
    'activePage' => 'email-inbox',
])

@section('title', __('messages.email_inbox'))

@section('container')
    @livewire(client_view_path('livewire.table'), [
        'title' => __('messages.email_inbox'),
        'description' => __('messages.inbox_table_desc'),
        'badge' => __('messages.email'),
        'columns' => [
            __('messages.subject'),
            __('messages.sender'),
            __('messages.status'),
            __('messages.seen'),
            __('messages.date'),
            __('messages.actions'),
        ],
        'rows' =>
            auth()->user()->emails()->where('display', 1)->latest()->get()->map(function($email) {
                return [
                    '<span class="td-name">' . e($email->subject) . '</span>',
                    '<span style="color: var(--text-2);">' . e($email->from) . '</span>',
                    '<span class="status-badge status-badge--info">' . e(ucfirst($email->status)) . '</span>',
                    $email->seen_at
                        ? '<span class="text-xs" style="color: var(--text-3);">' . $email->seen_at->format(settings('date_format', 'd M Y H:i')) . '</span>'
                        : '<span class="status-badge status-badge--warning">' . __('messages.unread') . '</span>',
                    '<span class="text-xs" style="color: var(--text-3);">' . $email->created_at->format(settings('date_format', 'd M Y H:i')) . '</span>',
                    '<a href="'. route('emails.view', $email->id) .'" target="_blank" class="rack-table-action">' . __('messages.view') . '</a>',
                ];
            })->toArray(),
    ])
@endsection
