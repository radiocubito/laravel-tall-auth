@extends('tall-auth::layouts.auth')
@section('title', 'Verify your email address')
@section('heading', 'Verify your email address')

@section('content')
    <x-card>
        @if (session('resent'))
            <div class="rounded-md bg-green-50 p-4 border border-green-800 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 font-medium text-green-800">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <p class="text-sm">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </p>
    </x-card>
@endsection

@section('footer')
    <div class="space-y-2">
        <small class="block text-xs text-gray-400">Did not receive the email? @livewire('tall-auth.resend-verification')</small>
    </div>
@endsection
