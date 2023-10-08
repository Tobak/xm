<?php

namespace App\Http\Controllers;


use App\Apis\RapidApi;
use App\Dto\Price;
use App\Services\DataService;
use DateTime;

class ChartController extends Controller
{
    protected $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }
    public function getHistoricalValues(string $symbol, string $startDate,string $endDate)
    {
        $prices = $this->dataService->fetchPrices($symbol, new DateTime($startDate), new DateTime($endDate));

        $chartData = array_map(fn($x)=>$this->mapData($x),$prices);
        return view('chart', [
            'symbol' => $symbol,
            'chartData' => $chartData,
            'start' => $startDate,
            'end' => $endDate,
            'prices' => $prices
        ]);
    }

    private function mapData(Price $price) : array
    {
        return [
            'date'  => date('Y-m-d',$price->getDate()),
            'open'  => $price->getOpen(),
            'close' => $price->getClose()
        ];
    }
}
