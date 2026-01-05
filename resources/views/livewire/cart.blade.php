<div class="cart-container">
    
    <!-- Table Header -->
    <div class="flex justify-between font-semibold mb-2">
        <span class="w-1/3">Product Name</span>
        <span class="w-1/3 text-center">Quantity</span>
        <span class="w-1/3 text-center">Action</span>
    </div>

    <!-- Cart Items -->
    @foreach ($items as $item)
        <div class="flex justify-between mb-2">
            <span class="w-1/3 flex flex-col">
                <strong>{{ $item->product->name }}</strong>
                
                <div wire:poll.5s> @if($item->product->stock_quantity <= 0)
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full w-max">
                            Out of Stock
                        </span>
                    @elseif($item->product->stock_quantity <= 5)
                        <span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded-full w-max">
                            Only {{ $item->product->stock_quantity }} left!
                        </span>
                    @else
                        <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full w-max">
                            In Stock
                        </span>
                    @endif
                </div>
            </span>

            
            <div class="w-3/3">
                <input type="number"
                    min="1"
                    max="{{ $item->product->stock_quantity + $item->quantity }}"
                    wire:change="updateQuantity({{ $item->id }}, $event.target.value)"
                    value="{{ $item->quantity }}"
                    @disabled($item->product->stock_quantity <= 0 && $item->quantity == 0)
                    class="w-16 border text-center {{ $item->product->stock_quantity <= 0 ? 'bg-gray-100' : '' }}">
            </div>

            <div class="w-1/3 text-center">
                <button
                    wire:click="removeItem({{ $item->id }})"
                    class="text-red-500">
                    Remove
                </button>
            </div>
        </div>
    @endforeach
</div>