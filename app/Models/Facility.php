<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;


    protected $fillable = ['company_id','name','time_zone_id','license_no','registration_step','census_id','default_shift_type'];


    public function Census(){
        return $this->hasOne(Census::class,'id','census_id');
    }

    public function ShiftGroups(){
        return $this->hasMany(FacilityShiftGroup::class,'facility_id','id');
    }

    public function Company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function Groups(){
        return $this->hasMany(FacilityGroup::class,'facility_id','id');
    }

    public function Units(){
        return $this->hasMany(FacilityUnit::class,'facility_id','id');
    }

    public function Departments(){
        return $this->hasMany(Department::class,'facility_id','id');
    }

}
