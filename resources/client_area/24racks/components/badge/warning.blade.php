@props([
    'text' => null,
])

<span {{ $attributes->class('badge badge-warning')->merge([]) }}>{{ $text ?? $slot }}</span>
