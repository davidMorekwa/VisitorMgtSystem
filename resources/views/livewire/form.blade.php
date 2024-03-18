<form class="h-[100vh] bg-gray-100 flex flex-col items-center justify-center">
    @csrf
    @if (!$isNext)
        @livewire('personal-information')
    @else
        @if ($visitor_exists)
            <div>
                <p>Welcome back: {{$visitor["Name"]}}</p>
                <p>ID: {{$visitor["ID_Number"]}}</p>
                <p>Phone Number: {{$visitor["Phone_Number"]}}</p>
                <p>Email: {{$visitor["Email_Address"]}}</p>
            </div>
            
        @endif
        @livewire('official-information')
    @endif
    
</form>
