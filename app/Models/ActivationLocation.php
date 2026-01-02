<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Effect;

class ActivationLocation extends Model
{
    protected $table = 'activation_location';
    protected $primaryKey = 'location_id';
    public $timestamps = false;
    protected $fillable = ['location_name',];

    // Relationships


    // Effects that activate from this location.
    public function effects()
    {
        return $this->hasMany(
            Effect::class,
            'ACTIVATION_LOCATION_location_id',
            'location_id'
        );
    }
}
