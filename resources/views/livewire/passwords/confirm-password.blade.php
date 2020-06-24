@section('header')
    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        {{ __('Confirm password') }}
    </h2>
@endsection

<section>
    <form wire:submit.prevent="confirm" class="mt-8">
        @include('auth._errors', compact('errors'))

        <x-form.text-field name="password" type="password" class="mt-6">
            <x-slot name="label">
                {{ __('Password') }}
            </x-slot>
        </x-form.text-field>

        <x-form.submit-auth-button class="mt-6">
            {{ __('Confirm password') }}
        </x-form.submit-auth-button>
    </form>
</section>

@section('footer')
    <p>{{ __('Forgot your password?') }} <a class="underline hover:text-gray-600" href="{{ route('password.request') }}">{{ __('Reset it') }}</a>.</p>
@endsection
