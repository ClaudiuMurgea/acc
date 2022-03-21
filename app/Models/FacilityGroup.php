<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityGroup extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function Roles(){
        return $this->hasMany(FacilityGroupRoles::class,'facility_group_id','id');
    }


}
