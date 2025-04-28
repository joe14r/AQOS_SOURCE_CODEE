<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Livewire\Attributes\On;
// use Livewire\WithPagination;

class OrderTracking extends Component
{
    //use WithPagination;

    public function render()
    {

        return view('livewire.admin.order-tracking', [

            'orders' => Order::latest()->paginate(10),

        ])->layout('components.layouts.dashboard');
    }
}