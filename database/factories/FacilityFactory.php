<?php

namespace Database\Factories;

use App\Models\Timezone;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tz = Timezone::where(['abbr' => 'GMT' ])->first();
        return [
            'company_id' => 1,
            'name' => 'facility '. $this->faker->name,
            'time_zone_id' => $tz->id,
            'license_no' => $this->faker->uuid,
            'default_shift_type' => 1,
            'registration_step' => 1,
        ];
    }
}
