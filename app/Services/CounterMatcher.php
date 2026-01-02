<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Card;
use App\Models\Effect;

class CounterMatcher
{
    /**
     * Match counter cards against a target card.
     *
     * @param Card $targetCard
     * @param Collection $counterEffects  // Collection of Effect models
     * @return Collection                 // Collection of Card models
     */
    public function matchCounters(Card $targetCard, Collection $counterEffects): Collection
    {
        $matchedCounters = collect();

        // Group target effects by activation_group
        $groups = $targetCard->effects->groupBy('activation_group');

        foreach ($groups as $effectGroup) {
            foreach ($counterEffects as $counterEffect) {
                if ($this->canCounterGroup($counterEffect, $effectGroup)) {
                    $matchedCounters->push($counterEffect->card);
                }
            }
        }

        // Remove duplicates (same handtrap countering multiple groups)
        return $matchedCounters->unique('id')->values();
    }

    /**
     * Check if a counter effect can counter ANY effect in a group.
     */
    protected function canCounterGroup(Effect $counterEffect, Collection $effectGroup): bool
    {
        foreach ($effectGroup as $targetEffect) {
            if ($this->canCounterEffect($counterEffect, $targetEffect)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Core rule: can this counter effect counter this target effect?
     */
    protected function canCounterEffect(Effect $counterEffect, Effect $targetEffect): bool
    {
        // Target type must match
        if ($counterEffect->target_type_id !== $targetEffect->target_type_id) {
            return false;
        }

        // Target location must match
        if ($counterEffect->target_location_id !== $targetEffect->target_location_id) {
            return false;
        }

        // Trigger timing compatibility (simplified v1)
        if ($counterEffect->trigger_id !== $targetEffect->trigger_id) {
            return false;
        }

        // Effect action rules (Ash, etc.)
        if (!$this->matchesEffectAction($counterEffect, $targetEffect)) {
            return false;
        }

        return true;
    }

    /**
     * Effect-action matching rules
     */
    protected function matchesEffectAction(Effect $counterEffect, Effect $targetEffect): bool
    {
        // Example mappings — expand as needed
        $counterMap = [
            'ash_blossom' => [
                'add_from_deck',
                'send_from_deck',
                'special_summon_from_deck',
            ],
            'monster_negate' => [
                'monster_effect',
                'summon',
            ],
        ];

        // If counter has no restriction, allow
        if (!isset($counterMap[$counterEffect->effect_action])) {
            return true;
        }

        return in_array(
            $targetEffect->effect_action,
            $counterMap[$counterEffect->effect_action]
        );
    }
}
