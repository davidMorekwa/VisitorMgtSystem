<form class="h-[80vh] my_my_smw-full bg-gray-100 flex flex-col items-center justify-center">
    @csrf

    <br>
    @if (!$isNext)
    @livewire('personal-information')
    @else
    @if ($visitor_exists)
    <div class="text-center">
        <p class="font-thin text-lg">Welcome back</p>
        <p class="tracking-wider">{{$visitor["Name"]}}</p>
    </div>
    @endif
    @livewire('official-information')
    @endif
    @script
    <script>
        Livewire.on('redirect_event', ()=> {
            console.log("Redirect event handled");
            window.location.href="/thankyou"
        })
    </script>
    @endscript
</form>