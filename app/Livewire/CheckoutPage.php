<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
// use App\Events\OrderPlaced;
use App\Jobs\BroadcastOrderPlaced;

class CheckoutPage extends Component
{
    public $name;
    public $phone;
    public $paymentMethod;
    public $cartItems = [];
    public $booked_table;

    public function mount()
    {
        $this->booked_table = session()->get('table_booked', []);
        // dd($this->booked_table['id']);
        
    }

    public function placeOrder()
        {
            $this->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'paymentMethod' => 'required|in:credit,cash',
            ]);

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                session()->flash('error', 'Your cart is empty!');
                return;
            }

            $this->cartItems = session()->get('cart', []);
            $total = 0;
            foreach ($this->cartItems as $item) {
                $total += $item['price'] * $item['quantity'];
            }


            // Create the order
            $order = Order::create([
                'table_id' => isset($this->booked_table['id']) ? $this->booked_table['id'] : '',
                'name' => $this->name,
                'phone' => $this->phone,
                'paymentMethod' => $this->paymentMethod,
                'paymentStatus' => 'pending',
                'total' => $total,
                'status' => 'new',
            ]);

            session(['order' => $order]);
            // Save order items
            foreach ($cart as $menuId => $item) {
                \App\Models\OrderItems::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menuId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // event(new OrderPlaced($order));
            try {
                    // Broadcasting logic
                    //event(new OrderPlaced($order));
                    dispatch(new BroadcastOrderPlaced($order));
                } catch (\Exception $e) {
                    Log::error('Error event OrderPlaced event', [
                        'error' => $e->getMessage(),
                        'order_id' => $this->order->id,
                    ]);
                }

            // Clear the cart
            session()->forget('cart');
            //$this->dispatch('refreshOrders')->to(Admin\OrderTracking::class);
            //$this->dispatch('refreshOrders')->to('admin.order-tracking');

            session()->flash('success', 'Order placed successfully!');
            // return redirect()->route('order.tracking');
            return redirect()->to(route('order.tracking'));

        }

        

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
