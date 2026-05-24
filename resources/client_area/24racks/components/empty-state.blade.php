@props([
    'title',
    'description' => null,
    'icon' => null,
    'actionText' => null,
    'actionHref' => null,
    'actionNavigate' => false,
])

<div {{ $attributes->class('empty-state') }}>
    @if($icon)
        <div class="empty-state-icon">
            {!! $icon !!}
        </div>
    @else
        <div class="empty-state-icon">
            <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 17h6m-3-3v6"/>
            </svg>
        </div>
    @endif

    <p class="empty-state-title">{{ $title }}</p>

    @if($description)
        <p class="empty-state-description">{{ $description }}</p>
    @endif

    @if($actionText && $actionHref)
        <a
            href="{{ $actionHref }}"
            @if($actionNavigate) wire:navigate @endif
            class="btn btn-primary btn-sm"
        >
            {{ $actionText }}
        </a>
    @endif
</div>
