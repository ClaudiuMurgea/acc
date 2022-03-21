<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Models\Facility;
use App\Models\Timezone;
use App\Repositories\CompanyRepository;
use App\Repositories\FacilityRepository;
use Livewire\Component;

class FacilityDetailsComponent extends Component
{
    public $time_zone;
    public $license_no;
    public $facility_name;


    protected $rules = [
        'time_zone' => 'required|exists:timezones,id',
        'facility_name' => 'required',
        'license_no' => 'required',
    ];

    protected $listeners = ['updateTimezone'];

    public function render()
    {
        $data = [
            'current_step'  => 1,
            'page_title'    => __('lang.setup_facility'),
            'page_description'  => __('lang.setup_facility_description'),
            'steps'             => $this->steps,
            'registration_step'      => 1
        ];
        $this->emit('reinitSelect2');
        return view('livewire.facility.register-steps.facility-details-component',compact('data'));
    }

    public function hydrate(){

        $this->emit('reinitSelect2');
    }

    public function updateTimezone($val){

       $this->time_zone = $val;
    }

    public function mount($companyId,$facilityId = null,$steps,FacilityRepository $facilityRepository,CompanyRepository $companyRepository){

        $this->companyId = $companyId;
        $this->steps = $steps;
        $this->currentStep = 1;
        /*$this->timezones = [0 => 'Select timezone'];*/
        if ($facilityId){
            $this->facilityId = $facilityId;
            $facility = Facility::find($facilityId);
            $this->facility_name = $facility->name;
            $this->time_zone = $facility->time_zone_id;
            $this->license_no = $facility->license_no;

        }


        $this->timezones = Timezone::pluck('name','id')->prepend(__('lang.select',['what' => __('lang.time_zone')]), '0')->all();

    }

    public function save(FacilityRepository $facilityRepository){


        $this->validate();

        $conditions = [
            'company_id' => $this->companyId,
            'id'        => $this->facilityId ?? null
        ];
        $data = [
            'company_id'  => $this->companyId,
            'name'  => $this->facility_name,
            'time_zone_id'   => $this->time_zone,
            'license_no'     => $this->license_no,
            'registration_step' => 2
        ];


        $facility = ($facilityRepository->updateOrCreateByMultipleConditions($conditions,$data));
        return $this->redirect(route('facility.facilitySteps',[$this->companyId,$facility->id]));


    }
}
