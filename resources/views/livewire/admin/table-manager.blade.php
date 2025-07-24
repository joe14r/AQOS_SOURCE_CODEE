<div class="modern-admin-table-manager">
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="modern-admin-alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add/Edit Form -->
    <div class="modern-admin-table-card">
        <div class="modern-admin-table-card-header">
            <h3>{{ $isEditing ? 'Edit Table' : 'Add Table' }}</h3>
        </div>
        <div class="modern-admin-table-card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" enctype="multipart/form-data" class="modern-admin-table-form">
                <div class="modern-admin-table-form-group">
                    <label for="title">Title</label>
                    <input type="text" wire:model="title" id="title" class="modern-admin-table-input" placeholder="Table Title">
                    @error('title') <span class="modern-admin-table-error">{{ $message }}</span> @enderror
                </div>
                <div class="modern-admin-table-form-group">
                    <label for="description">Description</label>
                    <textarea wire:model="description" id="description" class="modern-admin-table-input" placeholder="Description"></textarea>
                    @error('description') <span class="modern-admin-table-error">{{ $message }}</span> @enderror
                </div>
                <div class="modern-admin-table-form-group">
                    <label for="image">Image</label>
                    <input type="file" wire:model="image" id="image" class="modern-admin-table-input-file">
                    @error('image') <span class="modern-admin-table-error">{{ $message }}</span> @enderror
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="modern-admin-table-img-preview" alt="Image preview">
                    @endif
                </div>
                <div class="modern-admin-table-form-group">
                    <label for="status">Status</label>
                    <select wire:model="status" id="status" class="modern-admin-table-input">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status') <span class="modern-admin-table-error">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="modern-btn modern-admin-table-btn">
                    {{ $isEditing ? 'Update Table' : 'Add Table' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Table List -->
    <div class="modern-admin-table-list">
        <h3 class="modern-admin-table-list-title">Tables</h3>
        <table class="modern-admin-table-table">
            <thead>
                <tr>
                    <th>Table ID</th>
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
                            <button wire:click="view({{ $table->id }})" class="modern-admin-table-action-btn modern-admin-table-view" title="View"><i class="fas fa-eye"></i></button>
                            <button wire:click="edit({{ $table->id }})" class="modern-admin-table-action-btn modern-admin-table-edit" title="Edit"><i class="fas fa-pen"></i></button>
                            <button onclick="confirmDelete({{ $table->id }})" class="modern-admin-table-action-btn modern-admin-table-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modern-admin-table-pagination">
            {{ $tables->links() }}
        </div>
    </div>

    <!-- Table Details Modal (View) -->
    @if ($viewTable)
        <div class="modern-admin-table-modal-overlay">
            <div class="modern-admin-table-modal">
                <div class="modern-admin-table-modal-header">
                    <h4>Table Details</h4>
                    <button wire:click="closeModal" type="button" class="modern-admin-table-modal-close">&times;</button>
                </div>
                <div class="modern-admin-table-modal-body">
                    <p><strong>Table ID:</strong> {{ $viewTable->tid }}</p>
                    <p><strong>Title:</strong> {{ $viewTable->title }}</p>
                    <p><strong>Description:</strong> {{ $viewTable->description }}</p>
                    <p><strong>Status:</strong> {{ $viewTable->status ? 'Active' : 'Inactive' }}</p>
                    @if ($viewTable->image)
                        <p><strong>Image:</strong> <img src="{{ Storage::url($viewTable->image) }}" class="modern-admin-table-img-preview" alt="Table Image"></p>
                    @endif
                    <strong>QR Code:</strong>
                    <img src="{{ $qrcode }}" alt="QR Code" class="modern-admin-table-img-preview">
                    <p>Order URL: <a href="{{ url('/menu-table/' . $viewTable->tid) }}" target="_blank">{{ url('/menu-table/' . $viewTable->tid) }}</a></p>
                    <p>Download Qr Code: <a href="{{ url('/admin/table/' . $viewTable->tid) }}" target="_blank">{{ url('/admin/table/' . $viewTable->tid) }}</a></p>
                </div>
                <div class="modern-admin-table-modal-footer">
                    <button wire:click="closeModal" type="button" class="modern-btn modern-admin-table-modal-close-btn">Close</button>
                </div>
            </div>
        </div>
    @endif

    <script>
        function confirmDelete(tableId) {
            if (confirm("Are you sure you want to delete this table?")) {
                @this.call('delete', tableId);
            }
        }
    </script>
</div>