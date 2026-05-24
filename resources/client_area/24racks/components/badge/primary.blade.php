@props([
    'text' => null,
])

<span {{ $attributes->class('badge badge-blue')->merge([]) }}>{{ $text ?? $slot }}</span>
