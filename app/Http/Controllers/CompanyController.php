<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    public function showForm()
    {
        $symbols = $this->getCompanySymbols();
        return view('form', ['symbols' => $symbols]);
    }

    public function processForm(Request $request)
    {
        $symbols = $this->getCompanySymbols();

        $request->validate([
            'company_symbol' => ['required', 'in:' . implode(',', $symbols)],
            'start_date' => 'required|date|before_or_equal:today|before_or_equal:end_date',
            'end_date' => 'required|date|before_or_equal:today|after_or_equal:start_date',
            'email' => 'required|email'
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    private function getCompanySymbols()
    {
        // Ideally, cache this for performance
        $data = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json')->json();
        return array_column($data, 'Symbol');
    }
}
