<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Models\Facility;
use App\Services\FacilityService;
use Livewire\Component;

class FacilityProfileComponent extends Component
{

    public $facility;
    public $shiftType;
    protected $facilityService;

    public $steps = [
        1 => 'details',
        2 => 'census',
        3 => 'chooseShift',
        4 => 'shifts',
        5 => 'employeeRoles',
        6 => 'groups',
        7 => 'units',

    ] ;

    protected $listeners = ['changeStep','shiftType'];

    public function render()
    {
        return view('livewire.facility.register-steps.facility-profile-component');
    }
    public function mount($companyId,$facilityId = null){
        $this->companyId = $companyId;
        $this->facilityId = $facilityId;

        if ($facilityId){
            $this->facility = Facility::find($facilityId);

        }
        $this->changeStep($facilityId ?  $this->facility->registration_step : 1);
        $this->timeFormat = ($this->companyId && auth()->user()->Company->am_pm) ? "hh:mm p": "HH:mm";
    }

    public function shiftType($shiftType){

        $this->shiftType = $shiftType;
    }

    public function changeStep($step){


        $this->facilityService->UpdateFacilityRegistrationStep($this->facility,$step);
        if ($step > max(array_keys($this->steps))){

            return redirect(route('company.dashboard',$this->companyId))->with('success',__('lang.facility_finish_registration'));
        }

        $this->step = $this->steps[$step];

    }

    public function boot(FacilityService $facilityService){
        $this->facilityService = $facilityService;
    }
}
