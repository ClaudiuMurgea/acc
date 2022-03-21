<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyBillingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $compid = Company::all()->first->id;

        $country = Country::inRandomOrder()->has('States')->first();

        $state = State::where(['country_id' => $country->id])
            ->has('Cities')
            ->inRandomOrder()->first();

        if($state == null ) {
            $country = Country::inRandomOrder()->has('States')->first();
            $state = State::where(['country_id' => $country->id])
                ->has('Cities')
                ->inRandomOrder()->first();
        }

        $city = City::where(['state_id' => $state->id ])
            ->inRandomOrder()->first();

        return [
            'company_id' => $compid,
            'billing_name' => 'test billing',
            'billing_phone_number' => '0769636899',
            'billing_address' => 'anywhere',
            'billing_address2' => '',
            'zip_code' => $this->faker->postcode,
            'country_id' => $country->id,
            'state_id' => $state->id,
            'city_id' => $city->id,
        ];
    }
}
