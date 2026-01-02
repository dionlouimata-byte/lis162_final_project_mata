<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SummaryController extends Controller
{
    /**
     * Store selected card IDs into session
     */
    public function summary(Request $request)
    {
        session(['selected_cards' => $request->input('cards', [])]);

        return redirect()->route('summary.show');
    }

    /**
     * Display the summary page
     */
    public function showSummary()
    {
        $cardIds = session('selected_cards', []);

        return view('summary', compact('cardIds'));
    }
}
