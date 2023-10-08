<?php

namespace App\Services;

use App\Interfaces\DataProviderInterface;
use DateTime;

class DataService
{
    private DataProviderInterface $dataProvider;

    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function fetchPrices(string $symbol, DateTime $start, DateTime $end)
    {
        $prices = $this->dataProvider->fetchData($symbol);
        foreach ($prices as $key => $price){
            if($price->getDate() < $start->getTimestamp() || $price->getDate() > $end->getTimestamp()){
                unset($prices[$key]);
            }
        }

        return array_values($prices);
    }

}
