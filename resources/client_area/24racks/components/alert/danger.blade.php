@props([
    'text' => null,
])

<div {{ $attributes->class(["alert alert-danger"])->merge(['role' => 'alert']) }}>
    {{ $text ?? $slot }}
</div>
