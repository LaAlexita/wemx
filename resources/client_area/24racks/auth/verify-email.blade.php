@extends('theme::auth.wrapper')

@section('title', __('messages.verify_email'))

@section('content')
    @livewire(client_view_path('auth.livewire.verify-email'))
@endsection
