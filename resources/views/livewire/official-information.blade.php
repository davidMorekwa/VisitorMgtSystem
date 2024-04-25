<div class="my_my_smw-full m_my_mdw-3/4 mt-24 w-[45%] rounded-3xl bg-white px-5 py-10">
	<h3 class="text-center font-serif text-2xl font-bold">
		Official
		Information
	</h3>
	<br />
	<br />
	{{-- Select the purpose of visit --}}
	<div class="relative">
		<select wire:model="selected_purpose" wire:model.live='selected_purpose' wire:change='handleOptionChange'
			name="purpose" required id="purpose"
			class="focus:border-sasra_color peer w-3/4 border-b border-gray-300 bg-inherit px-3 py-1 transition-colors focus:border-b-2 focus:text-black focus:outline-none my_smw-full my_mdw-[85%]">
			<option value="" class="">
			</option>
			@foreach ($options as $option)
			<option value="{{ $option->purpose }}">
				{{ $option->purpose }}
			</option>
			@endforeach
		</select>
		<div class="font-serif text-sm font-light text-red-600">
			@error('selected_purpose')
			{{ $message }}
			@enderror
		</div>
		@if (
		$selected_purpose ==
		'')
		<label for="purpose"
			class="peer-focus:text-sasra_color absolute left-3 top-1 cursor-text font-light text-gray-600 transition-all peer-focus:-top-4 peer-focus:text-xs">Purpose
			of
			visit</label>
		@endif
	</div>
	<br />
	<br />
	{{-- If purpose is "Complaints" or "Accounts" display this section --}}
	@if (
	$selected_purpose ==
	'Make a Complaint' ||
	$selected_purpose ==
	'Accounts')
	<div class="relative flex flex-row items-center justify-between my_smflex-col my_mdflex-col">
		{{-- select sacco type --}}
		<div class="w-[30%] my_smw-full my_mdw-full">
			<select name="sacco_type" id="sacco_type" wire:model='sacco_type' wire:model.live='sacco_type'
				wire:change='handleSaccoTypeChange'
				class="focus:border-sasra_color peer mr-10 w-full border-b border-gray-300 bg-inherit px-3 py-1 transition-colors focus:border-b-2 focus:text-black focus:outline-none">
				<option value="" class="">
				</option>
				<option value="DT">
					Deposit
					Taking
				</option>
				<option value="NWDTS">
					NWDTS
				</option>
			</select>
			@if (
			$sacco_type ==
			'')
			<label for="sacco_type"
				class="peer-focus:text-sasra_color absolute left-[1rem] top-1 cursor-text font-light text-gray-600 transition-all peer-focus:-top-4 peer-focus:text-xs">SACCO
				Type</label>
			@endif
			<div class="font-serif text-sm font-light text-red-600">
				@error('sacco_type')
				{{ $message }}
				@enderror
			</div>
		</div>
		{{-- select sacco name --}}
		<div class="w-[60%] my_smw-full my_mdw-full">
			<select wire:model="sacco_name" wire:model.live='sacco_name' wire:change='handleOptionChange'
				name="sacco_name" id="sacco_name"
				class="focus:border-sasra_color peer relative w-full border-b border-gray-300 bg-inherit px-3 py-1 transition-colors focus:border-b-2 focus:text-black focus:outline-none">
				<option value="" class="">
				</option>
				@foreach ($saccos as $option)
				<option value="{{ $option->id }}">
					{{ $option->sacco_name }}
				</option>
				@endforeach
			</select>
			<div class="font-serif text-sm font-light text-red-600">
				@error('sacco_name')
				{{ $message }}
				@enderror
			</div>
			@if (
			$selected_sacco ==
			'')
			<label for="sacco_name"
				class="peer-focus:text-sasra_color absolute left-[22rem] top-1 cursor-text font-light text-gray-600 transition-all peer-focus:-top-4 peer-focus:text-xs my_smleft-[1rem] my_smtop-10 my_mdleft-[1rem] my_mdtop-10">SACCO
				Name</label>
			@endif
		</div>

	</div>
	@endif

	{{-- If purpose is "visitation" display this --}}
	@if (
	$selected_purpose ==
	'Official visit' ||
	$selected_purpose ==
	'Delivery')
	<div class="relative">
		<input id="person_to_visit" name="person_to_visit" type="text"
			class="focus:border-sasra_color peer w-3/4 border-b border-gray-300 bg-inherit px-3 py-1 transition-colors focus:border-b-2 focus:outline-none"
			wire:model='person_to_visit' wire:change='handleNameInputChange' wire:model.live='person_to_visit' />
		<div class="font-serif text-sm font-light text-red-600">
			@error('person_to_visit')
			{{ $message }}
			@enderror
		</div>

		@if (
		$person_to_visit ==
		'')
		<label for="person_to_visit"
			class="peer-focus:text-sasra_color absolute left-3 top-1 cursor-text font-light text-gray-600 transition-all peer-focus:-top-4 peer-focus:text-xs">Person
			To
			Visit</label>
		@endif

	</div>
	@endif
	<br />
	@if ($isLoading)
	<div class="animate-bounce text-center font-serif font-extralight">
		Please
		wait...
	</div>
	@endif

	<br />
	<br />
	<br />
	<div class="flex items-center justify-between">
		<button type="button" wire:click='handleBackClick'
			class="bg-sasra_color w-[25%] rounded-xl p-3 font-serif text-white">Back</button>
		<button type="button" wire:click='handleFinishClick'
			class="bg-sasra_color w-[25%] rounded-xl p-3 font-serif text-white">Finish</button>
	</div>
	<br>
</div>