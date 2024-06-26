<aside class="flex h-screen w-[15%] flex-col overflow-y-auto border-r bg-white px-4 py-8 rtl:border-l rtl:border-r-0">

	<div class="mt-6 flex flex-1 flex-col justify-between">
		<nav>
			<x-authentication-card-logo />
			<a class="hover:bg-sasra_color mt-5 flex transform items-center rounded-lg px-4 py-2 text-gray-600 transition-colors duration-300 hover:text-black"
				href="{{ route('dashboard') }} ">
				<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17"
						stroke="currentColor" stroke-width="2" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>

				<span class="mx-4 font-medium">Dashboard</span>
			</a>

			<a class="hover:bg-sasra_color mt-5 flex transform items-center rounded-lg px-4 py-2 text-gray-600 transition-colors duration-300 hover:text-black"
				href="{{ route('profile.show') }}">
				<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
						stroke="currentColor" stroke-width="2" stroke-linecap="round"
						stroke-linejoin="round" />
					<path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
						stroke="currentColor" stroke-width="2" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>

				<span class="mx-4 font-medium">Accounts</span>
			</a>

			<a wire:click="handleMenuOptionClick('Visitors')"
				class="hover:bg-sasra_color mt-5 flex transform items-center rounded-lg px-4 py-2 text-gray-600 transition-colors duration-300 hover:text-black"
				href="{{ route('dashboard.visitors') }}">
				<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 5V7M15 11V13M15 17V19M5 5C3.89543 5 3 5.89543 3 7V10C4.10457 10 5 10.8954 5 12C5 13.1046 4.10457 14 3 14V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V14C19.8954 14 19 13.1046 19 12C19 10.8954 19.8954 10 21 10V7C21 5.89543 20.1046 5 19 5H5Z"
						stroke="currentColor" stroke-width="2" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>

				<span class="mx-4 font-medium">Visitors</span>
			</a>
			<a wire:click="handleMenuOptionClick('Messages')"
				class="hover:bg-sasra_color mt-5 flex transform items-center rounded-lg px-4 py-2 text-gray-600 transition-colors duration-300 hover:text-black"
				href="{{ route('dashboard.message') }}">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
					viewBox="0 0 50 50">
					<path
						d="M 14 4 C 8.4886661 4 4 8.4886661 4 14 L 4 36 C 4 41.511334 8.4886661 46 14 46 L 36 46 C 41.511334 46 46 41.511334 46 36 L 46 14 C 46 8.4886661 41.511334 4 36 4 L 14 4 z M 14 6 L 36 6 C 40.430666 6 44 9.5693339 44 14 L 44 36 C 44 40.430666 40.430666 44 36 44 L 14 44 C 9.5693339 44 6 40.430666 6 36 L 6 14 C 6 9.5693339 9.5693339 6 14 6 z M 25 11 C 16.806196 11 10 16.724334 10 23.962891 C 10 28.422653 12.681228 32.244798 16.572266 34.560547 C 15.979588 35.500836 15.233739 36.474116 14.300781 37.384766 A 1.0001 1.0001 0 0 0 15.173828 39.083984 C 17.481979 38.674506 19.894769 37.826205 21.878906 36.597656 C 22.885987 36.785688 23.918133 36.925781 25 36.925781 C 33.193804 36.925781 40 31.201447 40 23.962891 C 40 16.724334 33.19389 11 25 11 z M 25 13 C 32.27011 13 38 17.989447 38 23.962891 C 38 29.936334 32.270196 34.925781 25 34.925781 C 23.93592 34.925781 22.905081 34.805366 21.904297 34.597656 A 1.0001 1.0001 0 0 0 21.148438 34.744141 C 20.222493 35.357332 19.095857 35.862111 17.912109 36.279297 C 18.279348 35.7823 18.664906 35.29371 18.921875 34.736328 A 1.0001 1.0001 0 0 0 18.457031 33.421875 C 14.551886 31.494479 12 27.967608 12 23.962891 C 12 17.989447 17.729804 13 25 13 z">
					</path>
				</svg>

				<span class="mx-4 font-medium">Messages</span>
			</a>
			<a class="hover:bg-sasra_color mt-5 flex transform items-center rounded-lg px-4 py-2 text-gray-600 transition-colors duration-300 hover:text-black"
				href="{{ route('dashboard.other') }} ">
				<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			
				<span class="mx-4 font-medium">Other</span>
			</a>
			<br>
			<form method="POST" action="{{ route('logout') }}" x-data>
				@csrf

				<x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();"
					class="flex flex-row items-center">
					<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.3246 4.31731C10.751 2.5609 13.249 2.5609 13.6754 4.31731C13.9508 5.45193 15.2507 5.99038 16.2478 5.38285C17.7913 4.44239 19.5576 6.2087 18.6172 7.75218C18.0096 8.74925 18.5481 10.0492 19.6827 10.3246C21.4391 10.751 21.4391 13.249 19.6827 13.6754C18.5481 13.9508 18.0096 15.2507 18.6172 16.2478C19.5576 17.7913 17.7913 19.5576 16.2478 18.6172C15.2507 18.0096 13.9508 18.5481 13.6754 19.6827C13.249 21.4391 10.751 21.4391 10.3246 19.6827C10.0492 18.5481 8.74926 18.0096 7.75219 18.6172C6.2087 19.5576 4.44239 17.7913 5.38285 16.2478C5.99038 15.2507 5.45193 13.9508 4.31731 13.6754C2.5609 13.249 2.5609 10.751 4.31731 10.3246C5.45193 10.0492 5.99037 8.74926 5.38285 7.75218C4.44239 6.2087 6.2087 4.44239 7.75219 5.38285C8.74926 5.99037 10.0492 5.45193 10.3246 4.31731Z"
							stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" />
						<path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
							stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
					<span class="mx-4 font-medium">Log
						Out</span>
				</x-dropdown-link>
			</form>
			

		</nav>
	</div>
</aside>