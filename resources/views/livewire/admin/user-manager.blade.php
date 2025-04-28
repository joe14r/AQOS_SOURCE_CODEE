<div>
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add/Edit User Form -->
    <div class="card">
        <div class="card-header">
            @if($isEditing)
                <h4>Edit User</h4>
            @else
                <h4>Add User</h4>
            @endif
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" wire:model="name" id="name" class="form-control" placeholder="User Name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" wire:model="email" id="email" class="form-control" placeholder="User Email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" wire:model="password" id="password" class="form-control" placeholder="Password">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" wire:model="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>

                <div class="form-group">
                    <label for="roles">Roles</label>
                    @php
//dd($user_roles);
                    @endphp
                    <select wire:model="roles" id="roles" class="form-control" multiple>
                        <option value="">Select Role</option>
                        @foreach($user_roles as $value => $label)
                        <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $isEditing ? 'Update User' : 'Add User' }}
                </button>
            </form>
        </div>
    </div>

    <!-- User List -->
    <div class="mt-4">
        <h4>Users</h4>
        <table class="table table-bordered">
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
                            <!-- Edit Button -->
                            <button wire:click="edit({{ $user->id }})" class="btn btn-warning btn-sm">Edit</button>
                            <!-- Delete Button with Confirmation -->
                            <button onclick="confirmDelete({{ $user->id }})" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            {{ $users->links() }}
        </div>
    </div>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                // If user confirms, trigger Livewire delete method
                @this.call('delete', userId);
            }
        }
    </script>
</div>