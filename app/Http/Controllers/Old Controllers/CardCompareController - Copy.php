<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardCompareController extends Controller
{
    public function compare()
    {
        return view('compare', [
            'cards' => Card::orderBy('card_name')->get()
        ]);
    }

    public function process(Request $request)
    {
        $selectedCardIds = $request->input('cards', []);

        // compute counters here
        $result = $this->calculateCounters($selectedCardIds);

        session(['summary' => $result]);

        return redirect('/summary');
    }

    public function summary()
    {
        return view('summary', [
            'summary' => session('summary')
        ]);
    }

    protected function calculateCounters(array $cardIds)
    {
        // placeholder — we’ll fill this in
        return [];
    }
}

