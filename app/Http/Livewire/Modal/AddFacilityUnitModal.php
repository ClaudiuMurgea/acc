<?php

namespace App\Http\Livewire\Modal;

use App\Models\Company;
use App\Models\Facility;
use App\Models\FacilityGroup;
use App\Repositories\FacilityGroupRepository;
use App\Repositories\FacilityUnitRepository;
use Livewire\Component;

class AddFacilityUnitModal extends Component
{
    public $companyId ;
    public $name;
    public $type;
    public $group;
    public $budget;
    public $facilityId;
    protected $facilityUnitRepository;

    protected $listeners = ['save'];

    protected $rules = [
        'name'  => 'required',
        'type'  => 'required',
        'group' => 'required',
        'budget' => 'required|numeric|integer|min:1'
    ];
    public function render()
    {
        return view('livewire.modal.add-facility-unit-modal');
    }

    public function mount($companyId,$data){
        $decoded = json_decode($data);
        $this->unitId = $decoded->unitId;
        $this->facilityId = $decoded->facilityId;
        if ($this->unitId){

            $this->unit = $this->facilityUnitRepository->findById($this->unitId,['*'],'Group');

            $this->name = $this->unit->name;
            $this->type = $this->unit->type;
            $this->group = $this->unit->facility_group_id;
            $this->budget = $this->unit->budget;
        }


        $this->groups = Facility::find($this->facilityId)->Groups->pluck('name','id')->prepend(__('lang.select',['what' => __('lang.group')]), '0');
    }

    public function boot(FacilityUnitRepository $facilityUnitRepository){
        $this->facilityUnitRepository = $facilityUnitRepository;

    }

    public function save(FacilityUnitRepository $facilityUnitRepository){

        $this->validate();
        $group =  $facilityUnitRepository->updateOrCreateByMultipleConditions(
            [
                'id'           => $this->unitId,

            ],
            [
                'name'          => $this->name,
                'facility_id'          => $this->facilityId,
                'type'          => $this->type,
                'budget'        => $this->budget,
                'facility_group_id'     => $this->group
            ]
        );

        $this->emitTo('modals.facility-step-modal','hideFacilityModal');
        $this->emitTo('facility.register-steps.facility-units-component','reloadUnits');

    }


}
