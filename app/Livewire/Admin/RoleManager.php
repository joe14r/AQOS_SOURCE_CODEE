<?php

namespace App\Livewire\Admin;


use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use DB;

class RoleManager extends Component
{
    use WithPagination;

    public $name, $role_id, $permissions = [], $isEditing = false;

    // Validation rules for the form
    protected $rules = [
        'name' => 'required',
        'permissions' => 'required|array',
        //'permissions.*' => 'in:admin,KH staf',
    ];

    // Render the component and get paginated list of roles
    public function render()
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        $allPermissions = Permission::get();
        return view('livewire.admin.role-manager', compact('roles','allPermissions'))
            ->layout('components.layouts.dashboard'); // Adjust layout if necessary
    }

    // Create new role
    public function store()
    {
        // Validate the data
        $this->validate();

        // Create a new role
        $role = Role::create(['name' => $this->name]);

        $permissionsArray = array_map('intval', $this->permissions);

        //dd($permissionsArray);

        // Sync permissions
        $role->syncPermissions($permissionsArray);

        // Sync the permissions
        //$role->syncPermissions($this->permissions);

        // Reset the form and set success message
        $this->resetForm();
        session()->flash('message', 'Role created successfully.');
    }

    // Edit role
    public function edit($id)
    {
        $this->isEditing = true;
        $role = Role::findOrFail($id);

        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->permissions = $role->permissions->pluck('id')->toArray(); // Get assigned permissions as an array
    }

    // Update the role
    public function update()
    {
        $this->validate();

        $role = Role::findOrFail($this->role_id);
        $role->name = $this->name;
        $role->save();

        $permissionsArray = array_map('intval', $this->permissions);

        //dd($permissionsArray);

        // Sync permissions
        $role->syncPermissions($permissionsArray);

        $this->resetForm();
        session()->flash('message', 'Role updated successfully.');
    }

    // Delete the role
    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        session()->flash('message', 'Role deleted successfully.');
    }

    // Reset form fields
    private function resetForm()
    {
        $this->name = '';
        $this->role_id = null;
        $this->permissions = [];
        $this->isEditing = false;
    }
}
