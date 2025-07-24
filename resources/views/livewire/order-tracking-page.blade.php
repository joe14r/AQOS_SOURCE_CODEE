<main>
    <section class="modern-tracking-section">
        <h2 class="modern-tracking-title">Order Status</h2>
        <div class="modern-tracking-status-card">
            @php
            $order = session('order_status');
            @endphp
            @if($order)
                <div class="modern-tracking-info">
                    <p><span class="modern-tracking-label">Order Id:</span> <strong>{{ $order->id }}</strong></p>
                    <p><span class="modern-tracking-label">Create Date:</span> <strong>{{ $order->created_at }}</strong></p>
                </div>
                <div class="modern-tracking-progress">
                    @if($order->status=="new")
                        <p class="modern-tracking-status">Your order is currently: <strong>Pending</strong></p>
                        <p class="modern-tracking-estimate">Estimated delivery time: <strong>30 minutes</strong></p>
                    @elseif($order->status=="preparing")
                        <p class="modern-tracking-status">Your order is currently: <strong>Preparing</strong></p>
                        <p class="modern-tracking-estimate">Estimated delivery time: <strong>20 minutes</strong></p>
                    @elseif($order->status=="prepared")
                        <p class="modern-tracking-status">Your order is currently: <strong>Prepared</strong></p>
                        <p class="modern-tracking-estimate">Estimated delivery time: <strong>5 minutes</strong></p>
                    @elseif($order->status=="sufed")
                        <p class="modern-tracking-status"><strong>Your food is served</strong></p>
                    @elseif($order->status=="cancel")
                        <p class="modern-tracking-status"><strong>Your order is cancelled</strong></p>
                    @endif
                </div>
                <div class="modern-tracking-actions">
                    <a class="modern-btn modern-tracking-btn" href="{{ route('order.print', $order->unique_id) }}">Print</a>
                    <a class="modern-btn modern-tracking-btn" href="{{ route('order.download', $order->unique_id) }}">Download PDF</a>
                </div>
            @else
                <p class="modern-tracking-empty">No order found. Please place an order first.</p>
            @endif
        </div>
        <button class="modern-btn modern-tracking-refresh" onclick="location.reload()">Refresh Status</button>
    </section>
</main>