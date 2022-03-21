<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Repositories\FacilityGroupRepository;
use App\Repositories\FacilityRepository;
use Livewire\Component;

class FacilityGroupComponent extends Component
{

    protected $facilityRepository;
    protected $facilityGroupRepository;
    protected $listeners = ['reloadGroups'];

    public function render()
    {
        $data = [
            'current_step'          => 6,
            'page_title'            => __('lang.setup_groups'),
            'page_description'      => __('lang.setup_groups_description'),
            'steps'                 => $this->steps,
            'registration_step'     => $this->facility->registration_step
        ];
        return view('livewire.facility.register-steps.facility-group-component',compact('data'));
    }
    public function mount($steps,$facilityId){
        $this->steps = $steps;
        $this->facilityId = $facilityId;
        $this->facility = $this->facilityRepository->findById($facilityId,['*'],['Groups.Roles.EmployeeRole']);
        $this->companyId = $this->facility->facility_id;

    }
    public function boot(FacilityRepository $facilityRepository, FacilityGroupRepository $facilityGroupRepository){
        $this->facilityRepository = $facilityRepository;
        $this->facilityGroupRepository = $facilityGroupRepository;
    }

    public function delete($groupId){
        $el = $this->facilityGroupRepository->deleteWithRelation($groupId,'Roles');
        $this->reloadGroups();
    }

    public function reloadGroups(){
        $this->facility = $this->facilityRepository->findById($this->facilityId,['*'],['Groups.Roles.EmployeeRole']);
    }



    public function save(){

        if (!$this->facility->Groups->count()){
            return  $this->emit('alert', ['type' => 'warning', 'message' => __('lang.no_roles')]);
        }
        $this->emit('changeStep',7);
    }
}
