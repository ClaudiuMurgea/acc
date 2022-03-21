<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $show = false;
    public $showFacilityModals = false;
    public $companyId;
    public $componentName;
    public $type;
    public $data = null;
    protected $listeners = [
        'show',
        'setHoliday',
        'showFacilityModal',
        'hideFacilityModal',

    ];

    public function setHoliday($value,$model){
        $this->$model = $value;
    }

    public function show($companyId){


        $this->companyId = $companyId;
        $this->emit('loadGlobalPicker');
        $this->show = true;
    }

    public function showFacilityModal($type,$companyId,$data = null){



        if ($type == 'employee_role') {
            $this->componentName = 'modal.add-employee-role-modal';
        }elseif ($type == 'role_groups'){
            $this->componentName = 'modal.add-facility-role-group';
        }elseif ($type == 'facility_unit'){
            $this->componentName = 'modal.add-facility-unit-modal';
        }

        $this->type = $type;
        $this->data = $data;
        $this->companyId = $companyId;

        $this->showFacilityModals = true;

        $this->emit('reinitSelect2');

    }

    public function hideFacilityModal(){
        $this->type = null;
        $this->showFacilityModals = false;
        $this->componentName = null;
    }
}
