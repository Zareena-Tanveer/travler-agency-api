<?php

namespace App\Models;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['travel_id','name','starting_date','ending_date','price'];

    /**
     * Tour belongs to Travelers
     */
    function traveler() : BelongsTo {
        return $this->belongsTo(Travel::class);
    }

    /**
     * Attribute Mutator
     */
    function price() : Attribute {
        return Attribute::make(
            get: fn($value) => $value/100,
            set: fn($value) => $value*100
        );
    }
}
