<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Table;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableManager extends Component
{
    use WithPagination, WithFileUploads;

    public $tid, $title, $description, $image, $status;
    public $table_id;
    public $isEditing = false;
    public $viewTable = null;
    public $qrcode = null;

    // Validation rules
    protected $rules = [
        //'tid' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        //'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        'status' => 'required|in:active,inactive',
    ];

    // Set default status
    public function mount()
    {
        $this->status = true;
    }

    // Render the page with table list and pagination
    public function render()
    {
        $tables = Table::latest()->paginate(10);
        return view('livewire.admin.table-manager', compact('tables'))
            ->layout('components.layouts.dashboard');
    }

    // Store a new table
    public function store()
    {
        $this->validate();

        // Handle image upload
        if ($this->image) {
            $imagePath = $this->image->store('table_images', 'public');
        }

        Table::create([
            'tid' => uniqid(),
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? $imagePath : null,
            'status' => $this->status,
        ]);

        $this->resetFields();
        session()->flash('message', 'Table added successfully.');
    }

    // Edit an existing table
    public function edit($id)
    {
        $this->isEditing = true;
        $table = Table::findOrFail($id);

        $this->table_id = $table->id;
        // $this->tid = $table->tid;
        $this->title = $table->title;
        $this->description = $table->description;
        $this->status = $table->status;
        $this->image = null; // Keep the current image unless a new one is uploaded
    }

    // Update an existing table
    public function update()
    {
        $this->validate();

        $table = Table::findOrFail($this->table_id);

        // Handle image upload if a new image is provided
        if ($this->image) {
            // Delete the old image if it exists
            if ($table->image) {
                Storage::delete('public/' . $table->image);
            }
            $imagePath = $this->image->store('table_images', 'public');
        } else {
            $imagePath = $table->image; // Keep the old image
        }

        $table->update([
            //'tid' => $this->tid,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
            'status' => $this->status,
        ]);

        $this->resetFields();
        session()->flash('message', 'Table updated successfully.');
    }

    // Delete a table
    public function delete($id)
    {
        $table = Table::findOrFail($id);

        // Delete the image if it exists
        if ($table->image) {
            Storage::delete('public/' . $table->image);
        }

        $table->delete();

        session()->flash('message', 'Table deleted successfully.');
    }

    // Show details of a table in a modal
    public function view($id)
    {
        $this->viewTable = Table::findOrFail($id);
        $url = config('app.url').'/menu-table/'.$this->viewTable->tid;
        $qrCode = QrCode::size(300)->generate($url);
        $this->qrcode= 'data:image/png;base64,' . base64_encode($qrCode);

         // Fetch the table details
    }

    // Reset the form fields
    public function resetFields()
    {
        $this->tid = '';
        $this->title = '';
        $this->description = '';
        $this->image = null;
        $this->status = true;
        $this->isEditing = false;
    }

    // Close the modal
    public function closeModal()
    {
        $this->viewTable = null; // Reset table details
    }
}