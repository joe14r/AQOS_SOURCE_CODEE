<div class="modern-admin-user-manager">
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="modern-admin-alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add/Edit User Form -->
    <div class="modern-admin-user-card compact">
        <div class="modern-admin-user-card-header">
            <h3>{{ $isEditing ? 'Edit User' : 'Add User' }}</h3>
        </div>
        <div class="modern-admin-user-card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="modern-admin-user-form compact">
                <div class="modern-admin-user-form-row">
                    <div class="modern-admin-user-form-group">
                        <label for="name">Name</label>
                        <input type="text" wire:model="name" id="name" class="modern-admin-user-input" placeholder="User Name">
                        @error('name') <span class="modern-admin-user-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="modern-admin-user-form-group">
                        <label for="email">Email</label>
                        <input type="email" wire:model="email" id="email" class="modern-admin-user-input" placeholder="User Email">
                        @error('email') <span class="modern-admin-user-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modern-admin-user-form-row">
                    <div class="modern-admin-user-form-group">
                        <label for="password">Password</label>
                        <input type="password" wire:model="password" id="password" class="modern-admin-user-input" placeholder="Password">
                        @error('password') <span class="modern-admin-user-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="modern-admin-user-form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" wire:model="confirm_password" id="confirm_password" class="modern-admin-user-input" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="modern-admin-user-form-group">
                    <label for="roles">Roles</label>
                    <select wire:model="roles" id="roles" class="modern-admin-user-input" multiple>
                        <option value="">Select Role</option>
                        @foreach($user_roles as $value => $label)
                        <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('roles') <span class="modern-admin-user-error">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="modern-btn modern-admin-user-btn">
                    {{ $isEditing ? 'Update User' : 'Add User' }}
                </button>
            </form>
        </div>
    </div>

    <!-- User List -->
    <div class="modern-admin-user-list">
        <h3 class="modern-admin-user-list-title">Users</h3>
        <table class="modern-admin-user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                        <td>
                            <button wire:click="edit({{ $user->id }})" class="modern-admin-user-action-btn modern-admin-user-edit" title="Edit"><i class="fas fa-pen"></i></button>
                            <button onclick="confirmDelete({{ $user->id }})" class="modern-admin-user-action-btn modern-admin-user-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modern-admin-user-pagination">
            {{ $users->links() }}
        </div>
    </div>

    <script>
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                @this.call('delete', userId);
            }
        }
    </script>
</div>