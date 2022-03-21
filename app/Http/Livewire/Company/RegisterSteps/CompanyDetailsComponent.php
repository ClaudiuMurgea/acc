<?php

namespace App\Http\Livewire\Company\RegisterSteps;

use App\Repositories\CompanyRepository;
use Livewire\Component;

class CompanyDetailsComponent extends Component
{
    public $company_name;
    public $no_of_locations;
    public $corporate_address;
    public $corporate_phone_number;
    public $ein;
    public $poc;
    public $week_start;
    public $hour_format;


    protected $rules = [
        'company_name'  => 'required',
        'no_of_locations'   => 'required|numeric|min:0',
        'corporate_address'    => 'required',
        'corporate_phone_number'    => 'required|phone:US,RO',
        'ein'    => 'required',
        'hour_format' => 'required|in:0,1',
        'week_start' => 'required|in:0,1'
    ];

    public function render()
    {
        $data = [
            'current_step'  => 1,
            'page_title'    => __('lang.setup_account'),
            'page_description'  => __('lang.setup_account_description'),
            'steps'             => $this->steps
        ];
        return view('livewire.company.register-steps.company-details-component',compact('data'));
    }

    public function mount(CompanyRepository $companyRepository,$steps){
        $company = $companyRepository->findByColumn('admin_id',auth()->id());

        if ($company){
            $this->company_name = $company->name;
            $this->no_of_locations = $company->number_of_locations;
            $this->corporate_address = $company->corporate_address;
            $this->corporate_phone_number = $company->corporate_phone_number;
            $this->ein = $company->ein;
            $this->poc = $company->poc;
            $this->week_start = $company->week_start;
            $this->hour_format = $company->am_pm;
        }
        $this->steps = $steps;
    }

    public function save(CompanyRepository $companyRepository){
        $this->validate();


        $data = [
            'admin_id'  => auth()->id(),
            'name'  => $this->company_name,
            'number_of_locations'   => $this->no_of_locations,
            'corporate_address'     => $this->corporate_address,
            'corporate_phone_number' => $this->corporate_phone_number,
            'ein'                   => $this->ein,
            'poc'                   => $this->poc,
            'week_start'            => $this->week_start,
            'am_pm'                 => $this->hour_format
        ];

        $company =  $companyRepository->updateOrCreate(auth()->id(),$data,'admin_id');
        $this->emit('changeStep',2);
        $this->emit('setCompanyId',$company->id);
        $this->emit('settimeFormat',$this->hour_format ? "h:m A" : "h:m");
    }
}
