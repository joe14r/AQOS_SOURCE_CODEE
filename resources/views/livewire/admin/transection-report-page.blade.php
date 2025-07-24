<div class="modern-admin-transection-report">
    <div class="modern-admin-transection-card">
        <div class="modern-admin-transection-card-header">
            <h3><i class="fas fa-file-invoice-dollar"></i> Transaction Report</h3>
            <button wire:click="downloadData" class="modern-btn modern-admin-transection-download-btn">
                <i class="fas fa-download"></i> Download All Orders
            </button>
        </div>
        <div class="modern-admin-transection-card-body">
            <table class="modern-admin-transection-table">
                <thead>
                    <tr>
                        <th>Receipt Number</th>
                        <th>Table No</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Amount (RM)</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transections as $transection)
                        <tr>
                            <td>{{ $transection->id }}</td>
                            <td>{{ $transection->table ? $transection->table->title : '-' }}</td>
                            <td>{{ $transection->paymentMethod }}</td>
                            <td>{{ $transection->paymentStatus }}</td>
                            <td>{{ $transection->status }}</td>
                            <td>{{ $transection->total }}</td>
                            <td>{{ $transection->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modern-admin-transection-pagination">
                {{ $transections->links() }}
            </div>
        </div>
    </div>
</div>