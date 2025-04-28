<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;

class CartPage extends Component
{
    public $cartItems = [];

    public function mount()
    {
        $this->cartItems = session()->get('cart', []);
    }

    #[\Livewire\Attributes\On('addToCart')]
    public function addToCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $menu = Menu::findOrFail($id);
            $cart[$id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'image' => $menu->image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $this->cartItems = $cart;
    }

    public function updatedCartItems()
    {
        session(['cart' => $this->cartItems]);
    }

    public function removeItem($id)
    {
        unset($this->cartItems[$id]);
        session(['cart' => $this->cartItems]);
    }


    public function render()
    {
        $this->cartItems = session()->get('cart', []);
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('livewire.cart-page', [
            'total' => $total,
        ]);
    }
}
