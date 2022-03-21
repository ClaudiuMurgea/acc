<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    public function Admin(){
        return $this->belongsTo(User::class,'id','admin_id');
    }

    public function Facilities(){
        return $this->hasMany(Facility::class,'company_id','id');
    }

    public function BillingDetails(){
        return $this->hasOne(Company::class,'id','company_id');
    }

    public function Holidays(){
        return $this->morphMany(Holiday::class,'entity');
    }

    public function SubscribedHolidays(){
        return $this->hasMany(CompanyHoliday::class,'company_id','id');
    }

    public function SubscribedEmployeeTypes(){
        return $this->hasMany(CompanyEmployeeTypes::class,'company_id','id');
    }

    public function ShiftGroups(){
        return $this->hasMany(ShiftGroup::class,'company_id','id');
    }

    public function Censuses(){
        return $this->hasMany(Census::class,'company_id','id');
    }

    public function EmployeeRoles(){
        return $this->hasMany(EmployeeRole::class,'company_id','id');
    }

    public function Departments(){
        return $this->hasMany(Department::class, 'company_id', 'id');
    }
}
