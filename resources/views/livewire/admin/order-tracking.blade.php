<div class="modern-admin-order-tracking" wire:poll.visible.10s>
    <div class="modern-admin-order-tracking-card">
        <div class="modern-admin-order-tracking-card-header">
            <h3><i class="fas fa-clipboard-list"></i> Order Tracking</h3>
        </div>
        <div class="modern-admin-order-tracking-card-body">
            <table class="modern-admin-order-tracking-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Table</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Payment</th>
                        <th>Payment Status</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Placed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ isset($order->table->title) ? $order->table->title : '-' }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>
                                <span class="modern-admin-order-badge modern-admin-order-badge-payment">
                                    {{ ucfirst($order->paymentMethod) }}
                                </span>
                            </td>
                            <td>
                                <span class="modern-admin-order-badge 
                                    @if($order->paymentStatus=='pending') modern-admin-order-badge-info
                                    @elseif($order->paymentStatus=='paid') modern-admin-order-badge-success
                                    @elseif($order->paymentStatus=='fail') modern-admin-order-badge-danger
                                    @elseif($order->paymentStatus=='cancel') modern-admin-order-badge-warning
                                    @else modern-admin-order-badge-default @endif">
                                    {{ ucfirst($order->paymentStatus) }}
                                </span>
                            </td>
                            <td>RM {{ number_format($order->total, 2) }}</td>
                            <td>
                                <span class="modern-admin-order-badge 
                                    @if($order->status=='new') modern-admin-order-badge-danger
                                    @elseif($order->status=='preparing') modern-admin-order-badge-primary
                                    @elseif($order->status=='prepared') modern-admin-order-badge-info
                                    @elseif($order->status=='sufed') modern-admin-order-badge-success
                                    @elseif($order->status=='cancel') modern-admin-order-badge-warning
                                    @else modern-admin-order-badge-default @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.order.details', $order->id) }}" class="modern-admin-order-action-btn" title="View"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modern-admin-order-tracking-pagination">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
