<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name','company_id'];

    public function Company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }


    public function Schedules(){
        return $this->morphMany(ShiftSchedule::class,'type');
    }
}
