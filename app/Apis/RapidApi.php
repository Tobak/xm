<?php

namespace App\Apis;

use App\Dto\Price;
use  App\Interfaces\DataProviderInterface;
class RapidApi implements DataProviderInterface
{

    /**
     * @param string $symbol
     * @return Price[]
     */
    public function fetchData(string $symbol)
    {
        // TODO: Implement fetchData() method.
    }
}
