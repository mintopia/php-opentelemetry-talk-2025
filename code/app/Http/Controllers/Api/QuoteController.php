<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest;
use App\Http\Resources\QuoteCollectionResource;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class QuoteController extends Controller
{
    public function index(Request $request): JsonResource
    {
        $quotes = Quote::paginate();
        return new QuoteCollectionResource($quotes);
    }

    public function store(QuoteRequest $request): JsonResource
    {
        $quote = new Quote();
        $quote->text = $request->input('text');
        $quote->save();
        return new QuoteResource($quote);
    }

    public function show(Quote $quote): JsonResource
    {
        return new QuoteResource($quote);
    }

    public function update(QuoteRequest $request, Quote $quote): JsonResource
    {
        $quote->text = $request->input('text');
        $quote->save();
        return new QuoteResource($quote);
    }

    public function destroy(Quote $quote): Response
    {
        $quote->delete();
        return response()->noContent();
    }
}
