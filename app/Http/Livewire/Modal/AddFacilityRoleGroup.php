<?php

namespace App\Http\Livewire\Modal;

use App\Repositories\FacilityGroupRepository;
use App\Repositories\FacilityRepository;
use Livewire\Component;

class AddFacilityRoleGroup extends Component
{
    public $group_name;
    public $roles = [];

    public $group;
    protected $facilityRepository;
    protected $facilityGroupRepository;
    protected $listeners = ['assocSelect2','save' => 'addRole'];
    public function render()
    {
        return view('livewire.modal.add-facility-role-group');
    }
    public function rules(){
        return [
            'group_name'  => [
                'required',
                'unique:facility_groups,name,'.$this->groupId.',id,facility_id,'.$this->facility->id,
            ],
            'roles'     => 'required',
        ];
    }

    public function updated($group_name, $value){
        data_set($this, $group_name, filter_trim_and_null($value));
    }
    public function mount($data){
        $decoded = json_decode($data);

        $this->groupId = $decoded->groupId;
        $this->facility = $this->facilityRepository->findByid($decoded->facilityId,['*'],'Company.EmployeeRoles');
        $this->employeeRoles = $this->facility->Company->EmployeeRoles->pluck('name','id')->toArray();
        if ($this->groupId){

            $this->group = $this->facilityGroupRepository->findById($this->groupId,['*'],'Roles.EmployeeRole');
            $this->group_name = $this->group->name;
            $this->roles = $this->group->Roles->pluck('employee_role_id')->toArray();
        }


    }


    public function boot(FacilityRepository $facilityRepository, FacilityGroupRepository $facilityGroupRepository){
        $this->facilityRepository = $facilityRepository;
        $this->facilityGroupRepository = $facilityGroupRepository;

    }

    public function addRole(FacilityGroupRepository $facilityGroupRepository){

        $this->emit('reinitSelect2');
        $this->validate();

        $group =  $facilityGroupRepository->updateOrCreateByMultipleConditions(
            [
                'facility_id'   => $this->facility->id,
                'id'            => $this->group ? $this->group->id : null
            ],
            [
                'name'          => $this->group_name
            ]
        );


        foreach ($this->roles as $role){
            $group->Roles()->firstOrCreate(
                [
                    'employee_role_id' => $role
                ],
                [
                    'employee_role_id' => $role
                ]
            );

        }

        $this->emitTo('modals.facility-step-modal','hideFacilityModal');
        $this->emitTo('facility.register-steps.facility-group-component','reloadGroups');


    }

    public function assocSelect2($data,$model){
        $this->$model = $data;
        $this->emit('reinitSelect2');
    }
}
