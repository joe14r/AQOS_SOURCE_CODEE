<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItems;

class OrderDetails extends Component
{
    public $order_id;

    public function mount($order_id){
        $this->order_id = $order_id;
    }

    public function changeStatus($status, $id)
    {
        $order = Order::findOrFail($id); // Throws 404 if not found
        $order->status = $status;
        $order->save();
        session()->flash('message', 'Order status updated.');

        return redirect()->back(); // Refresh the page
    }

    public function changePaymentStatus($status, $id)
    {
        $order = Order::findOrFail($id); // Throws 404 if not found
        $order->paymentStatus = $status;
        $order->save();
        session()->flash('message', 'Order payment status updated.');

        return redirect()->back(); // Refresh the page
    }

    public function render()
    {
        $order_items = OrderItems::where('order_id', $this->order_id)->get();
        $order = Order::where('id', $this->order_id)->first();


        return view('livewire.admin.order-details',[
            'order_items'=>$order_items,
            'order'=>$order
        ])->layout('components.layouts.dashboard');
    }
}
