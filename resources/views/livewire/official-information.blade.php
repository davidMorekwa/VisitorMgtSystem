<div
	class=" bg-white rounded-3xl w-[45%] h-[55%] mt-24 px-5 py-10">
	<h3
		class="font-serif text-2xl font-bold text-center">
		Official
		Information
	</h3>
	<br />
	<br />
	{{-- Select the purpose of visit --}}
	<div
		class="relative">
		<select
			wire:model="selected_purpose"
			wire:model.live='selected_purpose'
			wire:change='handleOptionChange'
			name="purpose"
			required
			id="purpose"
			class="w-3/4 px-3 py-1 transition-colors border-b border-gray-300 focus:text-black focus:border-b-2 focus:border-sasra_color focus:outline-none peer bg-inherit">
			<option
				value=""
				class="">
			</option>
			@foreach ($options as $option)
				<option
					value="{{ $option }}">
					{{ $option }}
				</option>
			@endforeach
		</select>
		<div
			class="font-serif text-sm font-light text-red-600">
			@error('selected_purpose')
				{{ $message }}
			@enderror
		</div>
		@if (
			$selected_purpose ==
				'')
			<label
				for="purpose"
				class="absolute font-light text-gray-600 transition-all left-3 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 peer-focus:text-sasra_color">Purpose
				of
				visit</label>
		@endif
	</div>
	<br />
	<br />
	{{-- If purpose is "Complaints" or "Accounts" display this section --}}
	@if (
		$selected_purpose ==
			'Make a complaint' ||
			$selected_purpose ==
				'Accounts')
		<div
			class="relative flex flex-row items-center justify-between">
			{{-- select sacco type --}}
			<div class="w-[30%]">
				<select
					name="sacco_type"
					id="sacco_type"
					wire:model='sacco_type'
					wire:model.live='sacco_type'
					wire:change='handleSaccoTypeChange'
					class="w-full px-3 py-1 mr-10 transition-colors border-b border-gray-300 focus:text-black focus:border-b-2 focus:border-sasra_color focus:outline-none peer bg-inherit">
					<option
						value=""
						class="">
					</option>
					<option
						value="DT">
						Deposit
						Taking
					</option>
					<option
						value="NWDTS">
						NWDTS
					</option>
				</select>
				@if (
					$sacco_type ==
						'')
					<label
						for="sacco_type"
						class="absolute font-light text-gray-600 transition-all left-[1rem] top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 peer-focus:text-sasra_color">SACCO
						Type</label>
				@endif
				<div
					class="font-serif text-sm font-light text-red-600">
					@error('sacco_type')
						{{ $message }}
					@enderror
				</div>
			</div>
			{{-- select sacco name --}}
			<div class="w-[60%]">
				<select
					wire:model="sacco_name"
					wire:model.live='sacco_name'
					wire:change='handleOptionChange'
					name="sacco_name"
					id="sacco_name"
					class="w-full px-3 py-1 transition-colors border-b border-gray-300 focus:text-black focus:border-b-2 focus:border-sasra_color focus:outline-none peer bg-inherit">
					<option
						value=""
						class="">
					</option>
					@foreach ($saccos as $option)
						<option
							value="{{ $option->id }}">
							{{ $option->sacco_name }}
						</option>
					@endforeach
				</select>
				<div
					class="font-serif text-sm font-light text-red-600">
					@error('sacco_name')
						{{ $message }}
					@enderror
				</div>
				@if (
					$selected_sacco ==
						'')
					<label
						for="sacco_name"
						class="absolute font-light text-gray-600 transition-all left-[22rem] top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 peer-focus:text-sasra_color">SACCO
						Name</label>
				@endif
			</div>

		</div>
	@endif

	{{-- If purpose is "visitation" display this --}}
	@if (
		$selected_purpose ==
			'Official visit')
		<div
			class="relative">
			<input
				id="person_to_visit"
				name="person_to_visit"
				type="text"
				class="w-3/4 px-3 py-1 transition-colors border-b border-gray-300 focus:border-b-2 focus:border-sasra_color focus:outline-none peer bg-inherit"
				wire:model='person_to_visit'
				wire:change='handleNameInputChange'
				wire:model.live='person_to_visit' />
			<div
				class="font-serif text-sm font-light text-red-600">
				@error('person_to_visit')
					{{ $message }}
				@enderror
			</div>

			@if (
				$person_to_visit ==
					'')
				<label
					for="person_to_visit"
					class="absolute font-light text-gray-600 transition-all left-3 top-1 cursor-text peer-focus:text-xs peer-focus:-top-4 peer-focus:text-sasra_color">Person
					To
					Visit</label>
			@endif

		</div>
	@endif
	<br />
	@if ($isLoading)
		<div class="font-serif text-center font-extralight animate-bounce">Please wait...</div>
	@endif
	
	<br />
	<br />
	<br />
	<div
		class="flex items-center justify-between">
		<button
			type="button"
			wire:click='handleBackClick'
			class="w-[25%] bg-sasra_color p-3 rounded-xl font-serif">Back</button>
		<button
			type="button"
			wire:click='handleFinishClick'
			class="w-[25%] bg-sasra_color p-3 rounded-xl font-serif">Finish</button>
	</div>
	<br>
</div>
