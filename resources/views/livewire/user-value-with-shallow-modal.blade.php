<div>
    {{--{!! $value !!}--}}
    <div wire:click="showModal()" wire:loading.attr="disabled" class="flex">

        @if($asrRow['profile_photo_url'])
        <img class="w-8 rounded rounded-full mr-2" src="{{$asrRow['profile_photo_url']}}"/>
        @endif
        <x-tassy::ui.looks.link-to-modal href="tbd">
            {!! $maybeHighlightedValue !!}
        </x-tassy::ui.looks.link-to-modal>
    </div>


    <!-- Modal -->
    <x-tassy::dialog-modal wire:model="showingModal">


        <x-slot name="title">User: {{$knownGoodName}}</x-slot>
        <x-slot name="content">
            <livewire:flash-container key="{{uniqid()}}"/>

            @if ($isInState == 'reading')
                <div class="">
                    <x-tassy::ui.looks.label-value label="Name" value="{{$user->name}}"/>
                    <br>
                    <x-tassy::ui.looks.label-value label="Email" value="{{$user->email}}"/>
                </div>
                <div class="text-right pr-3">
                    <x-tassy::ui.looks.link-to wire:click.prevent="moveToState('editing')" href='/'>
                        Edit
                    </x-tassy::ui.looks.link-to>
                </div>
            @elseif ($isInState == 'editing')
                <x-tassy::ui.looks.link-to href="/" wire:click.prevent="moveToState('reading')" enum-sandbox="back">
                    Back
                </x-tassy::ui.looks.link-to>
                <div class="sm:border-t sm:border-gray-200">
                   <div class="sm:grid sm:grid-cols-3 sm:gap-3 sm:items-start  sm:pt-3">
                      <label for="name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                        Name
                      </label>
                      <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                          <input id="name" type="text" wire:model="user.name" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>
                      </div>

                       @error('user.name') <div class="spacer"></div> <x-tassy::ui.looks.input-error class=" sm:col-span-2  sm:max-w-xs">{{ $message }}</x-tassy::ui.looks.input-error> @enderror

                    </div>


                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5 ">
                      <label for="email" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                        Email
                      </label>
                      <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                          <input id="email" type="text" wire:model="user.email"  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>
                      </div>
                          @error('user.email') <div class="spacer"></div> <x-tassy::ui.looks.input-error class=" sm:col-span-2  sm:max-w-xs">{{ $message }}</x-tassy::ui.looks.input-error> @enderror
                    </div>

                </div>

            @else
                {{assert(0,__FILE__.__LINE__)}}
            @endif

        </x-slot>
        <x-slot name="footer">
             @if ($isInState == 'reading')
            <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
                Close
            </x-jet-secondary-button>
             @elseif ($isInState == 'editing')
                 <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
                                Cancel
                            </x-jet-secondary-button>
                            <x-jet-secondary-button wire:click="update()" wire:loading.attr="disabled" class="{{ $canUpdate ?'' : 'text-blue-200'}}">
                                Update
                            </x-jet-secondary-button>
 @else
                {{assert(0,__FILE__.__LINE__)}}
            @endif
            {{--            <x-jet-button class="ml-2" wire:click="doModalPrimary" wire:loading.attr="disabled">--}}
            {{--                Click it! Click it!--}}
            {{--            </x-jet-button>--}}
        </x-slot>

    </x-tassy::dialog-modal>
</div>
