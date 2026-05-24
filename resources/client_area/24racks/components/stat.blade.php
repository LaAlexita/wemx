@props([
    'icon' => '',
    'title' => '',
    'description' => '',
])

<div class="rack-card p-5 flex items-start justify-between gap-3">
    <div class="min-w-0">
        <p class="stat-card-value">{{ $title }}</p>
        <p class="stat-card-meta">{{ $description }}</p>
    </div>
    @if($icon)
        <div class="stat-card-icon shrink-0">
            {!! $icon !!}
        </div>
    @endif
</div>
