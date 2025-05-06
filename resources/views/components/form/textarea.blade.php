@props(['label', 'name', 'placeholder' => '', 'value' => '', 'required' => false, 'rows' => 4])

<div class="w-full">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>

    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}"
        @if ($required) required @endif
        {{ $attributes->merge([
            'class' =>
                'bg-gray-50 border ' .
                ($errors->has($name) ? 'border-red-500' : 'border-gray-300') .
                ' text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block w-full p-2.5',
        ]) }}
        placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>

    @error($name)
        <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
