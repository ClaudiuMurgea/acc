<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="employee";

    protected $appends = ['fullname'];

    public function getFullnameAttribute(){
        return $this->first_name." ".$this->last_name;
    }

    public function Country(){
        return $this->hasOne(Country::class, 'country_id','id');
    }

    public function State(){
        return $this->hasOne(State::class, 'state_id', 'id');
    }

    public function City(){
        return $this->hasOne(City::class, 'city_id', 'id');
    }

    public function Position(){
        return $this->hasOne(EmployeeRole::class, 'employee_role_id','id');
    }

    public function EmployeeType(){
        return $this->hasOneThrough(EmployeeType::class, CompanyEmployeeTypes::class);
    }

    public function DepartmentEmployee(){
        return $this->hasOne(DepartmentEmployee::class,
            'employee_id','id');
    }

    public function Rateapprovedby(){
        return $this->hasOne(Employee::class, 'approved_by', 'id');
    }

    protected function dateOfBirth(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return DateTime::createFromFormat( 'Y-m-d', $value)->format('m/d/Y');
            },
            set: function ($value) {
                //return DateTime::createFromFormat(  'm/d/Y', $value );
                return DateTime::createFromFormat( 'm/d/Y', $value)->format("Y-m-d");
            },
        );
    }

    protected function dateOfHire(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return DateTime::createFromFormat( 'Y-m-d', $value)->format('m/d/Y');
            },
            set: function ($value) {
                //return DateTime::createFromFormat(  'm/d/Y', $value);
                return DateTime::createFromFormat( 'm/d/Y', $value)->format("Y-m-d");
            }
        );
    }
}
