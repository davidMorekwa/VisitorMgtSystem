<div
	class="w-full border border-red-600 h-[100vh] flex flex-col justify-center items-center">
	@if (session('status'))
		<div
			id="success-alert"
			class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
	<img
		class="w-56"
		src="{{ asset('storage/sasraLogo.jpeg') }}"
		alt="Logo">
	<br />
	<p
		class="font-serif text-2xl">
		THANK
		YOU!
	</p>
	<br />
	<p
		class="font-serif text-xl font-light">
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
