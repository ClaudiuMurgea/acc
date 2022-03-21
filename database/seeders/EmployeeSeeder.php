<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyDepartments;
use App\Models\CompanyEmployeeTypes;
use App\Models\DepartmentEmployee;
use App\Models\Employee;
use App\Models\EmployeeRole;
use App\Models\EmployeeType;
use App\Models\RateOfPayOption;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ropOption = [
            ['name' => 'Hourly', 'company_id' => 1, ],
            ['name' => 'Daily', 'company_id' => 1, ],
        ];
        RateOfPayOption::insert($ropOption);
        $roles = [
            ['name' => 'Nurse', 'company_id' => 1],
            ['name' => 'Administrative Assistant', 'company_id' => 1]
        ];
        EmployeeRole::insert($roles);
        Employee::factory()->times(50)->create()->each(function (Employee $employee){
            $cdepartment = CompanyDepartments::inRandomOrder()->first();
            $de = new DepartmentEmployee();
            $de->department_id = $cdepartment->id;
            $de->employee_id = $employee->id;
            $de->save();


        });
        $ets = EmployeeType::all();
        foreach ($ets as $et){
            $company_id = Company::inRandomOrder()->first()->id;
            $cet = new CompanyEmployeeTypes();
            $cet->company_id = $company_id;
            $cet->employee_type_id = $et->id;
            $cet->order = 0;
            $cet->save();
        }


    }
}
