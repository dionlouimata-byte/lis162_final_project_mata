<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetLocation extends Model
{
    protected $table = 'TARGET_LOCATION';
    protected $primaryKey = 'location_id';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'location_name',
    ];

    // Important: Wildcard target location (ANY).

    public const ANY = -1;

    // Relationships


    // Effects that can target this location.

    public function effects()
    {
        return $this->hasMany(
            Effect::class,
            'TARGET_LOCATION_location_id',
            'location_id'
        );
    }

    public function triggers()
    {
        return $this->hasMany(
            Trigger::class, 
            'TARGET_LOCATION_location_id', 
            'location_id'
        );
    }


    // Helper Logic (Abandoned, might use again later, maybe.)


    // Determines if this target location matches an activation location, accounting for ANY wildcard.

    public function matches(int $activationLocationId): bool
    {
        return $this->location_id === self::ANY
            || $this->location_id === $activationLocationId;
    }
}
