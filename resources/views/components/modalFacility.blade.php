<div class="mt-6" x-data="{ showFacilityModals: @entangle($attributes->wire('model')) }" x-cloak >
    <!-- Button (blue), duh! -->

    <!-- Dialog (full screen) -->
    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);z-index: 1000"  x-show="showFacilityModals" >
        <!-- A basic modal dialog with title, body and one button to close -->
        <div class="flex flex-col w-1/2 p-20 m-8 bg-white rounded-md lg:m-0 lg:w-1/2 sm:p-10"
             x-on:keydown.escape.window="window.livewire.emitTo('modals.facility-step-modal','hideFacilityModal')"
             @click.away="window.livewire.emitTo('modals.facility-step-modal','hideFacilityModal')"
             id="myModal"
            >
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                {!! $slot !!}
            </div>

        </div>
    </div>
</div>


