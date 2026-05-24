@extends('theme::auth.wrapper')

@section('title', __('messages.reset_password'))

@section('content')
    @livewire(client_view_path('auth.livewire.reset-password-form'), ['token' => $token->token])
@endsection
