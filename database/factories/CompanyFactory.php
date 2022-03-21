<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_id' => 1,
            'name' => 'test company',
            'number_of_locations' => 2,
            'corporate_address' => 'anywhere',
            'corporate_phone_number' => '0769636898',
            'ein' => '11 1111',
            'week_start' => 1,
            'am_pm' => 0
        ];
    }
}
