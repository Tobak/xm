<?php

namespace App\Jobs;

use App\Mail\CompanyReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCompanyReportEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $companyName;
    protected string $startDate;
    protected string $endDate;
    protected string $email;

    /**
     * Create a new job instance.
     */
    public function __construct(string $companyName, string $startDate, string $endDate, string $email)
    {
        $this->companyName = $companyName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->email = $email;
    }

    public function handle()
    {
        $subject = 'Company’s Name = ' . $this->companyName;
        $body = 'From ' . $this->startDate . ' to ' . $this->endDate;

        // Send the email using the Mail facade
        Mail::to($this->email)->send(new CompanyReportMail($subject, $body));
    }
}
