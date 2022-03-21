<?php

namespace Database\Seeders;

use App\Models\ContractType;
use App\Models\EmployeeType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InsertTimezones::class);
        $this->call(CountryData::class);
        $this->call(CountryStateCityTableSeeder::class);
        echo "seeding holiday".PHP_EOL;
        $hs = new HolidaySeeder();
        $hs->run();
        /*
         "id","name","created_at","updated_at"
"1","Full-Time Employees(FTE)",NULL,NULL
"2","Part-Time Employees(PTE)",NULL,NULL
"3","Agency Employees",NULL,NULL
"4","Contract Employees",NULL,NULL
"5","Interns",NULL,NULL
         * */
        $types = [
            ["name" => "Full-Time Employees(FTE)"],
            ["name" => "Part-Time Employees(PTE)"],
            ["name" => "Agency Employees"],
            ["name" => "Contract Employees"],
            ["name" => "Interns"],
        ];
        ContractType::insert($types);

        echo "seeding company".PHP_EOL;
        $cs = new CompanySeeder();
        $cs->run();

        echo "seeding company departments".PHP_EOL;
        $cds = new CompanyDepartmentsSeeder();
        $cds->run();

        echo "seeding facilities".PHP_EOL;
        $fs = new FacilitySeeder();
        $fs->run();
        echo "seeding holiday".PHP_EOL;
        $hs = new HolidaySeeder();
        $hs->run();

        echo "seeding benefits".PHP_EOL;
        $bs = new BenefitsSeeder();
        $bs->run();

        echo "seeding shifts".PHP_EOL;
        $shiftsS = new ShiftsSeeder();
        $shiftsS->run();

       /* echo "seeding employees".PHP_EOL;
        $es = new EmployeeSeeder();
        $es->run();*/
    }
}
