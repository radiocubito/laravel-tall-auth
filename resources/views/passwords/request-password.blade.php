@extends('tall-auth::layouts.auth')
@section('title', 'Update your password')
@section('heading', 'Update your password')

@section('content')
    <div>
        @livewire('tall-auth.passwords.request-password')
    </div>
@endsection

@section('footer')
    <div class="space-y-2">
        <small class="block text-xs text-gray-400">Don't have an account yet? <a class="underline hover:text-gray-600" href="@route('register')">Sign up</a>.</small>
    </div>
@endsection
