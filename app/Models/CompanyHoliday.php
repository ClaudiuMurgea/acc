<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyHoliday extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','holiday_id'];

    public function Company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
