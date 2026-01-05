<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailySalesReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sales;

    /**
     * Create a new message instance.
     */
    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    public function build()
    {
        return $this
            ->subject('Daily Sales Report')
            ->markdown('emails.daily_sales_report');
    }
}
