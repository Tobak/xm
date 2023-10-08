<?php

namespace Tests\Unit\Services;

use App\Dto\Price;
use App\Services\DataService;
use App\Interfaces\DataProviderInterface;
use DateTime;
use PHPUnit\Framework\TestCase;

class DataServiceTest extends TestCase
{
    public function testFetchPrices()
    {
        // Mocking DataProviderInterface
        $mockDataProvider = $this->createMock(DataProviderInterface::class);

        // Setting up sample data
        $mockData = [
            (new Price())->setDate((new DateTime('2022-01-02'))->getTimestamp()),
            (new Price())->setDate((new DateTime('2022-01-03'))->getTimestamp()),
        ];


        // Configuring mock method
        $mockDataProvider->method('fetchData')->willReturn($mockData);

        $service = new DataService($mockDataProvider);

        $startDate = new DateTime('2022-01-02');
        $endDate = new DateTime('2022-01-03');

        $result = $service->fetchPrices('AAPL', $startDate, $endDate);

        $this->assertCount(2, $result);
        $this->assertEquals(strtotime('2022-01-02'), $result[0]->getDate());
        $this->assertEquals(strtotime('2022-01-03'), $result[1]->getDate());
    }
}
