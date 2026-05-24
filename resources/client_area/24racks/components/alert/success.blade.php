@props([
    'text' => null,
])

<div {{ $attributes->class(["alert alert-success"])->merge(['role' => 'alert']) }}>
    {{ $text ?? $slot }}
</div>
