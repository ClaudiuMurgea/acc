<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function states(Request $request){
        $this->validate($request,[
            'country_id' => 'required|exists:countries,id',
        ]);
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);

    }

    public function cities(Request $request){
        $this->validate($request,[
            'state_id' => 'required|exists:states,id',
        ]);
        return response()->json(City::where('state_id', $request->state_id)->get());
    }
}
