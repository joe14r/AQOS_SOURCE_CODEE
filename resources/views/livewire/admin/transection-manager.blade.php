<div>
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Transaction Form -->
    <div class="card">
        <div class="card-header">
            @if($isEditing)
                <h4>Edit Transaction</h4>
            @else
                <h4>Add Transaction</h4>
            @endif
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'updateTransection' : 'addTransection' }}">
                
                <!-- Payment Method Radio Buttons -->
                <div class="form-group">
                    <label for="payment_method">Payment Method</label><br>

                    <div class="form-check form-check-inline">
                        <input type="radio" wire:model="payment_method" id="credit_card" value="Credit Card" class="form-check-input">
                        <label class="form-check-label" for="credit_card">Credit Card</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" wire:model="payment_method" id="pay_cash" value="Pay Cash" class="form-check-input">
                        <label class="form-check-label" for="pay_cash">Pay Cash</label>
                    </div>
                    @error('payment_method') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Table No Dropdown -->
                <div class="form-group">
                    <label for="table_no">Table No</label>
                    <select wire:model="table_no" id="table_no" class="form-control">
                        <option value="">Select Table</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->tid }}">{{ $table->title }}</option>
                        @endforeach
                    </select>
                    @error('table_no') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Other Fields: Date Time, Receipt Number, Amount -->
                <div class="form-group">
                    <label for="date_time">Date and Time</label>
                    <input type="datetime-local" wire:model="date_time" id="date_time" class="form-control">
                    @error('date_time') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="recipeta_number">Receipt Number</label>
                    <input type="text" wire:model="recipeta_number" id="recipeta_number" class="form-control" placeholder="Receipt Number">
                    @error('recipeta_number') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" step="0.01" wire:model="amount" id="amount" class="form-control" placeholder="Amount">
                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $isEditing ? 'Update Transaction' : 'Add Transaction' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="mt-4">
        <h4>Transaction List</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Payment Method</th>
                    <th>Date & Time</th>
                    <th>Table No</th>
                    <th>Receipt Number</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transections as $transection)
                    <tr>
                        <td>{{ $transection->id }}</td>
                        <td>{{ $transection->payment_method }}</td>
                        <td>{{ $transection->date_time }}</td>
                        <td>{{ $transection->table_no }}</td>
                        <td>{{ $transection->recipeta_number }}</td>
                        <td>{{ $transection->amount }}</td>
                        <td>
                            <button wire:click="editTransection({{ $transection->id }})" class="btn btn-warning btn-sm">Edit</button>
                        </td>
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