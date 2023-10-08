<?php

namespace App\Interfaces;

use App\Dto\Price;
use Exception;

interface  DataProviderInterface {

    /**
     * @param string $symbol
     * @return Price[]
     * @throws Exception
     */
    public function fetchData(string $symbol);
}
