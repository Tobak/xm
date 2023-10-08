<?php

namespace Tests\Unit;

use App\Http\Controllers\ChartController;
use App\Apis\RapidApi;
use App\Services\DataService;
use App\Dto\Price;
use DateTime;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class ChartControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function test_getHistoricalValues_returns_expected_view_with_data()
    {
        $rapidApiMock = Mockery::mock(RapidApi::class);
        $dataServiceMock = Mockery::mock(DataService::class, [$rapidApiMock]);

        $prices = [
            (new Price())
                ->setDate((new DateTime('2022-01-01'))->getTimestamp())
                ->setOpen(100)
                ->setClose(105),
            (new Price())
                ->setDate((new DateTime('2022-01-02'))->getTimestamp())
                ->setOpen(101)
                ->setClose(104),
        ];

        $dataServiceMock->shouldReceive('fetchPrices')
            ->once()
            ->andReturn($prices);

        $controller = new ChartController($dataServiceMock);
        $reflection = new \ReflectionClass($controller);
        $property = $reflection->getProperty('dataService');
        $property->setAccessible(true);
        $property->setValue($controller, $dataServiceMock);

        $response = $controller->getHistoricalValues('AAPL', '2022-01-01', '2022-01-02');

        $this->assertInstanceOf(View::class, $response);
        $data = $response->getData();
        $this->assertEquals('AAPL', $data['symbol']);
        $this->assertEquals([
            [
                'date' => '2022-01-01',
                'open' => 100,
                'close' => 105,
            ],
            [
                'date' => '2022-01-02',
                'open' => 101,
                'close' => 104,
            ],
        ], $data['chartData']);
        $this->assertEquals($prices, $data['prices']);
    }
}
