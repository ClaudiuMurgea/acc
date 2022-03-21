<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyBilling;
use Database\Factories\CompanyBillingFactory;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(){
        Company::factory()->times(1)->create()->each(function(Company $company){
            $cb = CompanyBilling::factory()->make();
            $cb->company_id = $company->id;
            $cb->save();
        });
    }
}
