<div class="modern-admin-role-manager">
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="modern-admin-alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add/Edit Role Form -->
    <div class="modern-admin-role-card">
        <div class="modern-admin-role-card-header">
            <h3>{{ $isEditing ? 'Edit Role' : 'Add Role' }}</h3>
        </div>
        <div class="modern-admin-role-card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="modern-admin-role-form">
                <div class="modern-admin-role-form-group">
                    <label for="name">Role Name</label>
                    <input type="text" wire:model="name" id="name" class="modern-admin-role-input" placeholder="Role Name">
                    @error('name') <span class="modern-admin-role-error">{{ $message }}</span> @enderror
                </div>
                <div class="modern-admin-role-form-group">
                    <label for="permissions">Permissions</label>
                    <select wire:model="permissions" id="permissions" class="modern-admin-role-input" multiple>
                        @foreach($allPermissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                    @error('permissions') <span class="modern-admin-role-error">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="modern-btn modern-admin-role-btn">
                    {{ $isEditing ? 'Update Role' : 'Add Role' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Role List -->
    <div class="modern-admin-role-list">
        <h3 class="modern-admin-role-list-title">Roles</h3>
        <table class="modern-admin-role-table">
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
                            <button wire:click="edit({{ $role->id }})" class="modern-admin-role-action-btn modern-admin-role-edit" title="Edit"><i class="fas fa-pen"></i></button>
                            <button onclick="confirmDelete({{ $role->id }})" class="modern-admin-role-action-btn modern-admin-role-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modern-admin-role-pagination">
            {{ $roles->links() }}
        </div>
    </div>

    <script>
        function confirmDelete(roleId) {
            if (confirm("Are you sure you want to delete this role?")) {
                @this.call('delete', roleId);
            }
        }
    </script>
</div>