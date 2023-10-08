<?php

namespace App\Interfaces;

use App\Dto\Price;

interface  DataProviderInterface {

    /**
     * @param string $symbol
     * @return Price[]
     */
    public function fetchData(string $symbol);
}
