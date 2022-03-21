<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyDepartmentsSeeder extends Seeder
{
    public function run(){
        $companies = \App\Models\Company::all();
        $departments = \App\Models\Department::all();

        foreach ($companies as $company ){
            foreach ($departments as $department){
                $cd = new \App\Models\CompanyDepartments();
                $cd->company_id = $company->id;
                $cd->department_id = $department->id;
                $cd->save();
            }
        }
    }
}
