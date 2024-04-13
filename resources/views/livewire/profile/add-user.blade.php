<x-action-section>
      <x-slot name="title">
            {{ __('Add user') }}
      </x-slot>

      <x-slot name="description">
            {{ __('Add a new users to the system.') }}
      </x-slot>

      <x-slot name="content">
            <p class="mt-3 max-w-xl text-sm text-gray-600">      
                  {{ __('Add a user to the system to enable access to the system. When adding, ensure the correct information is captured and also specify their role in the system i.e Administrator or Normal')}}
            </p>
            <br>
            <br>
                  <form method="POST" action="{{ route('dashboard.register') }}">
                        @csrf
            
                        <div>
                              <x-label for="name" value="{{ __('Name') }}" />
                              <x-input wire:model='name' id="name" class="block mt-1 w-1/2" type="text" name="name" :value="old('name')" required
                                    autofocus autocomplete="name" />
                        </div>
            
                        <div class="mt-4">
                              <x-label for="email" value="{{ __('Email') }}" />
                              <x-input wire:model='email' id="email" class="block mt-1 w-1/2" type="email" name="email" :value="old('email')" required
                                    autocomplete="username" />
                        </div>
            
                        <div class="mt-4">
                              <x-label for="password" value="{{ __('Password') }}" />
                              <x-input wire:model='password' id="password" class="block mt-1 w-1/2" type="password" name="password" required
                                    autocomplete="new-password" />
                        </div>
            
                        <div class="mt-4">
                              <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                              <x-input wire:model='password_confirmation' id="password_confirmation" class="block mt-1 w-1/2" type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                        </div>
                        <div class="mt-4">
                              <x-label for="role_id" value="{{ __('Role') }}" />
                              <select wire:model='role_id' class="block mt-1 w-1/2" name="role_id" id="role_id">
                                    <option value="2">Normal</option>
                                    <option value="1">Administrator</option>
                              </select>
                        </div>
            
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                              <x-label for="terms">
                                    <div class="flex items-center">
                                          <x-checkbox name="terms" id="terms" required />
            
                                          <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                                      class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms
                                                      of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                                      class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy
                                                      Policy').'</a>',
                                                ]) !!}
                                          </div>
                                    </div>
                              </x-label>
                        </div>
                        @endif
            
                        <div class="flex items-center justify-end mt-4">
            
                              <x-button class="ms-4">
                                    {{ __('Add User') }}
                              </x-button>
                        </div>
                  </form>
      </x-slot>

</x-action-section>
