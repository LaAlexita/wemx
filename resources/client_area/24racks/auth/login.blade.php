@extends('theme::auth.wrapper')

@section('title', __('messages.sign_in'))

@section('content')
    @livewire(client_view_path('auth.livewire.login-form'))
@endsection
