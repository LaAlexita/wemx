<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Url;

new class extends Component
{
    public ?string $title = null;

    public ?string $description = null;

    public bool $showCatalogButton = true;

    #[Url('filterOrderStatus')]
    public array $filterStatus = [];

    #[Url('orderSearch')]
    public string $search = '';
};

?>

@php
    $user = auth()->user();
    $orders = $user->orders->sortByDesc('created_at');

    $statuses = $orders->pluck('status')->countBy();

    if ($this->filterStatus) {
        $filterStatus = collect($this->filterStatus)->filter(fn ($status) => $statuses->has($status))->toArray();
        $orders = $orders->whereIn('status', $filterStatus);
    }

    if ($this->search) {
        $needle = mb_strtolower($this->search);
        $orders = $orders->filter(function ($order) use ($needle) {
            return str_contains(mb_strtolower($order->package->name), $needle)
                || str_contains(mb_strtolower($order->status), $needle)
                || str_contains(mb_strtolower($order->package->category->name), $needle);
        });
    }

    $statusBadge = function ($status) {
        return match ($status) {
            'active'                  => ['status-badge--online',  __('messages.active')],
            'suspended'               => ['status-badge--warning', __('messages.suspended')],
            'cancelled'               => ['status-badge--danger',  __('messages.cancelled')],
            'terminated'              => ['status-badge--danger',  __('messages.terminated')],
            'pending', 'processing'   => ['status-badge--info',    ucfirst($status)],
            default                   => ['status-badge--warning', ucfirst($status)],
        };
    };

    $resolvedTitle = $title ?? __('messages.active_services');
    $resolvedDescription = $description ?? __('messages.active_services_subtitle');
@endphp

<section class="workspace-card">
    <div class="workspace-card-head">
        <div class="workspace-card-head-text">
            @if($resolvedTitle)
                <h2 class="h-accent">{{ $resolvedTitle }}</h2>
            @endif
            @if($resolvedDescription)
                <p>{{ $resolvedDescription }}</p>
            @endif
        </div>

        <div class="workspace-card-head-tools">
            @if($user->orders->isNotEmpty())
                <label class="rack-table-search">
                    <span class="sr-only">{{ __('messages.search') }}</span>
                    <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8ZM2 8a6 6 0 1 1 10.89 3.476l4.817 4.817a1 1 0 0 1-1.414 1.414l-4.816-4.816A6 6 0 0 1 2 8Z" clip-rule="evenodd"/>
                    </svg>
                    <input type="text" wire:model.live.debounce.250ms="search" placeholder="{{ __('messages.search_package') }}">
                </label>

                @if($statuses->count() > 1)
                    <div class="relative">
                        <button
                            type="button"
                            data-dropdown-toggle="orders-filter-dropdown"
                            class="btn btn-secondary btn-sm">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 12h12M10 20h4"/>
                            </svg>
                            {{ __('messages.filter') }}
                            @if(count($filterStatus) > 0)
                                <span class="tag tag-brand" style="margin-left: 4px; padding: 1px 6px; font-size: 10px;">{{ count($filterStatus) }}</span>
                            @endif
                        </button>
                        <div id="orders-filter-dropdown" class="z-10 hidden" style="min-width: 220px; background: var(--bg-elevated); border: 1px solid var(--border-dim); border-radius: var(--radius-lg); padding: 12px; backdrop-filter: blur(16px);">
                            <p style="font-family: var(--font-mono); font-size: 10px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--text-3); margin: 0 0 8px;">{{ __('messages.filter_by_status') }}</p>
                            <ul style="display: grid; gap: 4px; margin: 0; padding: 0; list-style: none;">
                                @foreach($statuses as $status => $count)
                                    <li style="display: flex; align-items: center; gap: 8px;">
                                        <input id="filter-{{ $status }}" wire:model.change="filterStatus" type="checkbox" value="{{ $status }}" style="width: 14px !important; height: 14px !important; accent-color: var(--brand);">
                                        <label for="filter-{{ $status }}" style="color: var(--text-1) !important; font-size: 12.5px; cursor: pointer;">{{ ucfirst($status) }} <span style="color: var(--text-3);">({{ $count }})</span></label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endif

            @if($showCatalogButton)
                <a href="{{ route('categories.index') }}" wire:navigate class="btn btn-secondary btn-sm">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    {{ __('messages.subscribe') }}
                </a>
            @endif
        </div>
    </div>

    @if($user->orders->isEmpty())
        <div class="workspace-card-body">
            <x-theme::empty-state
                :title="__('messages.no_services_yet')"
                :description="__('messages.no_services_yet_desc')"
                icon='<svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/></svg>'
                :action-text="__('messages.view_catalog')"
                :action-href="route('categories.index')"
                :action-navigate="true"
            />
        </div>
    @else
        <div class="rack-table-scroll">
            <table class="rack-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.service') }}</th>
                        <th>{{ __('messages.price') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.expiry') }}</th>
                        <th class="text-right">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        @php([$badgeClass, $badgeLabel] = $statusBadge($order->status))
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="{{ $order->package->icon() }}" alt="" style="width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--border-dim); object-fit: cover; flex-shrink: 0;">
                                    <div style="min-width: 0;">
                                        <span class="td-name">{{ $order->package->name }}</span>
                                        <span style="display: block; color: var(--text-3); font-family: var(--font-mono); font-size: 11px; margin-top: 1px;">
                                            {{ $order->package->category->name }} · #{{ $order->id }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="color: var(--text-1); font-weight: 660; font-variant-numeric: tabular-nums;">{{ price($order->price) }}</span>
                                <span style="color: var(--text-3); font-size: 11px;"> / {{ $order->cycle() }}</span>
                            </td>
                            <td>
                                <span class="status-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                            </td>
                            <td>
                                @if($order->due_date)
                                    <span style="color: var(--text-2); font-size: 12.5px;">{{ $order->due_date->format('d M Y') }}</span>
                                @else
                                    <span style="color: var(--text-3); font-style: italic;">{{ __('messages.no_expiration') }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('orders.view', $order->id) }}" wire:navigate class="rack-table-action">
                                    {{ __('messages.manage_arrow') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="rack-table-empty">
                                {{ __('messages.no_results_current_search') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</section>
