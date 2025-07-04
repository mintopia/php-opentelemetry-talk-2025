<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class QuoteController extends Controller
{
    public function home(): View
    {
        $quote = Quote::inRandomOrder()->first();
        if ($quote === null) {
            abort(404);
        }
        Log::debug("Retrieving random quote with ID: {$quote->id}");
        return view('quote', [
            'quote' => $quote,
        ]);
    }

    public function error(): void
    {
        throw new \Exception('This is an unexpected error');
    }
}
