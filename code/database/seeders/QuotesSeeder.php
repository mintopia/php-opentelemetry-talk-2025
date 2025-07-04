<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuotesSeeder extends Seeder
{
    // Our example quotes to initially seed it with, some Pratchett and other quotes.
    protected const QUOTES = [
        "The trouble with having an open mind, of course, is that people will insist on coming along and trying to put things in it.",
        "It is said that your life flashes before your eyes just before you die. That is true, it's called Life.",
        "Give a man a fire and he's warm for a day, but set fire to him and he's warm for the rest of his life.",
        "In ancient times cats were worshipped as gods; they have not forgotten this.",
        "I understand and agree",
        "It’s oat milk. And this is Weetabix. I won’t pour oats onto oats.",
        "It's one banana, Michael. What could it cost, $10?",
        "So say we all!",
        "The greater good",
        "Reticulating splines",
    ];

    public function run(): void
    {
        foreach (self::QUOTES as $quote) {
            if (Quote::whereText($quote)->count() === 0) {
                $q = new Quote();
                $q->text = $quote;
                $q->save();
            }
        }
    }
}
