<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function dashboard(Facility $facility){


        if (!auth()->user()->Company ||  auth()->user()->registration_step <= config('app.register_steps')){
            return redirect(route('company.steps'));
        }

            $facilities = auth()->user()->Company->Facilities;
            $type = 'dashboard';

          return view('facility.common', [
              'menu' => 'facility-menu',
              'facility'    => $facility,
              'facilities'  => $facilities,
              'type'         => $type
             /* 'departments' => $facility->Departments*/
          ]);
    }
}
