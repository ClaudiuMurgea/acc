<?php

namespace App\Http\Livewire\Company\RegisterSteps;

use App\Models\City;
use App\Repositories\CompanyBillingRepository;
use App\Repositories\CountryRepository;
use Livewire\Component;

class CompanyBillingComponent extends Component
{

    public $companyId;

    public $billing_name;
    public $phone_number;
    public $billing_address;
    public $billing_address2;

    public $zip_code;

    public $countryList;
    public $country_id;
    public $ignoreStates = false;
    public $ignoreCities = false;
    public $statesList = [];
    public $state_id;

    public $citiesList = [];
    public $city_id;
    public $city;
    protected $rules =[
        'billing_name'  => 'required',
        'phone_number'  => 'required|phone:US,RO',
        'billing_address'       => 'required',
        'zip_code'      => 'required|numeric',
        'country_id'    => 'required|exists:countries,id',
        'city_id'       => 'required|exists:cities,id',
        'state_id'      => 'required|exists:states,id',
    ];
    protected $listeners = ['updateCountry_id', 'updateState_id', 'updateCity_id'];
    protected $countryRepository;

    public function render()
    {
        $data = [
            'current_step'  => 2,
            'page_title'    => __('lang.billing_setup'),
            'page_description'  => __('lang.billing_setup_description'),
            'steps'             => $this->steps
        ];



        return view('livewire.company.register-steps.company-billing-component',compact('data'));
    }



    public function mount($companyId,CompanyBillingRepository $companyBillingRepository,$steps,CountryRepository $countryRepository){
        $this->companyId = $companyId;


        $billingData = $companyBillingRepository->findByColumn('company_id',$this->companyId);
        $this->countryList = $countryRepository->all()->pluck('name', 'id')->prepend(__('lang.select',['what' => __('lang.country')]), '');


        if ($billingData){
            $this->billing_name = $billingData->billing_name;
            $this->phone_number = $billingData->billing_phone_number;
            $this->billing_address = $billingData->billing_address;
            $this->billing_address2 = $billingData->billing_address2;
            $this->zip_code = $billingData->zip_code;

            $this->country_id = $billingData->country_id;
            $this->city_id = $billingData->city_id;
            $this->state_id = $billingData->state_id;

            $this->citiesList = City::where('state_id', $this->state_id)->get()->pluck('name', 'id');

            $this->statesList = $countryRepository->findById($this->country_id,['*'],['States'])->States->pluck('name','id')->prepend(__('lang.select',['what' => __('lang.state')]), '');
        }

        $this->steps = $steps;
    }

    public function booted(CountryRepository $countryRepository){
        $this->countryRepository = $countryRepository;

    }
    public function dehydrate(){
        $this->emit('reinitSelect2');
    }

    public function updateCountry_id($id){

        if ($this->country_id != $id){
            $this->statesList = [];
            $this->citiesList = [];
        }
        $this->country_id = $id;
        $this->state_id = '';

        $this->statesList = $this->countryRepository->findById($id,['*'],['States'])->States->pluck('name','id')->prepend(__('lang.select',['what' => __('lang.state')]), '');

       // $this->emit('reinitSelect2');


    }

    public function updateState_id($id){

        if ($this->state_id != $id){
            $this->citiesList = [];
        }
        $this->state_id = $id;
        $this->city_id = '';
        $this->citiesList = City::where('state_id', intval($id))->get()->pluck('name', 'id')->prepend(__('lang.select',['what' => __('lang.city')]), '');;
        $this->emit('reinitSelect2');
    }

    public function updateCity_id($id){
        $this->city_id = $id;
    }


    public function save(CompanyBillingRepository $companyBillingRepository){
        $this->shouldSkipRender = false;
        $this->validate();
        $data = [
            'company_id'  => $this->companyId,
            'billing_name'  => $this->billing_name,
            'billing_phone_number'   => $this->phone_number,
            'billing_address'     => $this->billing_address,
            'billing_address2' => $this->billing_address2,
            'city_id'                   => $this->city_id,
            'state_id'                   => $this->state_id,
            'zip_code'                   => $this->zip_code,
            'country_id'                   => $this->country_id
        ];
        $companyBillingRepository->updateOrCreate($this->companyId,$data,'company_id');
        $this->emit('changeStep',3,$this->companyId);
    }
}
