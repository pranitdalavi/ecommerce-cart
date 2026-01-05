<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem;
use App\Jobs\LowStockNotificationJob;
use Illuminate\Support\Facades\DB;

class Cart extends Component
{
    //Update item quantity in cart
    public function updateQuantity($itemId, $qty)
    {
        //Validate quantity
        if ($qty < 1) return;

        DB::transaction(function () use ($itemId, $qty) {
            //Find cart item with product
            $item = CartItem::with('product')->findOrFail($itemId);
            $product = $item->product;

            //Calculate difference
            $difference = $qty - $item->quantity;

            //Adjust stock based on difference
            if ($difference > 0) {
                //Check stock availability
                if ($product->stock_quantity < $difference) {
                    return;
                }

                //Decrease stock
                $product->decrement('stock_quantity', $difference);

                //If stock is low, dispatch notification job
                if ($product->stock_quantity <= 5) {
                    LowStockNotificationJob::dispatch($product);
                }
            }

            //Increase product stock if quantity decreased
            if ($difference < 0) {
                $product->increment('stock_quantity', abs($difference));
            }

            //Update cart item quantity
            $item->update(['quantity' => $qty]);
        });
    }

    //Remove item from cart
    public function removeItem($itemId)
    {
        DB::transaction(function () use ($itemId) {
            $item = CartItem::with('product')->findOrFail($itemId);

            $item->product->increment('stock_quantity', $item->quantity);
            $item->delete();
        });

        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        $cart = auth()->user()->cart;

        return view('livewire.cart', [
            'items' => $cart
                ? $cart->items()->with('product')->get()
                : [],
        ]);
    }
}
