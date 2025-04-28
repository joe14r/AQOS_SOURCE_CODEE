<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderTrackingPage extends Component
{
    public $order;

    public function mount(){
        $this->order = session('order');
        $order_status = Order::findOrFail($this->order->id);
        session(['order_status' => $order_status]);
    }


    public function render()
    {
        return view('livewire.order-tracking-page');
    }
}
