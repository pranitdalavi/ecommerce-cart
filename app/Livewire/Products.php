<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Jobs\LowStockNotificationJob;

class Products extends Component
{
    //Add product to cart
    public function addToCart($productId)
    {
        //Find product
        $product = Product::findOrFail($productId);

        //Out of stock
        if ($product->stock_quantity <= 0) {
            return;
        }

        //Get or create cart for authenticated user
        $cart = auth()->user()->cart ?? Cart::create([
            'user_id' => auth()->id()
        ]);

        //Add or update cart item
        $item = CartItem::firstOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $productId],
            ['quantity' => 0]
        );

        $item->increment('quantity');

        //Decrease product stock immediately after item is added to cart
        $product->decrement('stock_quantity', 1);

        //If stock is low, dispatch notification job
        if ($product->stock_quantity <= 5) {
            LowStockNotificationJob::dispatch($product);
        }
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => Product::all()
        ]);
    }
}