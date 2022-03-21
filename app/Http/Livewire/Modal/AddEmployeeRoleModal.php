<?php

namespace App\Http\Livewire\Modal;

use App\Models\EmployeeRole;
use App\Repositories\EmployeeRoleRepository;
use Livewire\Component;

class AddEmployeeRoleModal extends Component
{
    public $name;
    public $roleId;
    protected $employeeRoleRepository;

    protected $listeners = ['save'];
    public function rules(){
        return [
            'name'  => [
                'required',
                'unique:employee_roles,name,'.$this->roleId.',id,company_id,'.$this->companyId,
            ]
        ];
    }
    public function render()
    {
        return view('livewire.modal.add-employee-role-modal');
    }
    public function mount($companyId,$data){


        $this->companyId = $companyId;
        $decoded = json_decode($data);

        if ($decoded->roleId){
            $role = EmployeeRole::find($decoded->roleId);
            $this->roleId = $role->id;
            $this->name = $role->name;
        }



    }
    public function boot(EmployeeRoleRepository $employeeRoleRepository){
        $role = EmployeeRole::find($this->roleId);


        if ($role){
            $this->roleId = $role->id;
            $this->name = $role->name;
        }

        $this->employeeRoleRepository = $employeeRoleRepository;
    }

    public function save(){


        $this->validate();
        $roleId = !$this->roleId ? null : $this->roleId;


            $conditions = [
                'company_id' => $this->companyId,
                'id'         => $roleId
            ];



        $data = [
            'name'  => $this->name
        ];
        $this->employeeRoleRepository->updateOrCreateByMultipleConditions(
            $conditions,
            $data
        );

        $this->emitTo('modals.facility-step-modal','hideFacilityModal');
        $this->emitTo('facility.register-steps.facility-employee-roles-component','reloadRoles');
        $this->roleId = null;
        $this->name = null;
    }
}
