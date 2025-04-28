<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $totalOrders;
    public $todayOrders;
    public $todayNewOrders;

    public function mount(){
        $this->totalOrders = Order::count();

        $this->todayOrders = Order::whereDate('created_at', Carbon::today())->count();

        $this->todayNewOrders = Order::whereDate('created_at', Carbon::today())
                                     ->where('status', 'new')
                                     ->count();
    }


    public function render()
    {
        return view('livewire.admin.dashboard')->layout('components.layouts.dashboard');
        // return view('livewire.order-list')
        // ->layout('layouts.dashboard');
    }
}
