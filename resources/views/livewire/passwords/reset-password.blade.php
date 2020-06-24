@section('header')
    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        {{ __('Reset your password') }}
    </h2>
@endsection

<section>
    @include('auth._errors', compact('errors'))

    <form wire:submit.prevent="submit" class="mt-8">
        <x-form.text-field name="email">
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
            {{ __('Confirm password change') }}
        </x-form.submit-auth-button>
    </form>
</section>
