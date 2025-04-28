<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class CartCount extends Component
{
    public $count = 0;

    //protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $cart = session()->get('cart', []);
        $this->count = collect($cart)->sum('quantity');
    }

    #[On('cartUpdated')]
    public function updateCartCount($newCount)
    {
        $cart = session()->get('cart', []);
        $this->count = collect($cart)->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
