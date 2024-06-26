<div>
	<br>
	<div class="w-full flex flex-row items-center justify-around">
		{{-- SEARCH --}}
		<form wire:submit='handleSearch' class="flex items-center">
			<x-input wire:model='search_value' placeholder="Search..."></x-input>
			<x-button type='submit' class="ml-4">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
					viewBox="0 0 50 50">
					<path
						d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z">
					</path>
				</svg>
			</x-button>
		</form>
		<form wire:submit='handleTimeRangeFormSubmit' class="flex flex-row items-center justify-around">
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
		{{-- EXPORT TO EXCEL BUTTON --}}
		<a href="{{ route('visitor.export') }}">
			<x-button>Export to Excel</x-button>
		</a>
	</div>
	<br>
	<br>

	<div class="flex flex-row">
		{{-- TABLE TO SHOW VISITORS --}}
		<div class="mr-4 w-3/5">
			<table class="table-cell w-full">
				<thead>
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
						<th class="m-auto">
							Phone_Number
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($visitors as $visitor)
					<tr wire:click='handleVisitorClick({{ $visitor->id }});'
						class="hover:bg-sasra_hover px-3 hover:cursor-pointer border-b-2 border-dotted my-10 h-2">
						<td>
							<form action="">
								<input type="text" value="{{ $visitor->name }}"
									class="border-none bg-transparent" @disabled(!$isEdit)>
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
			{{ $visitors->links() }}
		</div>
		{{-- VISITOR INFO FORM TO SAVA/DELETE & VISITS TABLE --}}
		<div class="w-2/5 flex flex-col">
			<br>
			@livewire('dashboard.selected-visitor-form')
			@if ($is_visitor_selected)
			<br>
			<br>
			<br>
			<br>
			<div class="w-full">
				<div>
					<p>Number of visits: {{count($visits)}}</p>
					<table class="w-full table-auto">
						<thead>
							<tr>
								<th class="m-4">
									Purpose
									of
									visit
								</th>
								<th class="m-4">
									Person
									to
									see
								</th>
								<th class="m-4">
									Sacco
									Name
								</th>
								<th class="m-4">
									Time
									In
								</th>
								<th class="m-4">
									Time
									Out
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($visits as $visit)
							<tr class="m-auto border px-3 hover:cursor-pointer hover:bg-gray-200">
								<td>
									{{ $visit->purpose_of_visit }}
								</td>
								<td>
									{{ $visit->person_to_see }}
								</td>
								<td>
									{{ $visit->sacco_name }}
								</td>
								<td>
									{{ $visit->time_in }}
								</td>
								<td>
									{{ $visit->time_out }}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>