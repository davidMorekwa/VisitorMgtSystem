<form wire:submit='handleSubmit' id="visitorInfoForm" class="w-full bg-white p-3 rounded-2xl">
    @csrf
    <div class="flex flex-row justify-between items-center">
        <h1>Visitor Personal Information</h1>
        <div id="success-alert" class="w-20 rounded-xl shadow-2xl bg-green-200 text-center py-2 hidden">Success
        </div>
        <div id="failure-alert" class="w-20 rounded-xl shadow-2xl bg-red-400 text-center text-white py-2 hidden">Error
        </div>
    </div>

    <div class="flex flex-row justify-around">
        <div class="mt-4 w-1/2">
            <x-label for="selected_visitor_name" value="{{ __('Name') }}" />
            <x-input wire:model='name' id="selected_visitor_name" class="block mt-1 w-3/4" type="text" name="selected_visitor_name"
                required autocomplete="current-password" value="{{ $name }}" />
        </div>
        <div class="mt-4 w-1/2">
            <x-label for="selected_visitor_id_passport_number" value="{{ __('ID/Passport Number') }}" />
            <x-input wire:model='ID_Passport_number' id="selected_visitor_id_passport_number" class="block mt-1 w-3/4" type="text"
                name="selected_visitor_id_passport_number" required autocomplete="current-password"
                value="{{ $ID_Passport_number }}" />
        </div>
    </div>
    <div class="flex flex-row justify-around">
        <div class="mt-4 w-1/2">
            <x-label for="selected_visitor_email" value="{{ __('Email Address') }}" />
            <x-input wire:model='email' id="selected_visitor_email" class="block mt-1 w-3/4" type="email" name="selected_visitor_email"
                required autocomplete="current-password" value="{{ $email }}" />
        </div>
        <div class="mt-4 w-1/2">
            <x-label for="selected_visitor_phone_number" value="{{ __('Phone Number') }}" />
            <x-input wire:model='phone_number' id="selected_visitor_phone_number" class="block mt-1 w-3/4" type="text"
                name="selected_visitor_phone_number" required autocomplete="current-password"
                value="{{ $phone_number }}" />
        </div>
    </div>
    <input wire:model='id' id="selected_visitor_id" name="visitor_id" type="number" value="{{ $id }}" hidden>
    <div class="w-full flex justify-around mt-4">
        <x-button type="submit" id="btn_save">Save</x-button>
        <x-button wire:confirm='Are you sure you want to delete this visitor?' wire:click='handleDeleteClick' type="button" id="btn_delete">Delete</x-button>
    </div>
    @script
    <script>
        $wire.on('visitor_info_delete_fail_event', ()=>{
            alert("You dont have the correct permission")
        });
    </script>
    @endscript
</form>
