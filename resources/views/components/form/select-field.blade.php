@props([
    'label',
    'name',
    'required' => false,
    'options' => [],
])

<div class="relative w-full">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>

    <select name="{{ $name }}" id="{{ $name }}"
        @if ($required) required @endif
        {{ $attributes->merge([
            'class' =>
                'bg-gray-50 border ' .
                ($errors->has($name) ? 'border-red-500' : 'border-gray-300') .
                'text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block w-full p-2.5'
        ]) }}>
        <option value="" disabled selected>Pilih {{ $label }}</option>
        @foreach ($options as $value => $display)
            <option value="{{ $value }}" {{ old($name) == $value ? 'selected' : '' }}>
                {{ $display }}
            </option>
        @endforeach
    </select>

    @error($name)
        <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
