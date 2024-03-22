<div>
	{{-- @livewire('selected-visitor-form') --}}
	<div class="flex flex-row">
		<div class="mr-4 w-3/5 border-r-2 p-2">
			<table class="table-cell">
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
					<tr wire:click='handleVisitorClick({{ $visitor->id }});'
						class="hover:bg-sasra_hover m-auto px-3 hover:cursor-pointer">
						<td>
							<form action="">
								<input type="text" value="{{ $visitor->name }}"
									class="border-none bg-transparent" @disabled(!$isEdit)>
							</form>
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
				<br>
				<br>
				<div>
					<x-button class="font-light">Generate Report</x-button>
				</div>
			</div>
			@endif
		</div>
	</div>
	{{-- <script>
		$(document).ready(function () {
			console.log("Documennt is ready")
			// $("#btn_save").click(function (e) { 
				
			// 	e.preventDefault();
			// 	var visitorInfoFormData = $("#visitorInfoForm").serialize()
			// 	console.log("visitorInfoFormData")
			// 	console.log(visitorInfoFormData)

			// 	$.ajaxSetup({
			// 		headers: {
			// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			// 		}
			// 	});
			// 	$.ajax({
			// 		type: "POST",
			// 		url: "http://localhost:8001/dashboard/visitors/update",
			// 		data: visitorInfoFormData,
			// 		success: function (response) {
			// 			console.log("Response from save")
			// 			console.log(response)
			// 			$("#success-alert").fadeIn();
			// 			setTimeout(() => {
			// 				$("#success-alert").fadeOut();
			// 			}, 2000);
			// 		},
			// 		error: function (error){
			// 			console.error("An error has occured when the save button was clicked");
			// 			console.error(error)
			// 		}
			// 	});
			// });
			$("#btn_delete").click(function (e) { 
				e.preventDefault();
				var visitorInfoFormData = $("#visitorInfoForm").serialize()
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "DELETE",
					url: "http://localhost:8001/dashboard/visitors/delete",
					data: visitorInfoFormData,
					success: function (response) {
						console.log("Response from save")
						console.log(response)
					},
					error: function (error){
						console.error("An error has occured when the save button was clicked");
						console.error(error)
					}
				});
			});
		});
	</script> --}}
</div>