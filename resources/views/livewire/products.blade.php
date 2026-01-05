<div class="grid grid-cols-3 gap-4">
    @foreach ($products as $product)
        <div class="border p-4 rounded">
            <h2 class="font-bold">{{ $product->name }}</h2>
            <p>${{ $product->price }}</p>
            <p>Stock: {{ $product->stock_quantity }}</p>

            <button
                wire:click="addToCart({{ $product->id }})"
                class="bg-blue-500 text-white px-4 py-2 mt-2 rounded"
            >
                Add to Cart
            </button>
        </div>
    @endforeach
</div>