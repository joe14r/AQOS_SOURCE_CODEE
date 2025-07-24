<div class="modern-admin-menu-manager">
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="modern-admin-alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add/Edit Form -->
    <div class="modern-admin-menu-card modern-admin-menu-card-modern">
        <div class="modern-admin-menu-card-header">
            <h3><i class="fas fa-utensils"></i> {{ $isEditing ? 'Edit Menu Item' : 'Add Menu Item' }}</h3>
        </div>
        <div class="modern-admin-menu-card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" enctype="multipart/form-data" class="modern-admin-menu-form-modern">
                <div class="modern-admin-menu-form-row">
                    <div class="modern-admin-menu-form-group">
                        <label for="name">Name</label>
                        <input type="text" wire:model="name" id="name" class="modern-admin-menu-input-modern" placeholder="Menu Name">
                        @error('name') <span class="modern-admin-menu-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="modern-admin-menu-form-group">
                        <label for="price">Price</label>
                        <input type="number" wire:model="price" id="price" class="modern-admin-menu-input-modern" placeholder="Price" step="0.01">
                        @error('price') <span class="modern-admin-menu-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modern-admin-menu-form-group">
                    <label for="description">Description</label>
                    <textarea wire:model="description" id="description" class="modern-admin-menu-input-modern" placeholder="Description"></textarea>
                    @error('description') <span class="modern-admin-menu-error">{{ $message }}</span> @enderror
                </div>
                <div class="modern-admin-menu-form-row">
                    <div class="modern-admin-menu-form-group">
                        <label for="image">Image</label>
                        <input type="file" wire:model="image" id="image" class="modern-admin-menu-input-file-modern">
                        @error('image') <span class="modern-admin-menu-error">{{ $message }}</span> @enderror
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="modern-admin-menu-img-preview-modern" alt="Image preview">
                        @endif
                    </div>
                    <div class="modern-admin-menu-form-group">
                        <label for="status">Status</label>
                        <select wire:model="status" id="status" class="modern-admin-menu-input-modern">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status') <span class="modern-admin-menu-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <button type="submit" class="modern-btn modern-admin-menu-btn-modern">
                    <i class="fas {{ $isEditing ? 'fa-save' : 'fa-plus' }}"></i> {{ $isEditing ? 'Update Menu Item' : 'Add Menu Item' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Menu List -->
    <div class="modern-admin-menu-list">
        <h3 class="modern-admin-menu-list-title"><i class="fas fa-list"></i> Menu Items</h3>
        <table class="modern-admin-menu-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuItems as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->price }}</td>
                        <td>{{ $menu->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <button wire:click="edit({{ $menu->id }})" class="modern-admin-menu-action-btn-modern modern-admin-menu-edit-modern" title="Edit"><i class="fas fa-pen"></i></button>
                            <button onclick="confirmDelete({{ $menu->id }})" class="modern-admin-menu-action-btn-modern modern-admin-menu-delete-modern" title="Delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modern-admin-menu-pagination">
            {{ $menuItems->links() }}
        </div>
    </div>
    <script>
        function confirmDelete(menuId) {
            if (confirm("Are you sure you want to delete this menu item?")) {
                @this.call('delete', menuId);
            }
        }
    </script>
</div>
