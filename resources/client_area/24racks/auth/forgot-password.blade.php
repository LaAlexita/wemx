@extends('theme::auth.wrapper')

@section('title', __('messages.forgot_password'))

@section('content')
    @livewire(client_view_path('auth.livewire.forgot-password-form'))
@endsection
