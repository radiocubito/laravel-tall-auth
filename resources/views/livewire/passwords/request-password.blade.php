<section>
    <form wire:submit.prevent="sendResetLinkEmail" class="mt-8">
        <x-input.group label="Email address" for="email" :error="$errors->first('email')">
            <x-input.text wire:model.lazy="email" id="email" required />
        </x-input.group>

        <div class="mt-6">
            <span class="block w-full rounded-md">
                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                    {{ __('Send password reset link') }}
                </button>
            </span>
        </div>
    </form>
</section>
