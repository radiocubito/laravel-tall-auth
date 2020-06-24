@section('header')
    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        {{ __('Register into') }} {{ config('app.name') }}
    </h2>
@endsection

<section>
    <form wire:submit.prevent="register" class="mt-8">
        @include('auth._errors', compact('errors'))

        <x-form.text-field name="name" autofocus="true">
            <x-slot name="label">
                {{ __('Name') }}
            </x-slot>
        </x-form.text-field>

        <x-form.text-field name="email" class="mt-6">
            <x-slot name="label">
                {{ __('Email address') }}
            </x-slot>
        </x-form.text-field>

        <x-form.text-field name="password" type="password" class="mt-6">
            <x-slot name="label">
                {{ __('Password') }}
            </x-slot>
        </x-form.text-field>

        <x-form.text-field name="password_confirmation" type="password" class="mt-6">
            <x-slot name="label">
                {{ __('Confirm password') }}
            </x-slot>
        </x-form.text-field>

        <x-form.submit-auth-button class="mt-6">
            {{ __('Create my account') }}
        </x-form.submit-auth-button>
    </form>
</section>

@section('footer')
    <p class="mb-1">{{ __('Have questions?') }} <a class="underline hover:text-gray-600" href="mailto:support@none.com">Email us</a> and we'll help.</p>
    <p class="mb-1">{{ __('Already have an account?') }} <a class="underline hover:text-gray-600" href="{{ route('login') }}">{{ __('Log in') }}</a>.</p>
@endsection
