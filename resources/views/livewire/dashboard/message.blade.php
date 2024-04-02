<div class="flex flex-row">
    <div class="w-3/4">
        {{-- DATE FORM --}}
        <form wire:submit='handleFormSubmit' class="flex flex-row items-center w-1/2 justify-around">
            <div class="flex flex-col">
                <label for="from_date">From</label>
                <x-input type="date" wire:model='from_date' name="from_date" id="from_date" />
                <div class="font-serif text-sm font-light text-red-600">
                    @error('from_date')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="flex flex-col">
                <label for="to_date">To</label>
                <x-input type="date" wire:model='to_date' name="to_date" id="to_date" />
                <div class="font-serif text-sm font-light text-red-600">
                    @error('to_date')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <x-button type="submit">Get visitors</x-button>
            </div>

        </form>
        <br>
        @if ($is_search)
        <div>
            <table class="table-cell w-full border">
                <thead class="border">
                    <tr class="border-2">

                        <th class="m-auto">
                            Name
                        </th>
                        <th class="m-auto">
                            Email
                        </th>
                        <th class="m-auto">
                            ID/Passport_Number
                        </th>
                        <th class="m-3">
                            Phone_Number
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                    <tr class="hover:bg-sasra_hover px-3 hover:cursor-pointer border-b-2 border-dotted my-10 h-2">
                        <td>
                            <form action="">
                                <input type="text" value="{{ $visitor->name }}" class="border-none bg-transparent">
                            </form>
                        </td>
                        <td>
                            <p>{{ $visitor->email }}</p>
                        </td>
                        <td>
                            <p>{{ $visitor->{'ID/Passport_number'} }}</p>
                        </td>
                        <td>
                            <p>{{ $visitor->phone_number }}</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>
    {{-- MESSAGE FORM --}}
    <div>
        <form>
            <label for="message_to_send">Message to Send</label>
            <textarea wire:model='message_to_send' name="message_to_send" id="message_to_send" cols="70" rows="5"
                class="border-gray-300 focus:border-sasra_color focus:outline-none "></textarea>
            <br>
            <br>
            <div class="flex flex-row justify-evenly items-center w-full">
                <x-button wire:click='handleSendSMSClick'>Send SMS</x-button>
                <x-button wire:click='handleSendEmailClick'>Send Email</x-button>
            </div>

        </form>
    </div>
</div>