<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            margin: 20px;
        }
        .order-info {
            margin-top: 20px;
            text-align: left;
        }
        .order-info p {
            font-size: 18px;
        }
        .order-info h2 {
            text-decoration: underline;
        }
        .btn-print {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>
        
        <div class="order-info">
            <h2>Order Information</h2>
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p>Create Date : <strong>{{ $order->created_at }}</strong></p>
            <p><strong>Table No:</strong> {{ App\Models\Table::find($order->table_id)->title }}</p>
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Phone Number:</strong> {{ $order->phone }}</p>
            <p><strong>Item Details:</strong>
            	<table border="1"  style="border-spacing: 0;">
            		<tr>
            			<td>SL#</td>
            			<td>Item name</td>
            			<td>Quantaty</td>
            			<td>Price</td>
            			<td>Total Price</td>
            		</tr>
            		@php
            			$items = App\Models\OrderItems::where('order_id', $order->id)->get();
            			
            		@endphp

            		@foreach($items as $index => $item)
            		@php
            			$itemDetails = App\Models\Menu::find($item->menu_item_id);
            		@endphp
            		<tr>
            			<td>{{ $index + 1 }}</td>
            			<td>{{ $itemDetails->name }}</td>
            			<td>{{ $item->quantity }}</td>
            			<td>{{ $itemDetails->price }}</td>
            			<td>{{ $item->price*$item->quantity  }}</td>
            		</tr>
            		@endforeach

            		<tr>
            			<td colspan="4">Total : </td>
            			<td>{{ $order->total  }}</td>
            		</tr>

            	</table>
            </p>
            
        </div>
        
        <button class="btn-print" onclick="window.print()">Print Order</button>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>