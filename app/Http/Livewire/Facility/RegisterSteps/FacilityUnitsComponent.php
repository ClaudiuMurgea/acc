<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Repositories\FacilityRepository;
use App\Repositories\FacilityUnitRepository;
use Livewire\Component;

class FacilityUnitsComponent extends Component
{


    protected $facilityRepository;
    protected $facilityUnitRepository;
    protected $listeners = ['reloadUnits'];


    public function render()
    {
        $data = [
            'current_step'          => 7,
            'page_title'            => __('lang.facility_units_setup'),
            'page_description'      => __('lang.facility_units_description'),
            'steps'                 => $this->steps,
            'registration_step'     => $this->facility->registration_step
        ];
        return view('livewire.facility.register-steps.facility-units-component',compact('data'));
    }
    public function mount($steps,$companyId,$facilityId){
        $this->steps = $steps;
        $this->facilityId = $facilityId;
        $this->companyId = $companyId;
        $this->facility = $this->facilityRepository->findById($this->facilityId,['*'],'Units');
    }

    public function reloadUnits(){
        $this->facility = $this->facilityRepository->findById($this->facilityId,['*'],'Units');
    }

    public function boot(FacilityRepository $facilityRepository,FacilityUnitRepository $facilityUnitRepository){
        $this->facilityRepository = $facilityRepository;
        $this->facilityUnitRepository = $facilityUnitRepository;
    }

    public function delete($unitId){
        $el = $this->facilityUnitRepository->deleteById($unitId);
        $this->reloadUnits();
    }

    public function save(){

        if (!$this->facility->Units->count()){
            return  $this->emit('alert', ['type' => 'warning', 'message' => __('lang.no_units')]);
        }
        $this->emit('changeStep',8);
    }




}
