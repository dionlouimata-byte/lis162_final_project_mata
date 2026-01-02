<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Effect;
use App\Models\Trigger;

class Action extends Model
{
    protected $table = 'actions';
    protected $primaryKey = 'action_id';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['action_name',];


    //Relationships:

    // Effects that perform this action.
    public function effects()
    {
        return $this->hasMany(
            Effect::class,
            'ACTIONS_action_id',
            'action_id'
        );
    }

    // Triggers that listen for this action.
    public function triggers()
    {
        return $this->hasMany(
            Trigger::class,
            'ACTIONS_action_id',
            'action_id'
        );
    }
}
