<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacilityUnit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function Group(){
        return $this->hasOne(FacilityGroup::class,'id','facility_group_id');
    }


}
