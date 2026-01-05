<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\DailySalesReportJob;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule daily sales report job at 11:59 PM
app(Schedule::class)
    ->job(new DailySalesReportJob)
    ->dailyAt('11:59');