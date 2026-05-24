@props([
    'text' => null,
])

<div {{ $attributes->class(["alert alert-warning"])->merge(['role' => 'alert']) }}>
    {{ $text ?? $slot }}
</div>
