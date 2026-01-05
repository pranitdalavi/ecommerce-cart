<?php

namespace App\Jobs;

use App\Mail\DailySalesReportMail;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class DailySalesReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $today = Carbon::today();

        $sales = CartItem::whereDate('created_at', $today)
            ->with('product')
            ->get()
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'product_name' => $items->first()->product->name,
                    'quantity' => $items->sum('quantity'),
                ];
            });
            
        if ($sales->isEmpty()) {
            return;
        }

        $admin = User::where('is_admin', true)->first();

        if (!$admin) {
            return;
        }

        Mail::to($admin->email)
            ->send(new DailySalesReportMail($sales));
    }
}