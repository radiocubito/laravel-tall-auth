<div>
    <x-card>
        <form wire:submit.prevent="sendResetLinkEmail">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 border border-green-800 mt-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm leading-5 font-medium text-green-800">
                                {{ session('status') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-4 sm:space-y-6">
                <x-input.group label="Email address" for="email" :error="$errors->first('email')">
                    <x-input.text wire:model.lazy="email" id="email" required />
                </x-input.group>
            </div>

            <div class="mt-6">
                <span class="block w-full rounded-md">
                    <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                        {{ __('Send password reset link') }}
                    </button>
                </span>
            </div>
        </form>
    </x-card>
</div>
