<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'id', 'state_id', 'name', 'status'
    ];

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ucwords($value),
        );
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
