<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Transection;
use App\Models\Table; // Import the Table model
use Livewire\WithPagination;

class TransectionManager extends Component
{
    use WithPagination;

    // Public properties
    public $payment_method;
    public $date_time;
    public $table_no;
    public $recipeta_number;
    public $amount;
    public $transection_id;
    public $isEditing = false;

    // Get all available tables
    public $tables;

    protected $paginationTheme = 'bootstrap';

    // Validation rules
    protected $rules = [
        'payment_method' => 'required|string',
        'date_time' => 'required|date',
        'table_no' => 'required|exists:restaurent_table,tid', // Ensure table exists
        'recipeta_number' => 'required|string',
        'amount' => 'required|numeric',
    ];

    // Load the tables and transactions
    public function mount()
    {
        $this->tables = Table::all(); // Get all tables from the restaurent_table
        $this->loadOrders();
    }

    public function render()
    {
        $transections = Transection::paginate(10);
        return view('livewire.admin.transection-manager', compact('transections'))->layout('components.layouts.dashboard');
    }

    // Add a new transaction
    public function addTransection()
    {
        $this->validate();

        Transection::create([
            'payment_method' => $this->payment_method,
            'date_time' => $this->date_time,
            'table_no' => $this->table_no,
            'recipeta_number' => $this->recipeta_number,
            'amount' => $this->amount,
        ]);

        session()->flash('message', 'Transaction added successfully.');
        $this->resetFields();
    }

    // Edit an existing transaction
    public function editTransection($id)
    {
        $transection = Transection::findOrFail($id);
        $this->transection_id = $transection->id;
        $this->payment_method = $transection->payment_method;
        $this->date_time = $transection->date_time;
        $this->table_no = $transection->table_no;
        $this->recipeta_number = $transection->recipeta_number;
        $this->amount = $transection->amount;
        $this->isEditing = true;
    }

    // Update an existing transaction
    public function updateTransection()
    {
        $this->validate();

        $transection = Transection::findOrFail($this->transection_id);
        $transection->update([
            'payment_method' => $this->payment_method,
            'date_time' => $this->date_time,
            'table_no' => $this->table_no,
            'recipeta_number' => $this->recipeta_number,
            'amount' => $this->amount,
        ]);

        session()->flash('message', 'Transaction updated successfully.');
        $this->resetFields();
    }
    public function loadOrders()
    {
        // Load transections or perform any logic to retrieve the data
        $this->orders = Transection::latest()->paginate(10);
    }

    // Reset form fields
    public function resetFields()
    {
        $this->payment_method = '';
        $this->date_time = '';
        $this->table_no = '';
        $this->recipeta_number = '';
        $this->amount = '';
        $this->transection_id = null;
        $this->isEditing = false;
    }
}