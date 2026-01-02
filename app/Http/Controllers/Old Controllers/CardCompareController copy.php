<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardCompareController extends Controller
{
    public function compare(Request $request)
    {
        $cards = Card::all();

        $selectedCards = Card::whereIn(
            'card_id',
            $request->input('cards', [])
        )->get();

        return view('compare', compact('cards', 'selectedCards'));
    }


    public function process(Request $request)
    {
        $selectedCardIds = $request->input('cards', []);

        // compute counters here
        $result = $this->calculateCounters($selectedCardIds);

        session(['summary' => $result]);

        return redirect('/summary');
    }

public function summary(Request $request)
    {
        $selectedCardIds = $request->input('cards', []);

        return view('summary', [
            'selectedCardIds' => $selectedCardIds
        ]);
    }

    
    protected function calculateCounters(array $cardIds)
    {
        // placeholder — we’ll fill this in
        return [];
    }
}

