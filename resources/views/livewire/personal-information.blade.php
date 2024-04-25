<div class="w-[35%] my_smw-full my_mdw-3/4 rounded-3xl bg-white px-5 pb-0 pt-10">
	<h3 class="text-center font-serif text-2xl font-bold">
		Personal
		Information
	</h3>
	<br />
	<br />
	<div class="relative">
		<x-input id="ID_number" name="ID_number" type="number"
			class="focus:border-sasra_color peer w-3/4 my_smw-full my_mdw-[85%] border-b border-gray-300 bg-inherit px-3 py-1 transition-colors focus:border-b-2 focus:outline-none"
			wire:model='ID_number' wire:change='handleIDNumberChange' wire:model.live='ID_number' />
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
	<br>
	@if (!$record_exists)
	<div class="relative">
		<x-input id="name" name="name" type="text"
			class="focus:border-sasra_color peer w-3/4 my_smw-full my_mdw-[85%] border-b bg-inherit px-3 py-1 outline-none transition-colors placeholder:text-white focus:border-b-2 focus:outline-none focus:placeholder:text-gray-400"
			placeholder="e.g. John Doe" wire:model='name' wire:change='handleNameInputChange'
			wire:model.live='name' />
		<div class="font-serif text-sm font-light text-red-600">
			@error('name')
			{{ $message }}
			@enderror
		</div>
		@if (
		$name ==
		'')
		<label for="name"
			class="peer-focus:text-sasra_color absolute left-3 top-1 cursor-text font-light text-gray-600 transition-all peer-focus:-top-4 peer-focus:text-xs">Name</label>
		@endif

	</div>
	<br />
	<br />
	<div class="relative">
		<x-input id="phone_number" name="phone_number" type="number" prefix="254"
			class="focus:border-sasra_color peer w-3/4 my_smw-full my_mdw-[85%] border-b border-gray-300 bg-inherit px-3 py-1 transition-colors placeholder:text-white focus:border-b-2 focus:outline-none focus:placeholder:text-gray-400"
			placeholder="e.g. 254xxxxxxxx" wire:model='phone_number' wire:change='handleNameInputChange'
			wire:model.live='phone_number' />
		<div class="font-serif text-sm font-light text-red-600">
			@error('phone_number')
			{{ $message }}
			@enderror
		</div>
		@if (
		$phone_number ==
		'')
		<label for="phone_number"
			class="peer-focus:text-sasra_color absolute left-3 top-1 cursor-text font-light text-gray-600 transition-all peer-focus:-top-4 peer-focus:text-xs">Phone
			number</label>
		@endif

	</div>
	<br />
	<br />
	<div class="relative">
		<x-input id="email" name="email" type="email"
			class="focus:border-sasra_color peer w-3/4 my_smw-full my_mdw-[85%] border-b border-gray-300 bg-inherit px-3 py-1 transition-colors placeholder:text-white focus:border-b-2 focus:outline-none focus:placeholder:text-gray-400"
			placeholder="e.g. example@gmail.com" wire:model='email' wire:change='handleNameInputChange'
			wire:model.live='email' />
		<div class="font-serif text-sm font-light text-red-600">
			@error('email')
			{{ $message }}
			@enderror
		</div>
		@if (
		$phone_number ==
		'')
		<label for="email"
			class="peer-focus:text-sasra_color absolute left-3 top-1 cursor-text font-light text-gray-600 transition-all peer-focus:-top-4 peer-focus:text-xs">Email
			Address</label>
		@endif

	</div>
	<br />
	<br />

	<br />

	@endif
	<div class="relative flex items-center justify-end">
		<button wire:click='handleClick' type="button"
			class="bg-sasra_color w-[25%] rounded-xl p-3 font-serif relative text-white">Next</button>
	</div>
	<br>

</div>