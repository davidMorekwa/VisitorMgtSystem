<div>
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