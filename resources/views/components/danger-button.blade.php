<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md  text-white text-center hover:bg-red-500 active:bg-red-700 focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
