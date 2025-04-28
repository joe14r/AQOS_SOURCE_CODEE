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
                <h4>Edit Menu Item</h4>
            @else
                <h4>Add Menu Item</h4>
            @endif
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" wire:model="name" id="name" class="form-control" placeholder="Menu Name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea wire:model="description" id="description" class="form-control" placeholder="Description"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" wire:model="price" id="price" class="form-control" placeholder="Price" step="0.01">
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" wire:model="image" id="image" class="form-control">
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select wire:model="status" id="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $isEditing ? 'Update Menu Item' : 'Add Menu Item' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Menu List -->
    <div class="mt-4">
        <h4>Menu Items</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- <th>Description</th> -->
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
                        <!-- <td>{{ $menu->description }}</td> -->
                        <td>{{ $menu->price }}</td>
                        <td>{{ $menu->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <button wire:click="edit({{ $menu->id }})" class="btn btn-warning btn-sm">Edit</button>
                            <button onclick="confirmDelete({{ $menu->id }})" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            {{ $menuItems->links() }}
        </div>
    </div>
    <script>
        function confirmDelete(menuId) {
            if (confirm("Are you sure you want to delete this menu item?")) {
                // If user confirms, trigger Livewire delete method
                @this.call('delete', menuId);
            }
        }
    </script>
</div>
