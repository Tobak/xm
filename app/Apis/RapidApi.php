<?php

namespace App\Apis;

use App\Dto\Price;
use App\Interfaces\DataProviderInterface;
use Exception;
use Illuminate\Support\Facades\Http;

class RapidApi implements DataProviderInterface
{
    private const ENDPOINT = "https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data/";
    private const DELAY = 2;
    private const MAX_TRIES = 5;

    /**
     * @param string $symbol
     * @return Price[]
     * @throws Exception
     */
    public function fetchData(string $symbol)
    {
        $try = 0;

        while($try++ < self::MAX_TRIES){
            try{
                $data = $this->performRequest($symbol);
            } catch (Exception $e) {
                if($try >= self::MAX_TRIES){
                    throw $e;
                }
                sleep(self::DELAY);
                continue;
            }
        }
        return array_map(fn($x)=>$this->datumToPrice($x),$data);
    }

    /**
     * @param array $datum
     * @return Price
     */
    private function datumToPrice($datum)
    {
        return (new Price())
            ->setDate($datum['date'])
            ->setOpen( array_key_exists('open',$datum) ?$datum['open']: null)
            ->setClose(array_key_exists('close',$datum) ?$datum['close']: null)
            ->setHigh(array_key_exists('high',$datum) ?$datum['high']: null)
            ->setLow(array_key_exists('low',$datum) ?$datum['low']: null)
            ->setVolume(array_key_exists('volume',$datum) ?$datum['volume']: null);
    }

    /**
     * @param string $symbol
     * @return mixed
     * @throws Exception
     */
    private function performRequest(string $symbol)
    {
        $headers = [
            'X-RapidAPI-Key' => $_ENV['RAPID_API_KEY'],
            'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com',
        ];

        $params = [
            'symbol' => $symbol
        ];

        $response = Http::withHeaders($headers)->get(self::ENDPOINT, $params);

        if ($response->successful()) {
            return $response->json()['prices'];
        }

        throw new Exception("Could not fetch data" );
    }
}
