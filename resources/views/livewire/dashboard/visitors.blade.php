<div>
	<br>
	<div class="w-full flex flex-row items-center justify-around">
		<form wire:submit='handleSearch' class="w-1/2 flex items-center">
			<x-input wire:model='search_value' placeholder="Search..."></x-input>
			<x-button type='submit' class="ml-4">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
					<path
						d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z">
					</path>
				</svg>
			</x-button>
		</form>
		<a href="{{ route('visitor.export') }}">
			<x-button>Export to Excel</x-button>
		</a>
		
	</div>
	
	<br>
	<br>
	<div class="flex flex-row">
		<div class="mr-4 w-3/5 border-r-2 p-2">
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
		<div class="border w-2/5 flex flex-col">
			<br>
			@livewire('dashboard.selected-visitor-form')
			@if ($is_visitor_selected)
			<br>
			<br>
			<br>
			<br>
			<div class="w-full border-2 border-r-red-800">
				<div>
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