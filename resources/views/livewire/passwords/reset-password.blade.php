<div>
    <x-card>
        <form wire:submit.prevent="submit">
            <div class="space-y-4 sm:space-y-6">
                <x-input.group label="Email address" for="email" :error="$errors->first('email')">
                    <x-input.text wire:model.lazy="email" id="email" required />
                </x-input.group>

                <x-input.group label="Password" for="password" :error="$errors->first('password')">
                    <x-input.text wire:model.lazy="password" id="password" type="password" required />
                </x-input.group>

                <x-input.group label="Confirm password" for="password_confirmation" :error="$errors->first('password_confirmation')">
                    <x-input.text wire:model.lazy="password_confirmation" id="password_confirmation" type="password" required />
                </x-input.group>
            </div>

            <div class="mt-6">
                <span class="block w-full rounded-md">
                    <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                        {{ __('Confirm password change') }}
                    </button>
                </span>
            </div>
        </form>
    </x-card>
</div>
