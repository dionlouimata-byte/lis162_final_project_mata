<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CardCompareController;
use App\Http\Controllers\SummaryController;

// Home

Route::get('/', fn () => view('home'));

// Cards

Route::resource('cards', CardController::class);

Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
Route::delete('/cards/{card}', [CardController::class, 'destroy'])->name('cards.destroy');

Route::delete('/effects/{effect}', [CardController::class, 'destroyEffect'])
    ->name('effects.destroy');

// Card Comparison - Card Selection for Summary

Route::get('/compare', [CardCompareController::class, 'compare'])
    ->name('compare');

Route::post('/summary', [CardCompareController::class, 'summary'])
    ->name('summary');

Route::get('/summary', function () {
    return redirect('/compare');
});

// Summary

Route::post('/summary', [SummaryController::class, 'summary'])
    ->name('summary.store');

Route::get('/summary', [SummaryController::class, 'showSummary'])
    ->name('summary.show');
