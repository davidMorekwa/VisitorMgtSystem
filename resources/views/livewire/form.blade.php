<form class="h-[100vh] bg-gray-100 flex flex-col items-center justify-center">
    @csrf
    @if (!$isNext)
        @livewire('personal-information')
    @else
        @livewire('official-information')
    @endif
    
</form>
