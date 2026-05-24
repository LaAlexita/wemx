@props([

])

{{--
    ┌─────────────────────────────────────────────────────────────────┐
    │  24racks override del componente drawer de WemX core            │
    │  NUNCA editar: resources/client_area/default/components/drawer/ │
    │  Este archivo tiene prioridad por el view resolver de WemX      │
    │  Uso: <x-theme::drawer> ... </x-theme::drawer>                  │
    └─────────────────────────────────────────────────────────────────┘
--}}
<div {{ $attributes->merge([
    'class'    => 'fixed top-0 right-0 z-[1050] h-screen overflow-y-auto transition-transform translate-x-full w-full sm:w-96',
    'tabindex' => '-1',
]) }} style="background: var(--bg-root); border-left: 1px solid var(--border-dim); padding: 24px; z-index: 1050;">{{ $slot }}</div>
