<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use App\Repositories\FacilityRepository;
use Illuminate\Http\Request;

class StepController extends Controller
{

    public $companyRepository;
    public $facilityRepository;

    public function __construct(CompanyRepository $companyRepository,FacilityRepository $facilityRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->facilityRepository = $facilityRepository;
    }

    public function details(){


        if (!auth()->user()->Company  ||  auth()->user()->registration_step < config('app.register_steps')){

            $title = 'Company Details';
            return view('company.steps.details',compact('title'), [
                'layout' => 'login'
            ]);


        }

        return redirect(route('company.dashboard',auth()->user()->Company->id));
    }

    public function addfacility($companyId,$facilityId = null){
        //IF LOGGEN USER IS ADMIN TO THIS COMPANY AND THIS FACILITY IS BELONG TO THIS COMPANY

        if (!$this->companyRepository->findByColumns(['id' => $companyId,'admin_id' => auth()->id()]) || ($facilityId && !$this->facilityRepository->findByColumns(['company_id' => $companyId,'id' => $facilityId]))){

            return redirect(route('company.dashboard'));
        }
        $title = 'Facility Details';
        $layout = 'no-menu';
        return view('facility.steps.details',compact('title','companyId','facilityId','layout'));
    }
}
