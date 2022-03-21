<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Models\EmployeeRole;
use App\Repositories\FacilityRepository;
use Livewire\Component;

class FacilityEmployeeRolesComponent extends Component
{
    public $modal = false;
    protected $facilityRepository;
    public $roleId;

    protected $listeners = ['reloadRoles'];

    public function render()
    {
        $data = [
            'current_step'          => 5,
            'page_title'            => __('lang.setup_employee_role'),
            'page_description'      => __('lang.setup_employee_role_description'),
            'steps'                 => $this->steps,
            'registration_step'     => $this->facility->registration_step
        ];
        return view('livewire.facility.register-steps.facility-employee-roles-component',compact('data'));
    }
    public function mount($steps,$facilityId){

        $this->steps = $steps;
        $this->facilityId = $facilityId;
        $this->facility = $this->facilityRepository->findById($facilityId,['*'],['Company']);
        $this->employee_roles = $this->facility->Company->EmployeeRoles;
        $this->companyId = $this->facility->Company->id;

    }

    public function boot(FacilityRepository $facilityRepository){
        $this->facilityRepository = $facilityRepository;
    }

    public function delete($roleId){
        EmployeeRole::find($roleId)->delete();
        $this->employee_roles = $this->facility->Company->EmployeeRoles;
        $this->reloadRoles();
    }



    public function reloadRoles(){
        $this->facility = $this->facilityRepository->findById($this->facilityId,['*'],['Company.EmployeeRoles']);
        $this->employee_roles = $this->facility->Company->EmployeeRoles;

    }


    public function save()
    {
        if (!$this->employee_roles->count()){
            return $this->emit('alert', ['type' => 'warning', 'message' => __('lang.no_role_alert')]);
        }
        $this->emit('changeStep',6);
    }
}
