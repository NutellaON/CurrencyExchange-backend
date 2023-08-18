<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExchangeRate;

class ExchangeRateController extends Controller
{
    public function show(Request $request, $currency)
    {
        $selectedCurrency = 'rate_' . $currency;
        $orderBy = $request->query('orderBy', 'desc');
        $perPage = $request->input('perPage', 10);
        $latestDate = ExchangeRate::max('date');
        $maxRate = ExchangeRate::max($selectedCurrency);
        $minRate = ExchangeRate::min($selectedCurrency);
        $averageRate = ExchangeRate::average($selectedCurrency);

        if ($orderBy !== 'asc' && $orderBy !== 'desc') {
            $orderBy = 'desc';
        }

        $exchangeRates = ExchangeRate::orderBy('date', $orderBy)
        ->paginate($perPage, ['date', $selectedCurrency]);

        return response()->json([
            'latest_date' => $latestDate,
            'exchange_rates' => $exchangeRates,
            'maxRate' => $maxRate,
            'minRate' => $minRate,
            'averageRate' => $averageRate
        ]);
    }
}
