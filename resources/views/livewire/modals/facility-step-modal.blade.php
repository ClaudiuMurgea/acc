<div  >
    <x-modalFacility wire:model="showFacilityModals"  >
        <div class="modal-header">
            <h2 class="font-medium text-base mr-auto">{!! __('lang.'.$type) !!}</h2>
        </div>

        <!-- END: Modal Header -->
        <!-- BEGIN: Modal Body -->

            @if($componentName)
                @livewire($componentName,['companyId'=> "$companyId",'data' => "$data"])
            @endif


        <!-- END: Modal Body -->
        <!-- BEGIN: Modal Footer -->
        <div class="modal-footer text-right">
            <button type="button" data-dismiss="modal" class="btn btn-danger w-20 mr-1" x-on:click="window.livewire.emitTo('modals.facility-step-modal','hideFacilityModal')">{!! __('lang.cancel') !!}</button>
            <button type="button" class="btn btn-primary w-20" x-data x-on:click="window.livewire.emitTo('{!! $componentName !!}','save')">{!! __('lang.add',['what' => '']) !!}</button>
        </div>
    </x-modalFacility>
</div>
