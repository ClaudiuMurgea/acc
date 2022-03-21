<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Country;
use App\Models\ShiftGroup;
use App\Models\ShiftSchedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class ShiftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::inRandomOrder()->first();
        $sg = new ShiftGroup();
        $sg->company_id = $company->id;
        $sg->name = "Day Shift";
        $sg->save();

        $shiftS = new ShiftSchedule([], $company);
        $shiftS->type_type = 'App\Models\ShiftGroup';
        $shiftS->format = "h:i";
        $shiftS->type_id = 1;
        $shiftS->start_time = "01:00";
        $shiftS->end_time = "08:00";
        $shiftS->sun = 0;
        $shiftS->mon = 1;
        $shiftS->tue = 1;
        $shiftS->wed = 1;
        $shiftS->thu = 1;
        $shiftS->fri = 1;
        $shiftS->sat = 0;

        $shiftS->save();
    }
}
