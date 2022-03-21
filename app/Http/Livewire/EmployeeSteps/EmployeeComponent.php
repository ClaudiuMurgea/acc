<?php

namespace App\Http\Livewire\EmployeeSteps;

use App\Models\Benefit;
use App\Models\CompanyEmployeeTypes;
use App\Models\DepartmentEmployee;
use App\Models\Employee;
use App\Models\EmployeeBenefit;
use App\Models\EmployeeRole;
use App\Models\Facility;
use App\Models\RateOfPayOption;
use App\Repositories\CompanyDepartmentsRepository;
use App\Repositories\CountryRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\StateRepository;
use Livewire\Component;

class EmployeeComponent extends Component
{
    public $option = "";
    public $first_name;
    public $last_name;
    public $date_of_birth;
    public $date_of_hire;
    public $social_security;
    public $address;
    public $zip_code;
    public $mobile_phone;
    public $alt_phone;
    public $email = "";
    public $alt_email;
    public $payroll_no;
    public $phone;
    public $title;

    public $countryList = [];
    public $country_id = 0;
    public $country;

    public $statesList = [];
    public $state_id = 0;

    public $citiesList = [];
    public $city_id = 0;

    public $departmentList =[];
    public $department_id = 0;

    public $positionsList = [];
    public $position_id = 0;

    public $approvedbyList = [];
    public $approved_by = 0;

    public $employeeTypes = [];
    public $employee_type_id = 0;

    public $company_id;

    public $rate_of_pay_option = 0;
    public $rate_of_pay_options = [];
    public $rate_of_pay;

    public $benefitsSelected = [];
    public $benefitsList = [];

    public $facilitiesList = [];
    public $facility_id = 0;

    public $days = [];

    public $employeeSearchQuery;
    public $employee;
    public $employeeList = [];
    public $editEmployee = false;

    protected $countryRepository;
    protected $stateRepository;
    protected $employeeRepository;
    protected $companyDepartmentsRepository;

    protected $listeners = ['setDOB', 'setDOH', 'updateCountry_id', 'updateState_id', 'updateCity_id',
        'updateDepartment_id','updatePosition_id', 'updateEmployee_type_id', 'addBenefit',
        'updateRateApprovedBy','updateRate_of_pay_option_id','updateFacility_id'
    ];

