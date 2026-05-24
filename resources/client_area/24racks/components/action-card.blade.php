<div {{ $attributes->class(['rack-card']) }}>
    <div class="p-6">
        @isset($title)
            <h3 {{ $title->attributes->class(['text-base font-semibold'])->merge([]) }} style="color: var(--text-1); margin: 0;">
                {{ $title }}
            </h3>
        @endisset

        @isset($description)
            <p {{ $description->attributes->class(['mt-1 text-sm'])->merge([]) }} style="color: var(--text-2);">
                {{ $description }}
            </p>
        @endisset
    </div>

    <div class="px-6 py-3 flex justify-end gap-2" style="border-top: 1px solid var(--border-dim); background: var(--surface-muted);">
        {{ $action ?? '' }}
    </div>
</div>
