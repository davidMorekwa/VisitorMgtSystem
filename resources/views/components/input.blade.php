@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-sasra_color focus:ring-sasra_color rounded-md shadow-sm']) !!}>
