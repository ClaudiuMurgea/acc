<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeCurrentYear($query,$year = null)
    {
        if (!$year){
            $year = Carbon::now()->format('Y');
        }
        return $query->whereYear('date', '=', $year);
    }

    public function getDateAttribute($value)
    {
        return !is_null($value) ? Carbon::parse($value)->format(config('app.date_format_long')) : null;
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = !is_null($value) ? Carbon::createFromFormat(config('app.date_format_long'), $value)->format('Y-m-d') : null;
    }
    public function entity(){
        return $this->morphTo();
    }
}
