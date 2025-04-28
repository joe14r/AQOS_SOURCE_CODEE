    <section class="order-tracking">
        <h2>Order Status</h2>
        <div id="order-status">
            
            @php
            $order_status = session('order_status')->status;
            @endphp
            @if($order_status=="new")
            <p>Your order is currently: <strong>Pending</strong></p>
                <p>Estimated delivery time: <strong>30 minutes</strong></p>
            @elseif($order_status=="preparing")
            <p>Your order is currently: <strong>Preparing</strong></p>
                <p>Estimated delivery time: <strong>20 minutes</strong></p>
            @elseif($order_status=="prepared")
            <p>Your order is currently: <strong>Prepared</strong></p>
                <p>Estimated delivery time: <strong>5 minutes</strong></p>
            @elseif($order_status=="sufed")
                <p><strong>Your food is served</strong></p>
            @elseif($order_status=="cancel")
                <p><strong>Your order is cancel</strong></p>
            @endif
        </div>
        <button class="btn" onclick="location.reload()">Refresh Status</button>
    </section>