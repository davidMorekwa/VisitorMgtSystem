<div class="w-full border border-red-600 h-[100vh] flex flex-col justify-center items-center">
    <img 
        class="w-56"
        src="{{ asset('storage/sasraLogo.jpeg') }}"
        alt="Logo">
    <br/>
    <p class="font-serif text-2xl">
        WELOME TO SASRA VISITOR MANAGEMENT SYSTEM</p>
    <br/>
    <a href="{{ route('visitor.register') }}"><button type="button" class="p-4 font-serif text-black bg-sasra_color rounded-xl">
        Get Started</button></a>
</div>
