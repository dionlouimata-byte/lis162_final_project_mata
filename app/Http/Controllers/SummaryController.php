<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Effect;

class SummaryController extends Controller
{

    // Stores selected card IDs into session from the /compare page

    public function summary(Request $request)
    {
        session(['selected_cards' => $request->input('cards', [])]);

        return redirect()->route('summary.show');
    }


    // Display the summary page
    public function showSummary()
    {
        $cardIds = session('selected_cards', []);

        // 1. Selected Engine
        $selectedCards = Card::with([
            'category',
            'effects.action', 
            'effects.activationLocations' 
        ])->whereIn('card_id', $cardIds)->get();

        // 2. Handtrap Library
        $counters = Card::where('handtrap', 1)
            ->with([
                'category', 
                'effects.triggerActions',
                'effects.targetLocations',
                'effects.targetTypes'
            ])
            ->orderBy('card_name', 'asc')
            ->get();

        return view('summary', compact('selectedCards', 'counters'));
    }
}