@props([
    'text' => null,
])

<div {{ $attributes->class(["alert alert-info"])->merge(['role' => 'alert']) }}>
    {{ $text ?? $slot }}
</div>
