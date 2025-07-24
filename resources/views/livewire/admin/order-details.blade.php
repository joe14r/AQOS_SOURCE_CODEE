<div class="order-details p-6">
    <h2 class="text-2xl font-semibold mb-4">Order Details
        <a href="{{ route('admin.order.print', $order->id) }}" target="_blank">Print</a>
    </h2>

    {{-- Order Info --}}
    <div class="mb-6 bg-gray-100 p-4 rounded shadow-sm">
        <h3 class="text-xl font-medium mb-2">Customer Information</h3>
        <p><strong>Table:</strong> {{ isset($order->table->title) ? $order->table->title : '' }}</p>
        <p><strong>Name:</strong> {{ $order->name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($order->paymentMethod) }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->paymentStatus) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total Price:</strong> RM {{ number_format($order->total, 2) }}</p>
        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
    </div>
    <div class="col-md-12 mt-30">
        <h3>Order Status</h3>
        <button type="button" class="btn {{ $order->status == 'new' ? 'btn-primary' : 'btn-light' }}" >New</button>
        <button type="button" class="btn {{ $order->status == 'preparing' ? 'btn-primary' : 'btn-light' }}" wire:click="changeStatus('preparing', {{ $order->id }})">Preparing</button>

        <button type="button" class="btn {{ $order->status == 'prepared' ? 'btn-primary' : 'btn-light' }}" wire:click="changeStatus('prepared', {{ $order->id }})">Prepared</button>

        <button type="button" class="btn {{ $order->status == 'sufed' ? 'btn-primary' : 'btn-light' }}" wire:click="changeStatus('sufed', {{ $order->id }})">Sufed</button>

        <button type="button" class="btn {{ $order->status == 'cancel' ? 'btn-primary' : 'btn-light' }}" wire:click="changeStatus('cancel', {{ $order->id }})">cancel</button>
</div>
<div class="col-md-12 mt-30 mb-30">

        <h3>Payment Status</h3>
        <button type="button" class="btn {{ $order->paymentStatus == 'pending' ? 'btn-success' : 'btn-light' }}">Pending</button>

        <button type="button" class="btn {{ $order->paymentStatus == 'paid' ? 'btn-success' : 'btn-light' }}" wire:click="changePaymentStatus('paid', {{ $order->id }})">Paid</button>

        <button type="button" class="btn {{ $order->paymentStatus == 'fail' ? 'btn-success' : 'btn-light' }}" wire:click="changePaymentStatus('fail', {{ $order->id }})">Payment Fail</button>

        <button type="button" class="btn {{ $order->paymentStatus == 'cancel' ? 'btn-success' : 'btn-light' }}" wire:click="changePaymentStatus('cancel', {{ $order->id }})">Payment cancel</button>


    </div>

    {{-- Order Items Table --}}
    <div class="bg-white shadow rounded p-4">
        <h3 class="text-xl font-medium mb-3">Order Items</h3>
        <table class="w-full border-collapse border text-left">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">Item Name</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Subtotal</th>
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
                        <td class="border px-4 py-2">
                            <img src="{{ asset('storage/' . $item->menu->image) }}" alt="{{ $item->menu->name }}" width="60">
                        </td>
                        <td class="border px-4 py-2">{{ $item->menu->name }}</td>
                        <td class="border px-4 py-2">RM {{ number_format($item->price, 2) }}</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">RM {{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-100 font-semibold">
                    <td colspan="4" class="border px-4 py-2 text-right">Grand Total:</td>
                    <td class="border px-4 py-2">RM {{ number_format($grandTotal, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
