<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border
    border-transparent bg-sasra_color rounded-md font-semibold text-xs text-white uppercase tracking-widest
    hover:bg-sasra_hover focus:bg-sasra_color active:bg-sasra_color focus:outline-none focus:ring-2
    focus:ring-sasra_color focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>