    function rules() {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'date_of_hire' => 'required|date',
            'social_security' => 'required|string',
            'address' => 'required|string',
            'zip_code' => 'required|string',
            'title' => 'required|string',

            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mobile_phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'alt_phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',

            'email' => 'required|email',
            'alt_email' => 'nullable|email',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'country_id' => 'required|exists:countries,id',
            'position_id' => 'required|exists:employee_roles,id',
            'rate_of_pay' => 'required|numeric',
            'rate_of_pay_option' => 'required|exists:rate_of_pay_options,id',
            'department_id' => 'required|exists:company_departments,id',
            'approved_by' => 'required|exists:employee,id',
            'company_id'        => 'required|exists:companies,id',
            'payroll_no'        => 'required|string|'.
                ($this->employee != null ? 'unique:App\Models\Employee,id,'.$this->employee->id : ''),
            'facility_id'       => 'required|exists:facilities,id',
        ];
    }

    public function updateRate_of_pay_option_id($id, $model){
        if($id == 0){
            $this->emitReinitSelect2();
            return;
        }
        $this->$model = $id;
        $this->emitReinitSelect2();
    }

    public function updateRateApprovedBy($id, $model){
        if($id == 0){
            $this->emitReinitSelect2();
            return;
        }
        $this->$model = $id;
        $this->emitReinitSelect2();
    }

    public function updatedEmployeeSearchQuery($val){
        if(strlen(trim($val)) == 0){
            $this->employeeSearchQuery = null;
            $this->employeeList = [];
            $this->employee = null;
            $this->resetEmployeeFields();
        } else {
            $this->employeeSearchQuery = $val;
            $this->employeeList = Employee::where("first_name", "like", "%".$val."%")
                ->orWhere("last_name", "like", "%".$val."%")
                ->get()->toArray();
        }
        $this->emitReinitSelect2();
    }

    public function chooseEmployee($eid){
        if($this->employee != null && $this->employee->id == $eid ){
            $this->emitReinitSelect2();
            return;
        }
        $this->resetEmployeeFields();
        $this->employee = Employee::where(['id' => $eid])->first();
        $this->editEmployee = true;
        $this->employeeSearchQuery = $this->employee->first_name. " ".$this->employee->last_name;

        if($this->employee){
            $this->getDataFromEmployee($this->employee);
            $this->emitReinitSelect2();
        }
    }

    public function booted(CountryRepository $countryRepository,StateRepository $stateRepository,CompanyDepartmentsRepository $companyDepartmentsRepository ){
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
        $this->companyDepartmentsRepository = $companyDepartmentsRepository;
    }

    public function render()
    {
        return view('livewire.employee-steps.employee-component');
    }

    public function mount(CountryRepository $countryRepository, StateRepository $stateRepository, EmployeeRepository $employeeRepository,
                          CompanyDepartmentsRepository $companyDepartmentsRepository){
        $this->countryList = $countryRepository->all()->pluck('name', 'id')->prepend('Select a country',0);

        $this->employeeRepository = $employeeRepository;
        $this->company_id =  auth()->user()->Company->id;

        $this->departmentList = $companyDepartmentsRepository->getByCompanyID($this->company_id)->mapWithKeys(function ($company_department, $key){
                return [$company_department->department_id => $company_department->Department->name];
            })->prepend('Select a department',0)->toArray();

        $this->positionsList = EmployeeRole::where(['company_id' => $this->company_id])->get()
            ->pluck('name', 'id')->prepend('Select a position', 0)->toArray();

        $this->employeeTypes = CompanyEmployeeTypes::where(['company_id' => $this->company_id])
            ->get()->mapWithKeys(function ($company_employee_types, $key){
                return [$company_employee_types->employee_type_id => $company_employee_types->Type->name];
            })->prepend('Select worked days',0)->toArray();
        $this->rate_of_pay_options = RateOfPayOption::where(['company_id' => $this->company_id])->get()->pluck('name', 'id')
            ->prepend('Select a rate of pay', 0)->toArray();
        $this->approvedbyList = Employee::all()->pluck('fullname', 'id')
            ->prepend('Select a employee', 0)
            ->toArray();

        $this->facilitiesList = Facility::where(['company_id' => $this->company_id])->get()->pluck('name', 'id')
            ->prepend('Select a facility', 0)->toArray();

        $this->benefitsList = Benefit::all()->toArray();

    }

    public function setStep($step){
        $this->emit('loadGlobalPicker');
        $this->employee = null;
        $this->resetEmployeeFields();
        $this->option = $step;
        $this->emit('firstInit');
    }

    public function setDOB($value,$model){
        $this->$model = $value;
        $this->emitReinitSelect2();
    }

    public function setDOH($value,$model){
        $this->$model = $value;
        $this->emitReinitSelect2();
    }

    public function updateCountry_id($id, $model){
        $this->$model = $id;
        $this->statesList = $this->countryRepository->findById($id,['*'],['States'])->States->pluck('name','id')
            ->prepend('Select a state',0)
            ->toArray();
        $this->state_id = 0;
        $this->city_id = 0;
        $this->emitReinitSelect2();
    }

    public function updateState_id($id, $model){
        if($id == 0) {
            $this->emitReinitSelect2();
            return;
        }
        $this->$model = $id;
        $this->citiesList = \App\Models\City::where('state_id', intval($id))->get()->pluck('name', 'id')
            ->prepend('Select a city',0)
            ->toArray();
        $this->stateRepository->findById($id,['*'],['cities'])->Cities->pluck('name','id')->toArray();
        $this->emitReinitSelect2();
    }

    public function updateCity_id($id, $model){
        if($id == 0) {
            $this->emitReinitSelect2();
            return;
        }
        $this->$model = $id;
        $this->emitReinitSelect2();
    }

    public function updateDepartment_id($id, $model){
        if($id == 0){
            $this->emitReinitSelect2();
            return;
        }
        $this->$model = $id;
        $this->emitReinitSelect2();
    }

    public function updatePosition_id($id, $model){
        if($id == 0){
            $this->emitReinitSelect2();
            return;
        }
        $this->$model = $id;
        $this->emitReinitSelect2();
    }

    public function updateEmployee_type_id($id, $model){
        if($id == 0){
            $this->emitReinitSelect2();
            return;
        }
        $this->$model = $id;
        $this->emitReinitSelect2();
    }

    public function updateFacility_id($id, $model){
        if($id == 0){
            $this->emitReinitSelect2();
            return;
        }
        $this->$model = $id;
        $this->emitReinitSelect2();
    }

    public function addBenefit($bid, $bname){
        if( isset($this->benefitsSelected[$bid]) ){
            unset($this->benefitsSelected[$bid]);
        } else {
            $this->benefitsSelected[$bid] = [];
            $this->benefitsSelected[$bid]['name'] = $bname;
        }
        $this->emitReinitSelect2();
    }

    private function emitReinitSelect2(){
        $this->emit('reinitSelect2');
    }

    public function save(){
        $this->withValidatorCallback = function ($validator){
            call_user_func(array($this, 'emitReinitSelect2'), $validator);
        };
        $this->validate();

        $data = [
            "first_name"        =>  $this->first_name,
            "last_name"         =>  $this->last_name,
            "date_of_birth"     =>  $this->date_of_birth,
            "date_of_hire"      =>  $this->date_of_hire,
            "social_security"   =>  $this->social_security,
            "address"           =>  $this->address,
            "zipcode"           =>  $this->zip_code,
            'title'             => $this->title,

            "phone"             =>  $this->phone,
            "mobile_phone"      =>  $this->mobile_phone,
            "alt_phone"         =>  $this->alt_phone,

            "email"             =>  $this->email,
            "email2"            =>  $this->alt_email,
            "city_id"           =>  $this->city_id,
            "state_id"          =>  $this->state_id,
            "country_id"        =>  $this->country_id,
            'employee_role_id'  =>  $this->position_id,
            "rate_of_pay"       =>  $this->rate_of_pay,
            "rate_of_pay_option_id"  => $this->rate_of_pay_option,
            'approved_by'       => $this->approved_by,
            "department_id"     => $this->department_id,
            "employee_type_id"  => $this->employee_type_id,
            'company_id'        => $this->company_id,
            'payroll_no'        => $this->payroll_no,
            'facility_id'       => $this->facility_id,
            //'benefits' => $this->benefitsSelected,
            'days' => $this->days,
        ];
        $this->saveEmployee($data);
        $this->emit('savedEmployee');
        $this->emitReinitSelect2();
    }

    private function resetEmployeeFields(){
        $this->first_name = null;
        $this->last_name = null;
        $this->date_of_birth = null;
        $this->date_of_hire = null;
        $this->social_security = null;
        $this->address = null;
        $this->zip_code = null;
        $this->mobile_phone = null;
        $this->alt_phone = null;
        $this->email = null;
        $this->alt_email = null;
        $this->title = null;

        $this->city_id = null;
        $this->state_id = null;
        $this->country_id = null;
        $this->position_id = null;
        $this->rate_of_pay = null;
        $this->rate_of_pay_option = null;
        $this->department_id = null;

        $this->payroll_no = null;
        $this->facility_id = null;

        $this->employee_type_id = null;
        $this->statesList = [];
        $this->citiesList = [];
        $this->days = [];
        $this->benefitsSelected = [];
    }

    private function getDataFromEmployee(Employee $employee)
    {
        $this->statesList = $this->countryRepository->findById($employee->country_id,['*'],['States'])->States->pluck('name','id')
            ->prepend('Select a state',0)
            ->toArray();
        $this->citiesList = \App\Models\City::where('state_id', intval($employee->state_id))->get()->pluck('name', 'id')
            ->prepend('Select a city',0)
            ->toArray();
        $this->departmentList = $this->companyDepartmentsRepository->getByCompanyID($this->company_id)->mapWithKeys(function ($company_department, $key){
                return [$company_department->department_id => $company_department->Department->name];
            })->prepend('Select a department',0)->toArray();

        $this->positionsList = EmployeeRole::where(['company_id' => $this->company_id])->get()
            ->pluck('name', 'id')->prepend('Select a position', 0)->toArray();

        $this->employeeTypes = CompanyEmployeeTypes::where(['company_id' => $this->company_id])
            ->get()->mapWithKeys(function ($company_employee_types, $key){
                return [$company_employee_types->employee_type_id => $company_employee_types->Type->name];
            })->prepend('Select worked days',0)->toArray();

        $this->rate_of_pay_options = RateOfPayOption::where(['company_id' => $this->company_id])->get()->pluck('name', 'id')
            ->prepend('Select a rate of pay', 0)->toArray();

        $this->benefitsList = Benefit::all()->toArray();

        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->date_of_birth = $employee->date_of_birth;
        $this->date_of_hire = $employee->date_of_hire;
        $this->social_security = $employee->social_security;
        $this->address = $employee->address;
        $this->zip_code = $employee->zipcode;
        $this->phone = $employee->phone;
        $this->mobile_phone = $employee->mobile_phone;
        $this->alt_phone = $employee->alt_phone;
        $this->email = $employee->email1;
        $this->alt_email = $employee->email2;
        $this->title = $employee->title;
        $this->facility_id = $employee->facility_id;

        $this->city_id = $employee->city_id;
        $this->state_id = $employee->state_id;
        $this->country_id = $employee->country_id;
        $this->position_id = $employee->employee_role_id;
        $this->rate_of_pay = $employee->rate_of_pay;
        $this->rate_of_pay_option = $employee->rate_of_pay_option_id;
        $this->department_id = $employee->DepartmentEmployee->department_id;
        $this->approved_by = $employee->approved_by;

        $this->employee_type_id = $employee->employee_type_id;
        $this->payroll_no = $employee->payroll_no;

        $benefitsSelected = EmployeeBenefit::where(['employee_id' => $this->employee->id])->get();

        foreach ($benefitsSelected as $b){
            $this->benefitsSelected[$b->benefit_id] = [];
            $this->benefitsSelected[$b->benefit_id]['name'] = $b->Benefit->name;
            $this->benefitsSelected[$b->benefit_id]['value'] = $b->number_of_days;
            $this->days[$b->benefit_id] = [];
            $n = strtolower(join("_", preg_split('/\s+/', $b->Benefit->name )));
            $this->days[$b->benefit_id][$n] = $b->number_of_days;
        }
    }

    private function saveEmployee(array $data)
    {
        $isNew = false;
        if($this->employee != null){
        } else {
            $this->employee = new Employee();
            $isNew = true;
        }
        $this->employee->first_name            =  $data['first_name'];
        $this->employee->last_name             =  $data['last_name'];
        $this->employee->date_of_birth         =  $data['date_of_birth'];
        $this->employee->date_of_hire          =  $data['date_of_hire'];
        $this->employee->social_security       =  $data['social_security'];
        $this->employee->address               =  $data['address'];
        $this->employee->zipcode               =  $data['zipcode'];
        $this->employee->phone                 =  $data['phone'];
        $this->employee->mobile_phone          =  $data['mobile_phone'];
        $this->employee->alt_phone             =  $data['alt_phone'];
        $this->employee->email1                =  $data['email'];
        $this->employee->email2                =  $data['email2'];
        $this->employee->city_id               =  $data['city_id'];
        $this->employee->state_id              =  $data['state_id'];
        $this->employee->country_id            =  $data['country_id'];
        $this->employee->employee_role_id      =  $data['employee_role_id'];
        $this->employee->rate_of_pay           =  $data['rate_of_pay'];
        $this->employee->rate_of_pay_option_id =  $data['rate_of_pay_option_id'];
        $this->employee->approved_by           =  $data['approved_by'];
        $this->employee->employee_type_id      =  $data['employee_type_id'];
        $this->employee->title                 =  $data['title'];

        $this->employee->company_id            =  $data['company_id'];
        $this->employee->payroll_no            =  $data['payroll_no'];
        $this->employee->facility_id           =  $data['facility_id'];

        $this->employee->save();
        $employeeBenefits = null;
        if(!$isNew){
            $employeeBenefits = EmployeeBenefit::where(['employee_id' => $this->employee->id ])->get();
            $dep = DepartmentEmployee::where([
                'department_id' => $data['department_id'],
                'employee_id' => $this->employee->id
                ])->get()->first();
            if( $dep){
                $dep->delete();
            } else {
                $dep = new DepartmentEmployee();
                $dep->employee_id = $this->employee->id;
                $dep->department_id = $data['department_id'];
                $dep->save();
            }
        } else {
            $dep = new DepartmentEmployee();
            $dep->employee_id = $this->employee->id;
            $dep->department_id = $data['department_id'];
            $dep->save();
        }
        foreach ($data['days'] as $benefitID => $day) {
            $eb = null;
            if($employeeBenefits){
                $eb = $employeeBenefits->firstWhere('benefit_id', $benefitID);
            }
            if($eb == null ) $eb = new EmployeeBenefit();
            $eb->employee_id = $this->employee->id;
            $eb->benefit_id = $benefitID;
            foreach ($day as $dname => $ddays){
                $eb->number_of_days = $ddays;
            }
            $eb->save();
        }
    }

}
