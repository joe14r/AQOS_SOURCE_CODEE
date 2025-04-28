<?php

namespace App\Livewire\Admin;


use Livewire\Component;
use App\Models\Menu;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class MenuManager extends Component
{
    use WithPagination, WithFileUploads;  // Enable pagination

    public $name, $description, $price, $image, $status;
    public $menu_id;  // Store the ID of the menu item being edited
    public $isEditing = false;  // Check if the component is in edit mode

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        'status' => 'required',
    ];

    public function mount()
    {
        // Set the default status for new menu items
        $this->status = true;
    }

    // Render method for displaying the component view
    public function render()
    {
        // Paginate the menu items
        $menuItems = Menu::latest()->paginate(10);
        
        return view('livewire.admin.menu-manager', compact('menuItems'))
            ->layout('components.layouts.dashboard');
    }

    // Create a new menu item
    public function store()
    {
        // Validate the data
        $this->validate();

        // Handle image upload if there is a new image
        if ($this->image) {
            $imagePath = $this->image->store('menu_images', 'public');
        }

        // Create a new menu item
        Menu::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image ? $imagePath : null,
            'status' => $this->status,
        ]);

        // Clear form fields and reset state
        $this->resetFields();
        session()->flash('message', 'Menu item added successfully.');
    }

    // Edit an existing menu item
    public function edit($id)
    {
        $this->isEditing = true;
        $menu = Menu::findOrFail($id);

        // Populate the form fields with the existing data
        $this->menu_id = $menu->id;
        $this->name = $menu->name;
        $this->description = $menu->description;
        $this->price = $menu->price;
        $this->status = $menu->status;
        $this->image = null;  // Keep the current image unless a new one is uploaded
    }

    // Update the existing menu item
    public function update()
    {
        $this->validate();

        // Get the existing menu item
        $menu = Menu::findOrFail($this->menu_id);

        // Handle image upload if there is a new image
        if ($this->image) {
            // Delete the old image if it exists
            if ($menu->image) {
                Storage::delete('public/' . $menu->image);
            }
            // Store the new image
            $imagePath = $this->image->store('menu_images', 'public');
        } else {
            $imagePath = $menu->image;  // Keep the old image if no new image is uploaded
        }

        // Update the menu item with the new data
        $menu->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $imagePath,
            'status' => $this->status,
        ]);

        // Clear form fields and reset state
        $this->resetFields();
        session()->flash('message', 'Menu item updated successfully.');
    }

    // Delete a menu item
    public function delete($id)
    {
        $menu = Menu::findOrFail($id);

        // Delete the image if it exists
        if ($menu->image) {
            Storage::delete('public/' . $menu->image);
        }

        // Delete the menu item from the database
        $menu->delete();

        session()->flash('message', 'Menu item deleted successfully.');
    }

    // Reset form fields
    public function resetFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->image = null;
        $this->status = true;
        $this->isEditing = false;
    }
}
