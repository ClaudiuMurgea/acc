<?php

namespace Database\Seeders;

use App\Models\Benefit;
use Illuminate\Database\Seeder;

class BenefitsSeeder extends Seeder
{
    public function run(){
        $benefitsList = [
            1 => 'Vacation Days',
            2 => 'Sick Days',
            3 => 'Holidays',
            4 => 'Personal',
            5 => 'PTO',
            6 => 'Frills'
        ];
        foreach ($benefitsList as $benefit){
            $bf = new Benefit();
            $bf->name = $benefit;
            $bf->save();
        }
    }
}
