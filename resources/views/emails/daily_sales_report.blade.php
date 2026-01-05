@component('mail::message')
# 📊 Daily Sales Report

Here is a summary of the products sold **today**.

<table style="width:100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="text-align:left; padding: 8px; border-bottom: 2px solid #ddd;">Product Name</th>
            <th style="text-align:right; padding: 8px; border-bottom: 2px solid #ddd;">Quantity Sold</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $sale['product_name'] }}</td>
                <td style="padding: 8px; text-align:right; border-bottom: 1px solid #eee;">{{ $sale['quantity'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
Thanks,<br>
Sales Team
@endcomponent
