<form class="h-[80vh] bg-gray-100 flex flex-col items-center justify-center">
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
    
</form>
