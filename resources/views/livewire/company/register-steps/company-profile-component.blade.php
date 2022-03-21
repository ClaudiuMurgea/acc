<div>
    <div wire:loading>
        @include('forms.loading')
    </div>
        @if($step == 'details')
            <livewire:company.register-steps.company-details-component :steps="$steps"/>
        @elseif($step == 'billing')
            <livewire:company.register-steps.company-billing-component :companyId="$companyId" :steps="$steps"/>
        @elseif($step == 'holidays')
            <livewire:company.register-steps.company-holiday-component :companyId="$companyId" :steps="$steps"/>
        @elseif($step == 'staff')
            <livewire:company.register-steps.company-staff-component :companyId="$companyId" :steps="$steps" />
        @elseif($step == 'shift')
           <livewire:company.register-steps.shift-component :companyId="$companyId" :steps="$steps"/>
        @elseif($step == 'shiftschedule')
           <livewire:company.register-steps.company-shift-schedule-component :companyId="$companyId" :steps="$steps"/>
        @endif
    @push('scripts')
        <script type="text/javascript" src="{{asset('assets/js/jquery.timepicker.min.js')}}" defer></script>
        <script>
            Livewire.on('settimeFormat', function (format) {

                timeFormat = format;

            });
        </script>
        <script  src="{{asset('assets/js/inittime.js')}}"></script>
    @endpush
</div>
