<?php

namespace App\Http\Controllers;


use App\Apis\RapidApi;
use App\Services\DataService;
use DateTime;

class ChartController extends Controller
{
    protected function getHistoricalValues(string $symbol, string $startDate,string $endDate)
    {
        $dataService = new DataService(new RapidApi());
        $prices = $dataService->fetchPrices($symbol, new DateTime($startDate), new DateTime($endDate));

        return view('chart', [
            'symbol' => $symbol,
            'start' => $startDate,
            'end' => $endDate,
            'prices' => $prices
        ]);
    }
}
