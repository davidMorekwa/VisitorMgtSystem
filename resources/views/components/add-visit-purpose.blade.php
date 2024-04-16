<div class="mt-10 sm:mt-0">
      <x-action-section>
            <x-slot name="title">
                  {{ __('Purpose of Visit') }}
            </x-slot>

            <x-slot name="description">
                  {{ __('Add Purpose of visit.') }}
            </x-slot>

            <x-slot name="content">
                  <div class="max-w-xl text-sm text-gray-600">
                        {{ __('Add a custom purpose of visit to enable visitors be as specific as possible when registering their information.') }}
                  </div>

                  <div class="mt-5">
                        <form action="/purpose" method="post">
                              @csrf
                              <x-input name='purpose'/>
                              <x-button type='submit' class="ms-4">
                                    {{ __('Add') }}
                              </x-button>
                        </form>
                  </div>
            </x-slot>
      </x-action-section>
</div>