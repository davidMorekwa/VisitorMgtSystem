<div class="pt-3 flex flex-col">
	{{-- SHOW VISITORS BY PURPOSE --}}
	@if ($is_purpose_clicked)
	<p class="text-2xl font-light">{{$purpose_clicked}}</p>
	<br>
	<div>
		<div class="flex flex-row">
			<div class="mr-4 w-full border-r-2 h-screen p-2">
				<table class="table-cell h-screen border">
					<thead class="border">
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
							@switch($purpose_clicked)
							@case("Make a complaint")
							<th>
								Sacco Name
							</th>
							@break
							@case("Personal Visit")
							<th>
								Person to See
							</th>
							@break
							@case("Delivery")
							<th>
								Person to See
							</th>
							@break
							@case("Accounts")
							<th>
								Sacco Name
							</th>
							@break
							@default
							@endswitch
						</tr>
					</thead>
					<tbody>
						@foreach ($visitors as $visitor)
						<tr
							class="hover:bg-sasra_hover m-auto px-3 hover:cursor-pointer border-b-2 border-dotted">
							<td>
								<form>
									<input type="text" value="{{ $visitor->name }}"
										class="border-none bg-transparent">
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
							@switch($purpose_clicked)
							@case("Make a complaint")
							<td>
								{{ $visitor->sacco_name }}
							</td>
							@break
							@case("Personal Visit")
							<td>
								{{ $visitor->person_to_see }}
							</td>
							@break
							@case("Delivery")
							<td>
								{{ $visitor->person_to_see }}
							</td>
							@break
							@case("Accounts")
							<td>
								{{ $visitor->sacco_name }}
							</td>
							@break
							@default
							@endswitch
						</tr>
						@endforeach
					</tbody>
				</table>
				{{-- {{ $visitors->links() }} --}}
			</div>
		</div>
	</div>
	@else
	{{-- DISPLAY NORMAL DASHBOARD --}}
	<div>
		<h3 class="font-bold text-2xl">Visitors By Purpose</h3>
		<div id="myVisitorCategories" class="w-full">
			<div class="flex flex-row items-center justify-evenly">
				@foreach ($complaints as $complaint)
				{{-- <p>{{$complaint->purpose_of_visit}}</p> --}}
				<x-dashboard-complaint :complaint="$complaint" />
				@endforeach
			</div>
		</div>
		<br>
		<hr class="border-2">
	</div>
	<div class="w-full flex flex-row items-center justify-evenly">
		<div class="w-1/2">
			<h2 class="font-bold text-2xl">Peak Hours</h2>
			<canvas id="myPeakHoursChart"></canvas>
		</div>
		<div class="w-1/3">
			<h2 class="font-bold text-2xl">Visitors</h2>
			<br>
			<br>
			<canvas id="myVisitorsChart"></canvas>
		</div>
	</div>
	@endif
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	$(document).ready(function () {
		drawPeakHoursGraph()
		drawVisitorByCategoryGraph()
	});
	async function drawPeakHoursGraph(){
		await $.ajax({
			type: "get",
			url: "/peakhours",
			success: function (response){
				let labels = []
				let values = []
				for (const key in response) {
					console.log(key)
					if(key == "hours"){
						for (const x of response[key]) {
							labels.push(x)
							// console.log(labels)
						}
					} else {
						for (const y of response[key]) {
							values.push(y)
							console.log(values)
						}
					}
				}
				drawLineGraph(dataValue=values, labels=labels, type='line', context='myPeakHoursChart')
			},
			error: function (error){
				console.log("An error has occurred in the drawPeakHoursGraph() function")
				console.log(error)
			}
		});
	}
	async function drawVisitorByCategoryGraph(){
		await $.ajax({
			type: "get",
			url: "/visitors/getbypurpose",
			success: function (response) {
				console.log("Get visitors by purpose")
				console.log(response)
				let labels = []
				let values = []
				for (const key in response) {
					console.log(key)
					labels.push(key)
					values.push(response[key])
				}
				drawPieChart(dataValue=values, labels=labels, context='myVisitorsChart')
			},
			error: function (error){
				console.log("An error has occurred in the drawVisitorByCategoryGraph() function")
				console.log(error)
			}
		});
	}
	function drawLineGraph(dataValue, labels, type, context){
		const ctx = document.getElementById(context);
		new Chart(ctx, {
		type: 'line',
		data: {
			labels: labels,
			datasets: [{
				label: '# of Visitors',
				data: dataValue,
				borderWidth: 2,
				borderColor: "#F09C22"
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true,
					title: {
						display: true,
						text:"Number"
					}
				},
				x: {
					title: {
						display: true,
						text: "Hours"
					}
				}
				
			}
		}
		});
	}
	function drawPieChart(dataValue, labels, context){
		const ctx = document.getElementById(context);
		new Chart(ctx, {
			type: 'pie',
			data: {
				labels: labels,
				datasets: [{
					label: '# of Visitors',
					data: dataValue,
					borderWidth: 2,
					// borderColor: "#F09C22"
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: false
					},
				}
			}
		});
	}
	async function drawVisitorsByPurposeGraph(){

	}

</script>