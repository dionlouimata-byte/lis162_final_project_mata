<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Action;
use App\Models\ActivationLocation;
use App\Models\Card;
use App\Models\TargetLocation;
use App\Models\TargetType;
use App\Models\Trigger;

class Effect extends Model
{
    protected $table = 'effects';
    protected $primaryKey = 'effect_id';
    protected $keyType = 'int';

    public $incrementing = true;
    public $timestamps  = false;

    protected $fillable = [
        'CARDS_card_id',
        'ACTIONS_action_id',
        'ACTIVATION_LOCATION_location_id',
        'TARGET_LOCATION_location_id',
        'TARGET_TYPES_target_type_id',
        'notes',
    ];

    // Relationships

    public function card()
    {
        return $this->belongsTo(
            Card::class,
            'CARDS_card_id',
            'card_id'
        );
    }

    public function action()
    {
        return $this->belongsTo(
            Action::class,
            'ACTIONS_action_id',
            'action_id'
        );
    }

    public function activationLocations()
    {
        return $this->belongsToMany(
            ActivationLocation::class,
            'effect_activation_location',
            'EFFECTS_effect_id',
            'ACTIVATION_LOCATION_location_id',
            'effect_id',
            'location_id'
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

    public function targetLocations()
    {
        return $this->belongsToMany(
            TargetLocation::class,
            'effect_target_location',
            'EFFECTS_effect_id',
            'TARGET_LOCATION_location_id'
        );
    }

    public function targetTypes()
    {
        return $this->belongsToMany(
            TargetType::class,
            'effect_target_type',
            'EFFECTS_effect_id',
            'TARGET_TYPES_target_type_id'
        );
    }

    public function triggerActions()
    {
        return $this->belongsToMany(
            Action::class,
            'effect_trigger',
            'EFFECTS_effect_id',
            'TRIGGERS_action_id',
            'effect_id',
            'action_id'
        );
    }

    public function triggers()
    {
        return $this->belongsToMany(
            Trigger::class,
            'effect_trigger',
            'EFFECTS_effect_id',
            'TRIGGERS_action_id'
        );
    }

    // Matching Helpers (Abandoned but kept in, in case I use it for later lole)

    // Trigger match:
    // handtrap trigger action == selected effect action

    public function matchesTrigger(int $selectedActionId): bool
    {
        return $this->triggers->contains(function ($trigger) use ($selectedActionId) {
            return $trigger->TRIGGERS_action_id === -1
                || $trigger->TRIGGERS_action_id === $selectedActionId;
        });
    }

    // TargetLocation match:
    // handtrap target location == selected activation location

    public function matchesTargetLocation(?int $activationLocationId): bool
    {
        if ($activationLocationId === null) {
            return true;
        }

        return $this->targetLocations->contains(function ($target) use ($activationLocationId) {
            return $target->TARGET_LOCATION_location_id === -1
                || $target->TARGET_LOCATION_location_id === $activationLocationId;
        });
    }

    // TargetType match:
    //handtrap target type == selected card category

    public function matchesTargetTypes(?int $cardCategoryId): bool
    {
        if ($cardCategoryId === null) {
            return true;
        }

        return $this->targetTypes->contains(function ($targetType) use ($cardCategoryId) {
            return $targetType->TARGET_TYPES_target_type_id === -1
                || $targetType->TARGET_TYPES_target_type_id === $cardCategoryId;
        });
    }
}
