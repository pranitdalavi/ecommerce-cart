<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\User;
use App\Mail\LowStockAlertMail;

class LowStockNotificationJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Product $product)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $admin = User::where('is_admin', true)->first();

        if (!$admin) {
            return;
        }

        Mail::to($admin->email)
            ->send(new LowStockAlertMail($this->product));
    }
}
