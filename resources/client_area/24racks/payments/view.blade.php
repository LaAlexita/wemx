@extends('theme::layouts.wrapper', [
    'activePage' => 'payments',
])

@section('title', 'Pago')

@php
    $payment = \App\Models\Payment::where('token', $payment)->firstOrFail();
@endphp

@section('content')
    @livewire(client_view_path('payments.livewire.view-payment'), [
        'payment' => $payment,
    ])
@endsection
