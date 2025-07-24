<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItems;

class PrintPage extends Component
{
    public $order_id;

    public function mount($order_id){
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order_items = OrderItems::where('order_id', $this->order_id)->get();
        $order = Order::where('id', $this->order_id)->first();

        return view('livewire.admin.print-page',[
            'order_items'=>$order_items,
            'order'=>$order
        ])->layout('components.layouts.print');
        //return view('livewire.admin.print-page');
    }
}
