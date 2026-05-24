@props([])

<div {{ $attributes->class(["rack-card p-6"])->merge([]) }}>
    {{ $slot }}
</div>
