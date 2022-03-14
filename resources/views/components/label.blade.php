@props(['value'])

<label {{ $attributes->get('class', 'block font-medium text-sm text-gray-700') }}>
    {{ $value ?? $slot }}
</label>
