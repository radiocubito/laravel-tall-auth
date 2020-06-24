@extends('tall-auth::layouts.auth')
@section('title', 'Confirm password')
@section('heading', 'Confirm password')

@section('content')
    <div>
        @livewire('tall-auth.passwords.confirm-password')
    </div>
@endsection
