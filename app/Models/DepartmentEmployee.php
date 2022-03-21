<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentEmployee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "department_employee";

    public function Department(){
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
