<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Effect;

class TargetType extends Model
{
    protected $table = 'target_types';
    protected $primaryKey = 'target_type_id';
    public $timestamps = false;
    protected $fillable = ['target_name',];

    // One target type can be referenced by many effects
    public function effects()
    {
        return $this->hasMany(
            Effect::class,
            'TARGET_TYPES_target_type_id',
            'target_type_id'
        );
    }
}
