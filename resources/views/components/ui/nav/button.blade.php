@props(['href' => null, 'type' => 'button'])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'transition-colors duration-300 text-white hover:text-gray-900 hover:rounded-md hover:font-semibold block hover:bg-gray-200 whitespace-no-wrap py-2 px-4']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'transition-colors duration-300 text-white hover:text-gray-900 hover:rounded-md hover:font-semibold block hover:bg-gray-200 whitespace-no-wrap py-2 px-4']) }}>
        {{ $slot }}
    </button>
@endif
