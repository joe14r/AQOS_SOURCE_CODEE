<div class="order-list">
    <h2>Order List</h2>
    @php
    //dd($orders[0]);
    @endphp
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Table</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Payment</th>
                <th>Total</th>
                <th>Status</th>
                <th>Placed</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            @php
                //dd($order);
            @endphp
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ isset($order->table->title) ? $order->table->title : '' }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ ucfirst($order->paymentMethod) }} ({{ $order->paymentStatus }})</td>
                    <td>RM {{ number_format($order->total, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.order.details', $order->id) }}">view</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
{{ $orders->links() }}
@section('script')
<script>
// window.Echo.private('orders')
//         .listen('.order.placed', (e) => {
//             console.log('Order placed!', e);
//             alert(JSON.stringify(e.order));
//         });
</script>
@endsection
</div>
