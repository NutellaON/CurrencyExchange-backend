<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExchangeRate;

class ExchangeRateController extends Controller
{
    public function index(Request $request)
    {
        $exchangeRates = ExchangeRate::get([
            "rate_eur", "rate_usd", "rate_gbp", "rate_aud","date"
        ]);

        return response()->json([
            'exchange_rates' => $exchangeRates,
        ]);
    }
}
