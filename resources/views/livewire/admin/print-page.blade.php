<div class="order-details">
    <h2>Order Details</h2>

    <!-- Order Info -->
    <div class="order-info">
        <h3>Customer Information</h3>
        <p><strong>Table:</strong> {{ isset($order->table->title) ? $order->table->title : '' }}</p>
        <p><strong>Name:</strong> {{ $order->name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($order->paymentMethod) }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->paymentStatus) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total Price:</strong> RM {{ number_format($order->total, 2) }}</p>
        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
    </div>

    <!-- Order Status Buttons -->
    <div class="order-status">
        <h3>Order Status</h3>
        <p>Status: 
            <span class="status-btn">{{ $order->status == 'new' ? 'New' : '' }}</span>
            <span class="status-btn">{{ $order->status == 'preparing' ? 'Preparing' : '' }}</span>
            <span class="status-btn">{{ $order->status == 'prepared' ? 'Prepared' : '' }}</span>
            <span class="status-btn">{{ $order->status == 'sufed' ? 'Sufed' : '' }}</span>
            <span class="status-btn">{{ $order->status == 'cancel' ? 'Cancel' : '' }}</span>
        </p>
        <p>Payment Status:
            <span class="status-btn">{{ $order->paymentStatus == 'pending' ? 'Pending' : '' }}</span>
            <span class="status-btn">{{ $order->paymentStatus == 'paid' ? 'Paid' : '' }}</span>
            <span class="status-btn">{{ $order->paymentStatus == 'fail' ? 'Payment Fail' : '' }}</span>
            <span class="status-btn">{{ $order->paymentStatus == 'cancel' ? 'Payment Cancel' : '' }}</span>
        </p>
    </div>

    <!-- Order Items Table -->
    <div class="order-items">
        <h3>Order Items</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($order_items as $item)
                    @php
                        $subtotal = $item->price * $item->quantity;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td>RM {{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>RM {{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Grand Total:</strong></td>
                    <td><strong>RM {{ number_format($grandTotal, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>