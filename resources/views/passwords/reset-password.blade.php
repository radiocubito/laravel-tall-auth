@extends('tall-auth::layouts.auth')
@section('title', 'Reset your password')
@section('heading', 'Reset your password')

@section('content')
    <div>
        @livewire('tall-auth.passwords.reset-password', ['token' => $token, 'email' => $email])
    </div>
@endsection
