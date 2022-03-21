<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'id', 'name', 'status'
    ];

    protected $appends = ['prettyphone'];

    public function getPrettyphoneAttribute(){
        return $this->name." ( +".$this->country_phone_code." )";
    }

    public function States(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function Cities(): HasManyThrough
    {
        return $this->hasManyThrough(City::class, State::class);
    }
}
