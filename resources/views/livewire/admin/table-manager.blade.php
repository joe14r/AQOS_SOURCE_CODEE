<div>
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add/Edit Form -->
    <div class="card">
        <div class="card-header">
            @if($isEditing)
                <h4>Edit Table</h4>
            @else
                <h4>Add Table</h4>
            @endif
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" wire:model="title" id="title" class="form-control" placeholder="Table Title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea wire:model="description" id="description" class="form-control" placeholder="Description"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" wire:model="image" id="image" class="form-control">
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="mt-2" width="200" alt="Image preview">
                @endif

                <div class="form-group">
                    <label for="status">Status</label>
                    <select wire:model="status" id="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $isEditing ? 'Update Table' : 'Add Table' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Table List -->
    <div class="mt-4">
        <h4>Tables</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tables as $table)
                    <tr>
                        <td>{{ $table->tid }}</td>
                        <td>{{ $table->title }}</td>
                        <td>{{ $table->description }}</td>
                        <td>{{ $table->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <!-- View Button -->
                            <button wire:click="view({{ $table->id }})" class="btn btn-info btn-sm">View</button>
                            <!-- Edit Button -->
                            <button wire:click="edit({{ $table->id }})" class="btn btn-warning btn-sm">Edit</button>
                            <!-- Delete Button with JavaScript Confirmation -->
                            <button onclick="confirmDelete({{ $table->id }})" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            {{ $tables->links() }}
        </div>
    </div>

    <!-- Table Details Modal (View) -->
    @if ($viewTable)
        <div class="modal fade show" id="viewTableModal" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Table Details</h5>
                        <button wire:click="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Table ID:</strong> {{ $viewTable->tid }}</p>
                        <p><strong>Title:</strong> {{ $viewTable->title }}</p>
                        <p><strong>Description:</strong> {{ $viewTable->description }}</p>
                        <p><strong>Status:</strong> {{ $viewTable->status ? 'Active' : 'Inactive' }}</p>
                        @if ($viewTable->image)
                            <p><strong>Image:</strong> <img src="{{ Storage::url($viewTable->image) }}" class="mt-2" width="200" alt="Table Image"></p>
                        @endif

                        <strong>QR Code:</strong>
            <img src="{{ $qrcode }}" alt="QR Code" width="200">

                        <p>Order URL: <a href="{{ url('/menu-table/' . $viewTable->tid) }}" target="_blank">{{ url('/menu-table/' . $viewTable->tid) }}</a></p>

            <p>Download Qr Code: <a href="{{ url('/admin/table/' . $viewTable->tid) }}" target="_blank">{{ url('/admin/table/' . $viewTable->tid) }}</a></p>

                        <p><strong>Status:</strong> {{ $viewTable->status ? 'Active' : 'Inactive' }}</p>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(tableId) {
            if (confirm("Are you sure you want to delete this table?")) {
                // If user confirms, trigger Livewire delete method
                @this.call('delete', tableId);
            }
        }
    </script>
</div>