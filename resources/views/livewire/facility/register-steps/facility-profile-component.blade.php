<div>
    <div wire:loading>
        @include('forms.loading')
    </div>

    @if($step == 'details')
        <livewire:facility.register-steps.facility-details-component :steps="$steps" :companyId="$companyId" :facilityId="$facilityId"/>
    @elseif($step == 'census')
        <livewire:facility.register-steps.facility-census-component :steps="$steps" :companyId="$companyId" :facilityId="$facilityId"/>
        @elseif($step == 'chooseShift')
            <livewire:facility.register-steps.facility-shifts-component :steps="$steps" :companyId="$companyId" :facilityId="$facilityId"/>
        @elseif($step == 'shifts')
            <livewire:facility.register-steps.facility-shifts-schedule-component :steps="$steps"  :facilityId="$facilityId" :defaultShift="$shiftType"/>
        @elseif($step == 'employeeRoles')
            <livewire:facility.register-steps.facility-employee-roles-component :steps="$steps"  :facilityId="$facilityId" />
        @elseif($step == 'groups')
             <livewire:facility.register-steps.facility-group-component :steps="$steps"  :facilityId="$facilityId" />
        @elseif($step == 'units')
             <livewire:facility.register-steps.facility-units-component :steps="$steps" :companyId="$companyId"  :facilityId="$facilityId" />
    @endif

</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('assets/js/jquery.timepicker.min.js')}}" defer></script>
    <script>
        let timeFormat = '{!! $timeFormat !!}';

    </script>
    <script  src="{{asset('assets/js/inittime.js')}}"></script>
@endpush
