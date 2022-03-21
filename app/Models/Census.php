<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Census extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

}
