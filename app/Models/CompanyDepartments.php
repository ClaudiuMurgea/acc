<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyDepartments extends Model
{
    use HasFactory, SoftDeletes;

    public function Company(){
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function Department(){
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
