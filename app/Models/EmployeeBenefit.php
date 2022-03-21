<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeBenefit extends Model
{
    use HasFactory,SoftDeletes;

    public function Benefit(){
        return $this->hasOne(Benefit::class, 'id', 'benefit_id');
    }
}
