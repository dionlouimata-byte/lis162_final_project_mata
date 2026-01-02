<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActivationLocation;
use App\Models\Card;
use App\Models\CardCategory;
use App\Models\Effect;
use App\Models\TargetLocation;
use App\Models\TargetType;
use App\Models\Trigger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{

     // Index

    public function index()
    {
        $cards = Card::with(['effects.action', 'category'])->get();

        return view('cards', [
            'cards'               => $cards,
            'actions'             => Action::all(),
            'triggers'            => Trigger::all(),
            'activationLocations' => ActivationLocation::all(),
            'targetLocations'     => TargetLocation::all(),
            'targetTypes'         => TargetType::all(),
            'categories'          => CardCategory::all(),
        ]);
    }

    // Store
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            // 1. Create Card
            $card = Card::create([
                'card_name'             => $request->card_name,
                'threat_level'          => $request->threat_level,
                'handtrap'              => $request->has('handtrap') ? 1 : 0,
                'CATEGORY_category_id'  => $request->card_category_id,
            ]);

            // 2. Create Effects
            if ($request->has('effects')) {
                foreach ($request->effects as $effectData) {

                    $effect = Effect::create([
                        'CARDS_card_id'      => $card->card_id,
                        'ACTIONS_action_id'  => $effectData['action_id'],
                        'notes'              => $effectData['notes'] ?? null,
                    ]);

                    // Sync junction tables
                    $effect->activationLocations()->sync(
                        (array) ($effectData['activation_location_id'] ?? [])
                    );

                    $effect->targetLocations()->sync(
                        (array) ($effectData['target_location_id'] ?? [])
                    );

                    $effect->targetTypes()->sync(
                        (array) ($effectData['target_type_id'] ?? [])
                    );

                    if (!empty($effectData['trigger_id'])) {
                        $effect->triggers()->sync(
                            (array) $effectData['trigger_id']
                        );
                    }
                }
            }
        });

        return redirect()
            ->route('cards.index')
            ->with('success', 'Card saved successfully!');
    }

    // Edit
    public function edit($card_id)
    {
        $card = Card::with('effects')->findOrFail($card_id);

        return view('cards', [
            'card'                => $card,
            'cards'               => Card::with('effects')->get(),
            'categories'          => CardCategory::all(),
            'actions'             => Action::all(),
            'activationLocations' => ActivationLocation::all(),
            'targetLocations'     => TargetLocation::all(),
            'targetTypes'         => TargetType::all(),
            'triggers'            => Trigger::all(),
        ]);
    }


    // Update
    public function update(Request $request, $card_id)
    {
        $card = Card::findOrFail($card_id);

        $card->update([
            'card_name'        => $request->card_name,
            'CATEGORY_category_id' => $request->card_category_id,
            'handtrap'         => $request->handtrap,
        ]);

        return redirect()
            ->route('cards.index')
            ->with('success', 'Card updated successfully.');
    }

    // Destroy
    public function destroy(Card $card)
    {
        $card->effects()->delete();
        $card->delete();

        return redirect()
            ->route('cards.index')
            ->with('success', 'Card deleted.');
    }
}
