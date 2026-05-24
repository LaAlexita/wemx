@extends('theme::auth.wrapper')

@section('title', __('messages.sign_up'))

@section('content')
    @livewire(client_view_path('auth.livewire.register-form'))
@endsection
