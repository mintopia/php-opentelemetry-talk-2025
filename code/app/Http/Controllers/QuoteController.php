<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Support\Facades\Log;

class QuoteController extends Controller
{
    public function home()
    {
        $quote = Quote::inRandomOrder()->first();
        Log::debug("Retrieving random quote with ID: {$quote->id}");
        return view('quote', [
            'quote' => $quote,
        ]);
    }

    public function error()
    {
        throw new \Exception('This is an unexpected error');
    }
}
