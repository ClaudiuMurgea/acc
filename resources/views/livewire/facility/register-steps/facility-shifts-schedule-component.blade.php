<div >
    @include('facility.steps.stepsCounter',['data' => $data])
    {{--@dd($days)--}}

    @if($defaultShift)
        <livewire:facility.register-steps.facility-preview-shifts-schedule-component :facilityId="$facilityId" :defaultShift="$defaultShift"/>
    @else
        <livewire:facility.register-steps.facility-add-shifts-schedule-component :facilityId="$facilityId"/>

    @endif



</div>

