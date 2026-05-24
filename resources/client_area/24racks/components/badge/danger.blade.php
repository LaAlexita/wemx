@props([
    'text' => null,
])

<span {{ $attributes->class('badge badge-danger')->merge([]) }}>{{ $text ?? $slot }}</span>
