<div class="bg-gray-50 flex flex-col justify-center items-center h-screen">
    <x-authentication-card-logo />
    <form wire:submit='handleFormSubmit' class="w-1/2 border bg-white rounded-2xl py-9 flex flex-col items-center">
        <h2>Record time out</h2>
        <br>
        <div class="relative">
            <x-input id="ID_number" name="ID_number" type="number"
                class="focus:border-sasra_color peer border-b border-gray-300 bg-inherit px-3 py-1 transition-colors focus:border-b-2 focus:outline-none"
                wire:model='ID_number' wire:model.live='ID_number' />
            <div class="font-serif text-sm font-light text-red-600">
                @error('ID_number')
                {{ $message }}
                @enderror
            </div>
    
            @if (
            $ID_number ==
            '')
            <label for="ID_number"
                class="peer-focus:text-sasra_color absolute left-3 top-1 cursor-text font-light text-gray-600 transition-all peer-focus:-top-4 peer-focus:text-xs">ID/Passport
                Number</label>
            @endif
    
        </div>
        <br>
        <x-button>Submit</x-button>
    </form>
</div>


