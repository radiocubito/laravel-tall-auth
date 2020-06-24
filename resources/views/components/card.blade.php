@props([
    'header' => false,
    'footer' => false,
])

<div class="bg-white overflow-hidden rounded-md border border-gray-200">
     @if ($header)
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            {{ $header }}
        </div>
    @endif

    <div class="px-4 py-5 sm:p-6">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="border-t border-gray-200 px-4 py-4 sm:px-6 bg-gray-50">
            {{ $footer }}
        </div>
    @endif
</div>
