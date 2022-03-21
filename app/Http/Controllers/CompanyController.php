<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function dashboard(Company $company){

        if (!auth()->user()->Company ||  auth()->user()->registration_step <= config('app.register_steps')){
            return redirect(route('company.steps'));
        }

        $facilities =   auth()->user()->Company->Facilities;
        return view('company/company-dashboard', compact('facilities'));
    }
}
