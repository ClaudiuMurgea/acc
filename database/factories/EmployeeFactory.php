<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use App\Models\CompanyDepartments;
use App\Models\Country;
use App\Models\Department;
use App\Models\EmployeeContractType;
use App\Models\EmployeeRole;
use App\Models\EmployeeType;
use App\Models\Facility;
use App\Models\RateOfPayOption;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use PHPUnit\Framework\Constraint\Count;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $facility = Facility::inRandomOrder()->first();
        $et = EmployeeContractType::inRandomOrder()->first();

        $country = Country::inRandomOrder()
            ->has('States.Cities')
            ->first();

        $state = State::where(['country_id' => $country->id])
            ->whereHas('Cities')
            ->inRandomOrder()->first();

        if($state == null){
            echo "..getting new state".PHP_EOL;
            $state = State::where(['country_id' => $country->id])
                ->has('Cities')
                ->inRandomOrder()->first();
        }

        $city = City::where(['state_id' => $state->id ])
            ->inRandomOrder()->first();


        $employee_role = EmployeeRole::where(['company_id' => 1])->inRandomOrder()->first();
        $approved_by = User::inRandomOrder()->first();
        $rateOfPay = RateOfPayOption::inRandomOrder()->first();
        $company = Company::inRandomOrder()->first();

        return [
            'first_name' => $this->faker->firstName,
            'company_id' => $company->id,
            'last_name' => $this->faker->lastName,
            'payroll_no' => $this->faker->uuid,
            'facility_id' => $facility->id,
            'phone' => $this->faker->phoneNumber,
            'mobile_phone' => $this->faker->phoneNumber,
            'alt_phone' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,
            'email1' => $this->faker->email,
            'email2' => $this->faker->email,
            'employee_type_id' => $et->id,
            'zipcode' => $this->faker->postcode,
            'rate_of_pay' => $this->faker->randomDigitNotZero(),
            'date_of_hire' => $this->faker->date("m/d/Y"),
            'date_of_birth' => $this->faker->date("m/d/Y"),
            'social_security' => $this->faker->uuid,
            'address' => $this->faker->address,
            'title' => $this->faker->name,
            'country_id' => $country->id,
            'state_id' => $state->id,
            'city_id' => $city->id,
            'employee_role_id' => $employee_role->id,
            'rate_of_pay_option_id' => $rateOfPay->id,
            'approved_by' => $approved_by->id,
        ];
    }
}
