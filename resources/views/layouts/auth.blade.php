@extends('tall-auth::layouts.base')

@section('body')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        @hasSection('heading')
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="text-xl font-semibold text-center text-gray-900 leading-7">
                    @yield('heading')
                </h2>
            </div>
        @endif

        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            @yield('content')
        </div>

        @hasSection('footer')
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <div class="mt-5">
                    @yield('footer')
                </div>
            </div>
        @endif
    </div>
@endsection
