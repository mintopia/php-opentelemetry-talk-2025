<?php

namespace App\Http\Controllers;

use App\Models\Quote;

class QuoteController extends Controller
{
    public function home()
    {
        $quote = Quote::inRandomOrder()->first();
        return view('quote', [
            'quote' => $quote,
        ]);
    }
}
