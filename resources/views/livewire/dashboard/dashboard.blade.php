<div class="pt-3 flex flex-col">
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
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
					beginAtZero: true
				},
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

</script>