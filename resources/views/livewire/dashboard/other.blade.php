<div>
    <div class="max-w-7xl mx-auto py-10 my_smpx-6 lg:px-8">
        {{-- ADD USER --}}
        <div class="mt-10 my_smmt-0">
            @livewire('profile.add-user')
        </div>
        <x-section-border />

        <x-add-visit-purpose />

        <x-section-border />
        {{-- SHOW LOGS --}}
        <div class="mt-10 my_smmt-0">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Logs') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Show system logs') }}
                </x-slot>

                <x-slot name="content">
                    <div class="max-w-xl text-sm text-gray-600">
                        {{ __('System logs are records of events that happen on a computer system, such as errors, warnings, and information about
                            current operations') }}
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('show.logs') }}">
                            <x-danger-button class="border p-2 rounded-lg bg-gray-700 text-white">Show Logs
                            </x-danger-button>
                        </a>
                    </div>
                </x-slot>
            </x-action-section>
        </div>

    </div>
</div>