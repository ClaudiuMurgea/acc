<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Models\Facility;
use App\Repositories\FacilityRepository;
use Livewire\Component;

class FacilityShiftsComponent extends Component
{
    public $shiftType;
    protected $facilityRepository;

    public function render()
    {
        $data = [
            'current_step'          => 3,
            'page_title'            => __('lang.shift_setup'),
            'page_description'      => __('lang.shift_setup_facility_description'),
            'steps'                 => $this->steps,
            'registration_step'     => $this->facility->registration_step
        ];
        return view('livewire.facility.register-steps.facility-shifts-component',compact('data'));
    }

    public function mount($companyId,$facilityId,$steps){
        $this->companyId = $companyId;
        $this->facilityId = $facilityId;
        $this->facility = Facility::find($facilityId);
        $this->steps = $steps;
        $this->shiftType = $this->facility->default_shift_type;

    }

    public function selectType($type){
        $this->shiftType = $type;

    }

    public function booted(FacilityRepository $facilityRepository){
        $this->facilityRepository = $facilityRepository;
    }
    public function save(){


        $this->facilityRepository->update(
            $this->facilityId,
            [
                'default_shift_type' => $this->shiftType
            ]
        );

        $this->emit('shiftType',$this->shiftType);
        $this->emit('changeStep',4);
    }
}
