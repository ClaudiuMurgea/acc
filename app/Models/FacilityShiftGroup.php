<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityShiftGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Schedules(){
        return $this->morphMany(ShiftSchedule::class,'type');
    }

    public function Facility(){
        return $this->belongsTo(Facility::class,'facility_id','id');
    }
}
