@props([
    'label',
    'type' => 'text',
    'name',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'showTogglePassword' => false,
])

<div class="relative w-full" x-data="{ show: false }">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>

    <div class="relative">
        <input :type="show && '{{ $type }}'
        === 'password' ? 'text' : '{{ $type }}'"
            type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
            @if ($required) required @endif
            {{ $attributes->merge([
                'class' =>
                    'bg-gray-50 border ' .
                    ($errors->has($name) ? 'border-red-500' : 'border-gray-300') .
                    'text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block w-full p-2.5' .
                    ($showTogglePassword ? ' pr-10' : ''),
            ]) }}
            placeholder="{{ $placeholder }}" />

        @if ($showTogglePassword)
            <button type="button" @click="show = !show"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-sm leading-5 text-gray-500">
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.99 9.99 0 012.242-3.592M6.44 6.44A9.97 9.97 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.31 5.107M15 12a3 3 0 00-3-3m0 0a2.99 2.99 0 00-2.12.879M9.88 9.88L4.22 4.22m0 0L19.78 19.78" />
                </svg>
            </button>
        @endif
    </div>

    @error($name)
        <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
