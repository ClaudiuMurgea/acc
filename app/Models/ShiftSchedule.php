<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftSchedule extends Model
{
    public $format;
    protected $guarded = [];


    public function __construct(array $attributes = [], $company = null) {
        $this->format = ( $company ?? auth()->user()->Company->am_pm ) ? "h:i A": "H:i";
        parent::__construct($attributes);
    }

    protected function startTime(): Attribute
    {

        return new Attribute(
            get: fn ($value) =>  DateTime::createFromFormat( 'H:i:s', $value)->format( $this->format),
            set:   fn ($value) => DateTime::createFromFormat(  $this->format, $value),
        );
    }

    protected function endTime(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  DateTime::createFromFormat( 'H:i:s', $value)->format( $this->format),
            set:   fn ($value) => DateTime::createFromFormat(  $this->format, $value),
        );
    }


    public function type(){
        return $this->morphTo();
    }
}
