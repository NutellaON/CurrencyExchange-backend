<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Models\ExchangeRate;

class RatesService{

    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.anyapi.api_key');
        $this->apiUrl = 'https://anyapi.io/api/v1/exchange/rates';
    }

    public function fetchExchangeRatesAndInsert()
    {
        $client = new Client();

        $response = $client->get($this->apiUrl . '?base=EUR&apiKey=' . $this->apiKey);

        $responseData = json_decode($response->getBody(), true);

        ExchangeRate::create([
            'rate_eur' => $responseData['rates']['EUR'],
            'rate_usd' => $responseData['rates']['USD'],
            'rate_gbp' => $responseData['rates']['GBP'],
            'rate_aud' => $responseData['rates']['AUD'],
            'date' => now(),
        ]);
    }
}