@extends('tall-auth::layouts.auth')
@section('title', 'Log into your account')
@section('heading', 'Log into your account')

@section('content')
    <div>
        @livewire('tall-auth.login')
    </div>
@endsection

@section('footer')
    <div class="space-y-2">
        <small class="block text-xs text-gray-400">Forgot your password? <a class="underline hover:text-gray-600" href="@route('password.request')">Reset it</a>.</small>
        <small class="block text-xs text-gray-400">Don't have an account yet? <a class="underline hover:text-gray-600" href="@route('register')">Sign up</a>.</small>
    </div>
@endsection
