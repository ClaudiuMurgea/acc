<?php

namespace App\Http\Livewire\Facility\Departments;

use Livewire\Component;

class FacilityDepartmentComponent extends Component
{

    public $showCreate = false;
    public $showList = true;
    public $showEdit = false;
    public $title;
    public $departmentId;


    protected $listeners = ['show'];

    public function render()
    {
        return view('livewire.facility.departments.facility-department-component');
    }


    public function mount($facilityId){
        $this->facility_id = $facilityId;
        $this->title = __('lang.manage_what',['what' => 'Departments']);
    }

    public function show($show,$departmentId = null){


        $this->hideAll();
        $this->$show = true;

        if ($show == 'showList'){

            $this->title = __('lang.manage_what',['what' => 'Departments']);


        }elseif ($show == 'showCreate'){
            $this->title = __('lang.action',['action' => __('lang.add',['what' => __('lang.department')])]);
        }elseif ($show == 'showEdit'){
            $this->title =  __('lang.action',['action' => __('lang.edit',['what' => __('lang.department')])]);
            $this->departmentId = $departmentId;
        }


    }

    private function hideAll(){
        $this->showList = false;
        $this->showCreate = false;
        $this->showEdit = false;
    }
}
