<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class HolidayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hol = ['hol1', 'hol2', 'hol3', 'hol4'];

        $date3 = Carbon::createFromFormat('Y-m-d', $this->faker->date())
            ->setYear(2022)
            ->format('m/d/Y');

        return [
            'date' => $date3,
            'label' => $this->faker->randomElement($hol),
            'global' => 1,
            'recurrent' => 1,
        ];
    }
}
