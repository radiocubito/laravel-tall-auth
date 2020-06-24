@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
    'hint' => false
])

<div>
    <div class="flex justify-between">
        <label for="{{ $for }}" class="block text-xs uppercase font-medium leading-4 text-gray-600">
            {{ $label }}
        </label>

        @if ($hint)
            <span class="block text-xs uppercase leading-4 text-gray-400">
                {{ $hint }}
            </span>
        @endif
    </div>

    {{ $slot }}

    @if ($error)
        <div class="mt-1 text-red-500 text-xs">{{ $error }}</div>
    @endif

    @if ($helpText)
        <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
</div>
