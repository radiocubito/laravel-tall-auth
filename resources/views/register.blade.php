@extends('tall-auth::layouts.auth')
@section('title', 'Create a new account')
@section('heading', 'Create a new account')

@section('content')
    <div>
        @livewire('tall-auth.register')
    </div>
@endsection

@section('footer')
    <div class="space-y-2">
        <small class="block text-xs text-gray-400">Already have an account? <a class="underline hover:text-gray-600" href="@route('login')">Log in</a>.</small>
    </div>
@endsection
