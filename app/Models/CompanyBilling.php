<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBilling extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function City(){
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function State(){
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function Country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
