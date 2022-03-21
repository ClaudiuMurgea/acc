<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ucwords($value),
        );
    }
    public function Cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function Country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
