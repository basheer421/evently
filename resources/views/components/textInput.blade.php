@props(['type' => 'text', 'name', 'placeholder'])

<div class="w-full relative">
    <input
        {{ $attributes->merge([
            'type' => $type,
            'name' => $name,
            'placeholder' => $placeholder,
            'class' =>
                'bg-gray-100 p-4 rounded-2xl w-full hover:bg-gray-200 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500',
        ]) }} />
    <div class="error-message text-red-500 text-sm mt-2 ml-4 hidden"></div>
</div>
