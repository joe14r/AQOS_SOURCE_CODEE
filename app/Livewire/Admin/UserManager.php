<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserManager extends Component
{
    use WithPagination;

    public $name, $email, $password, $confirm_password, $roles, $user_id, $isEditing = false;

    // Validation rules for the form
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm_password',
        'roles' => 'required|array', // Validate roles as an array
        'roles.*' => 'in:admin,user,editor', // Define allowed roles
    ];

    public function render()
    {
        $users = User::latest()->paginate(10);
        $user_roles = Role::pluck('name','name')->all();

        return view('livewire.admin.user-manager',[
            'users'=>$users,
            'user_roles'=>$user_roles
        ])->layout('components.layouts.dashboard'); // Adjust layout if necessary
    }

    // Add new user
    public function store()
    {
        // Validate the data
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password',
            'roles' => 'required|array',
            'roles.*' => 'required', // Validate allowed roles
        ]);

        // Hash password
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Assign roles to the user
        $user->syncRoles($this->roles); // Use syncRoles to assign multiple roles

        // Reset the form and set success message
        $this->resetForm();
        session()->flash('message', 'User created successfully.');
    }

    // Edit an existing user
    public function edit($id)
    {
        $this->isEditing = true;
        $user = User::findOrFail($id);

        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles->pluck('name')->toArray(); // Multiple roles as an array
        $this->password = ''; // Don't fill the password field
        $this->confirm_password = ''; // Don't fill the confirm password field
    }

    // Update user
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user_id)],
            'password' => 'nullable|same:confirm_password',
            'roles' => 'required|array',
            'roles.*' => 'required', // Validate allowed roles
        ]);

        $user = User::findOrFail($this->user_id);

        // Update user details
        $user->name = $this->name;
        $user->email = $this->email;

        // Update password if provided
        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }

        // Save the user data
        $user->save();

        // Remove existing roles and assign new ones
        DB::table('model_has_roles')->where('model_id', $this->user_id)->delete();
        $user->assignRole($this->roles); // Assign multiple roles

        // Reset the form and set success message
        $this->resetForm();
        session()->flash('message', 'User updated successfully.');
    }

    // Delete user
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message', 'User deleted successfully.');
    }

    // Reset the form
    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->roles = [];
        $this->isEditing = false;
        $this->user_id = null;
    }
}