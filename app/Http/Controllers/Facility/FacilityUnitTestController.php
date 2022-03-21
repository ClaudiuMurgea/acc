<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityUnitTestController extends Controller
{
    public function index(Facility $facility){
        $layout = 'side-menu';
        $facilities = auth()->user()->Company->Facilities;
        return view('facility.common', [
            'menu' => 'facility-menu',
            'facility'    => $facility,
            'facilities'  => $facilities,
            'type'        => 'test',
            /* 'departments' => $facility->Departments */
        ]);
    }

}
