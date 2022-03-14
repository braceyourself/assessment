@props([
    'disabled' => false,
    'help' => null,
])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
    ]) !!}
>
@isset($help)
    <div class="ml-12 text-sm">
        {{$help}}
    </div>
@endisset
