<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityGroupRoles extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function EmployeeRole(){
        return $this->belongsTo(EmployeeRole::class,'employee_role_id','id');
    }
}
