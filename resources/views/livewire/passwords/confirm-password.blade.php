<section>
    <form wire:submit.prevent="confirm" class="mt-8">
        <x-input.group label="Password" for="password" :error="$errors->first('password')">
            <x-input.text wire:model.lazy="password" id="password" type="password" required />
        </x-input.group>

        <div class="mt-6">
            <span class="block w-full rounded-md">
                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                    Confirm password
                </button>
            </span>
        </div>
    </form>
</section>
