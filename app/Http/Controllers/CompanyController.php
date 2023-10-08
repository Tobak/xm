<?php

namespace App\Http\Controllers;

use App\Jobs\SendCompanyReportEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    const CACHE_KEY = 'COMPANY_DATA';
    const CACHE_MINUTES = 120;

    public function showForm()
    {
        $data = $this->getCompanySymbols();
        $symbols = array_column($data, 'Symbol');
        return view('form', ['symbols' => $symbols]);
    }

    public function processForm(Request $request)
    {
        $data = $this->getCompanySymbols();

        $request->validate([
            'company_symbol' => ['required', 'in:' . implode(',', array_column($data, 'Symbol'))],
            'start_date' => 'required|date|before_or_equal:today|before_or_equal:end_date',
            'end_date' => 'required|date|before_or_equal:today|after_or_equal:start_date',
            'email' => 'required|email'
        ]);

        $companyName = null;
        foreach ($data as $datum) {
            if ($datum['Symbol'] == $request->company_symbol) {
                $companyName = $datum['Company Name'];
            }
        }

        // Dispatch the job to send the email in the background
        dispatch(new SendCompanyReportEmail($companyName, $request->start_date, $request->end_date, $request->email));

        return redirect()->route('chart.index', [
            'symbol' => $request->company_symbol,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date
        ])->with('success', 'Form submitted successfully!');
    }

    private function getCompanySymbols()
    {
        $data = cache(self::CACHE_KEY);
        if(!$data) {
            $data = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json')->json();
            cache([self::CACHE_KEY => $data], self::CACHE_MINUTES);
        }
        return $data;
    }
}
