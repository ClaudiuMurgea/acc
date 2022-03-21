<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Models\Company;
use App\Models\Facility;
use App\Repositories\CensusRepository;
use App\Repositories\FacilityRepository;
use Livewire\Component;

class FacilityCensusComponent extends Component
{
    public $provider_name;
    public $address;
    public $city;
    public $zip_code;
    public $existingCensors = false;
    public $provider;

    protected $rules = [
        'provider_name'      => 'required',
        'address'      => 'required',
        'city'      => 'required',
        'zip_code'      => 'required|regex:/\b\d{5}\b/',
    ];

    public function render()
    {
        $data = [
            'current_step'          => 2,
            'page_title'            => __('lang.census_title'),
            'page_description'      => __('lang.census_title_description'),
            'steps'                 => $this->steps,
            'registration_step'     => $this->facility->registration_step
        ];
        return view('livewire.facility.register-steps.facility-census-component',compact('data'));
    }

    public function mount($steps,$companyId,$facilityId){
        $this->steps = $steps;
        $this->companyId = $companyId;
        $this->facilityId = $facilityId;
        $this->facility = Facility::find($facilityId);

        if ($this->facility->census_id){

            $this->existingCensors = true;
            $this->provider = $this->facility->census_id;
        }
        $this->censuses = Company::find($companyId)->Censuses->pluck('name','id')->prepend(__('lang.select',['what' => __('lang.provider')]), '0');


    }
    public function toggleCensors($bool){
        $this->existingCensors = $bool;
        $this->provider = $this->facility->census_id;
    }
    public function save(CensusRepository $censusRepository,FacilityRepository $facilityRepository){

        if ($this->provider && $this->existingCensors){
            $facilityRepository->update(
                $this->facilityId,
                [
                    'census_id' => $this->provider
                ]
            );
        }else{
            $this->validate();

            $data = [
                'company_id'    => $this->companyId,
                'name'  => $this->provider_name,
                'address'  => $this->address,
                'city'      => $this->city,
                'zip_code'  => $this->zip_code
            ];

            $facilityRepository->update(
                $this->facilityId,
                [
                    'census_id' => $censusRepository->create($data)->id
                ]
            );
        }
        $this->emit('changeStep',3);

    }

}
