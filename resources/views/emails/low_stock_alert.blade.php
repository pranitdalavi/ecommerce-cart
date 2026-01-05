@component('mail::message')
# Low Stock Alert 🚨

The following product is running low on stock:

@component('mail::panel')
**Product:** {{ $product->name }}  
**Remaining Stock:** {{ $product->stock_quantity }}
@endcomponent

Please consider restocking this product.

Thanks,  
Sales Team
@endcomponent