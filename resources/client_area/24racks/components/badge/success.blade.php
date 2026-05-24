@props([
    'text' => null,
])

<span {{ $attributes->class('badge badge-success')->merge([]) }}>{{ $text ?? $slot }}</span>
