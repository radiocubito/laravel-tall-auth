@extends('tall-auth::layouts.auth')
@section('title', 'Update your password')

@section('content')
    <div>
        @livewire('tall-auth.passwords.request-password')
    </div>
@endsection
