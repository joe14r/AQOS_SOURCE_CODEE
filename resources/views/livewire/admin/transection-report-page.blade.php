<div>

    <!-- Transaction List -->
    <div class="mt-4">
        <h4>Transaction Report <button wire:click="downloadData" class="btn btn-success">
        Download All Orders
    </button></h4>
        <table class="table table-bordered">
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
                        <td>{{ $transection->table->title }}</td>
                        <td>{{ $transection->paymentMethod }}</td>
                        <td>{{ $transection->paymentStatus }}</td>
                        <td>{{ $transection->status }}</td>
                        <td>{{ $transection->total }}</td>
                        <td>{{ $transection->created_at }}</td>
                                <!-- 'table_id',
        'name',
        'phone',
        'paymentMethod',
        'paymentStatus',
        'total',
        'status' -->
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            {{ $transections->links() }}
        </div>
    </div>
</div>