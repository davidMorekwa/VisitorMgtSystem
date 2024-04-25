{{-- @extends('components.layouts.app')
@section('content') --}}
<div class="w-full border h-[74vh] flex flex-col justify-evenly items-center bg-gray-100">
    <x-authentication-card-logo />

    <p class="font-serif text-2xl my_my_smtext-center">
        WELCOME TO SASRA VISITOR MANAGEMENT SYSTEM</p>
    <a href="{{ route('visitor.register') }}"><button type="button"
            class="p-4 font-serif text-white bg-sasra_color rounded-xl">
            Get Started</button></a>
</div>
{{-- @endsection --}}