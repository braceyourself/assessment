@props(['brand'])

<x-button style="
    text-shadow: 1px 1px 2px black;
    box-shadow: 8px 8px 17px -14px black;
    font-weight:bold;
    cursor: pointer;
    background-color: {{$brand->color}}"
          class="mx-4 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-center rounded-t-lg">
    {{$brand->name}}
</x-button>
