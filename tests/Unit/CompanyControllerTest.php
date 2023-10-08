<?php

namespace Tests\Unit;

use App\Http\Controllers\CompanyController;
use App\Jobs\SendCompanyReportEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{

    public function testShowForm()
    {
        $controller = new CompanyController();
        $view = $controller->showForm();

        $this->assertEquals('form', $view->getName());
        $this->assertContains('AAPL', $view->getData()['symbols']);
    }

    public function testProcessForm()
    {
        Queue::fake();

        $controller = new CompanyController();

        $request = new Request([
            'company_symbol' => 'AAPL',
            'start_date' => '2022-01-01',
            'end_date' => '2022-01-02',
            'email' => 'test@example.com'
        ]);

        $response = $controller->processForm($request);
        $url = route('chart.index', ['symbol' => 'AAPL', 'startDate' => '2022-01-01', 'endDate' => '2022-01-02']);

        $this->assertEquals($url, $response->getTargetUrl());

        Queue::assertPushed(SendCompanyReportEmail::class);
    }

}
