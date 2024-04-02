<div class="w-full h-[74vh] bg-slate-100 flex flex-col justify-center items-center">
	@if (session('status'))
	<div id="success-alert" class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	{{-- <x-authentication-card-logo /> --}}
	<br />
	<p class="font-serif text-2xl">
		THANK
		YOU!
	</p>
	<br />
	<p class="font-serif text-xl font-light">
		AN
		EMPLOYEE
		HAS
		BEEN
		NOTIFIED.
		YOU
		WILL
		BE
		ATTENDED
		TO
		SHORTLY
	</p>
</div>
<script>
	console
		.log(
			"Event About to be dispatched"
		)
	setTimeout
		(() => {
				Livewire
					.dispatch(
						'return-home-event'
					)
				console
					.log(
						"Event dispatched"
					)
			},
			5000
		);
	setTimeout
		(() => {
				$("#success-alert")
					.fadeOut();
			},
			2000
		);
</script>