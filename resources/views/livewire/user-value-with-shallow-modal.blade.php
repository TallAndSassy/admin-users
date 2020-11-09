<div>
{{--{!! $value !!}--}}
    <div wire:click="$toggle('showingModal')" wire:loading.attr="disabled">
        <x-tassy::ui.looks.link-to-modal href="tbd">{!! $maybeHighlightedValue !!}</x-tassy::ui.looks.link-to-modal>
    </div>


    <!-- Delete User Confirmation Modal -->
    <x-tassy::dialog-modal wire:model="showingModal">

        <x-slot name="title">User: {{$value}}</x-slot>
        <x-slot name="content">
            <div class="">
                <x-tassy::ui.looks.label-value label="{{$valueLabel}}" value="{{$value}}"/>
                <br>
                <x-tassy::ui.looks.label-value label="Email" value="{{$asrRow['email']}}"/>
            </div>

        </x-slot>
        <x-slot name="footer">
            <span class="text-gray-400">Your footer text goes here</span>
            <x-jet-secondary-button wire:click="$toggle('showingModal')" wire:loading.attr="disabled">
                Close
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="doModalPrimary" wire:loading.attr="disabled">
                Click it! Click it!
            </x-jet-button>
        </x-slot>

    </x-tassy::dialog-modal>
</div>
