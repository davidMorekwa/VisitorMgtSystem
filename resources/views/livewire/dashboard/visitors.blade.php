<div
	class="flex flex-row">
	<div
		class="mr-4 w-3/5 border-r-2 p-2">
		<table
			class="table-cell">
			<thead>
				<tr>

					<th>
						Name
					</th>
					<th>
						Email
					</th>
					<th>
						ID/Passport_Number
					</th>
					<th>
						Phone_Number
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($visitors as $visitor)
					<tr
						wire:click='handleVisitorClick({{ $visitor->id }});'
						class="hover:bg-sasra_hover m-auto border px-3 hover:cursor-pointer">
						<td>
							<input
								type="text"
								value="{{ $visitor->name }}"
								class="border-none bg-transparent"
								@disabled(!$isEdit)>
						</td>
						<td>
							{{ $visitor->email }}
						</td>
						<td>
							{{ $visitor->{'ID/Passport_number'} }}
						</td>
						<td>
							{{ $visitor->phone_number }}
						</td>
						<td
							class="flex flex-row items-center justify-center">

							{{-- edit button --}}
							<button
								wire:click='handleEditClick'
								id="{{ $visitor->id }}"
								onclick="handleClick({{ $visitor->id }})">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									x="0px"
									y="0px"
									width="24"
									height="24"
									viewBox="0 0 24 24">
									<path
										d="M 18 2 L 15.585938 4.4140625 L 19.585938 8.4140625 L 22 6 L 18 2 z M 14.076172 5.9238281 L 3 17 L 3 21 L 7 21 L 18.076172 9.9238281 L 14.076172 5.9238281 z">
									</path>
								</svg>
							</button>

							{{-- delete button --}}
							<form 
								action="/dashboard/visitors/delete"
								method="POST"
								class="flex items-center">
								<input name="visitor_id" type="number" value="{{$visitor->id}}" hidden>
								@method('DELETE')
								@csrf
								<button
									type="submit"
									{{-- wire:click='handleDeleteClick({{ $visitor->id }})' --}}
								> 
									<svg 
									xmlns="http://www.w3.org/2000/svg"
									x="0px"
									y="0px"
									width="24"
									height="24"
									viewBox="0 0 64 64">
									<path
										d="M 28 11 C 26.895 11 26 11.895 26 13 L 26 14 L 13 14 C 11.896 14 11 14.896 11 16 C 11 17.104 11.896 18 13 18 L 14.160156 18 L 16.701172 48.498047 C 16.957172 51.583047 19.585641 54 22.681641 54 L 41.318359 54 C 44.414359 54 47.041828 51.583047 47.298828 48.498047 L 49.839844 18 L 51 18 C 52.104 18 53 17.104 53 16 C 53 14.896 52.104 14 51 14 L 38 14 L 38 13 C 38 11.895 37.105 11 36 11 L 28 11 z">
									</path>
									</svg>
								</button>
							</form>
							{{-- save button --}}
							@if ($isEdit)
								<x-button>
									<svg
										xmlns="http://www.w3.org/2000/svg"
										x="0px"
										y="0px"
										width="24"
										height="24"
										viewBox="0 0 50 50">
										<path
											d="M 41.9375 8.625 C 41.273438 8.648438 40.664063 9 40.3125 9.5625 L 21.5 38.34375 L 9.3125 27.8125 C 8.789063 27.269531 8.003906 27.066406 7.28125 27.292969 C 6.5625 27.515625 6.027344 28.125 5.902344 28.867188 C 5.777344 29.613281 6.078125 30.363281 6.6875 30.8125 L 20.625 42.875 C 21.0625 43.246094 21.640625 43.410156 22.207031 43.328125 C 22.777344 43.242188 23.28125 42.917969 23.59375 42.4375 L 43.6875 11.75 C 44.117188 11.121094 44.152344 10.308594 43.78125 9.644531 C 43.410156 8.984375 42.695313 8.589844 41.9375 8.625 Z">
										</path>
									</svg>
								</x-button>
							@endif

						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $visitors->links() }}
	</div>
	@if (
		$selected_visitor !=
			'')
		<div
			class="w-2/5 border-2">
			<h2
				class="text-2xl font-bold">
				{{ $selected_visitor->name }}
			</h2>
			<table
				class="w-full table-auto">
				<thead>
					<tr>
						<th
							class="m-4">
							Purpose
							of
							visit
						</th>
						<th
							class="m-4">
							Person
							to
							see
						</th>
						<th
							class="m-4">
							Sacco
							Name
						</th>
						<th
							class="m-4">
							Time
							In
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($visits as $visit)
						<tr
							class="m-auto border px-3 hover:cursor-pointer hover:bg-gray-200">
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
		<div>
			<canvas id="myChart"></canvas>
		</div>
	@endif
</div>
<script type="text/javascript">
	console.log("first doc")
	$("button[type=submit]").click(function (e) { 
		e.preventDefault();
		console.log("button first")
	});
</script>
