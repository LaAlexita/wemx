@props([
    'text' => null,
    'href' => null,
])

<{{ isset($href) ? 'a' : 'button' }}
    {{ $attributes->class([
        "btn btn-warning"
    ])->merge(['href' => $href]) }}
>
    {{ $text ?? $slot }}
</{{ isset($href) ? 'a' : 'button' }}>
