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

    //selected cards get stored in the session to be used by the /summary page.
    public function process(Request $request)
    {
        $selectedCardIds = $request->input('cards', []);

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
        return [];
    }
}

