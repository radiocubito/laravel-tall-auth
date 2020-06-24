@section('header')
    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        {{ __('Update your password') }}
    </h2>

    <p class="mt-2 text-sm leading-5 text-gray-600 max-w">
        {{ __("If you've forgotten your password, you can send yourself an email to reset it. Enter the email address of your account to get started.") }}
    </p>
@endsection

<section>
    @include('auth._status')

    <form wire:submit.prevent="sendResetLinkEmail" class="mt-8">
        @include('auth._errors', compact('errors'))

        <x-form.text-field name="email">
            <x-slot name="label">
                {{ __('Email address') }}
            </x-slot>
        </x-form.text-field>

        <x-form.submit-auth-button class="mt-6">
            {{ __('Send password reset link') }}
        </x-form.submit-auth-button>
    </form>
</section>

@section('footer')
    <p class="mb-1">{{ __("Don't have an account yet?") }} <a class="underline hover:text-gray-600" href="{{ route('register') }}">{{ __('Sign up') }}</a>.</p>
@endsection
