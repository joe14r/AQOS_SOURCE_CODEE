<div>
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add/Edit Role Form -->
    <div class="card">
        <div class="card-header">
            @if($isEditing)
                <h4>Edit Role</h4>
            @else
                <h4>Add Role</h4>
            @endif
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" wire:model="name" id="name" class="form-control" placeholder="Role Name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="permissions">Permissions</label>
                    <select wire:model="permissions" id="permissions" class="form-control" multiple>
                        @foreach($allPermissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                    @error('permissions') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $isEditing ? 'Update Role' : 'Add Role' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Role List -->
    <div class="mt-4">
        <h4>Roles</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                        <td>
                            <button wire:click="edit({{ $role->id }})" class="btn btn-warning btn-sm">Edit</button>
                            <button onclick="confirmDelete({{ $role->id }})" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            {{ $roles->links() }}
        </div>
    </div>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(roleId) {
            if (confirm("Are you sure you want to delete this role?")) {
                // If user confirms, trigger Livewire delete method
                @this.call('delete', roleId);
            }
        }
    </script>
</div>