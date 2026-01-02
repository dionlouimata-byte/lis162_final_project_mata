<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Action;
use App\Models\Effect;
use App\Models\TargetLocation;
use App\Models\TargetType;


class Trigger extends Model
{
    protected $table = 'triggers';
    protected $primaryKey = 'trigger_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'ACTIONS_action_id',
    ];

    // Relationships

    // Trigger listens for one action.

    public function action()
    {
        return $this->belongsTo(
            Action::class,
            'ACTIONS_action_id',
            'action_id'
        );
    }

    // Effects that can respond to this trigger.

    public function effects()
    {
        return $this->belongsToMany(
            Effect::class,
            'effect_trigger',
            'TRIGGERS_action_id',
            'EFFECTS_effect_id'
        );
    }

    public function targetLocation()
    {
        return $this->belongsTo(
            TargetLocation::class, 
            'TARGET_LOCATION_location_id', 
            'location_id'
        );
    }

    public function targetType()
    {
        return $this->belongsTo(
            TargetType::class, 
        'TARGET_TYPES_target_type_id', 
        'target_type_id'
        );
    }

}
