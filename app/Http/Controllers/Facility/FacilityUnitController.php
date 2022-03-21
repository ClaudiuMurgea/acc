<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityUnitController extends Controller
{
    public function index(Facility $facility){
        $layout = 'side-menu';
        $facilities = auth()->user()->Company->Facilities;
        return view('facility.common', [
            'menu' => 'facility-menu',
            'facility'    => $facility,
            'facilities'  => $facilities,
            'type'        => 'units'
            /* 'departments' => $facility->Departments */
        ]);
    }
}
