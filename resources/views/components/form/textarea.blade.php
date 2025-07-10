@props([
    'label',
    'name',
    'rows' => 4,
    'required' => false,
    'placeholder' => null,
])

<div class="space-y-1">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
    </label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
    {{ $attributes->merge([
         'class' => 'mt-1 block w-full px-4 py-2 text-sm border ' .
                   ($errors->has($name) ? 'border-red-500' : 'border-gray-300') .
                   ' rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-red-500 transition duration-150'
    ]) }}
    >{{ old($name) }}</textarea>

      @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
