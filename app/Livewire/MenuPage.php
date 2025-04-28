<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Livewire\CartCount;


class MenuPage extends Component
{
    public $menus;
    public $cartItems = [];

    public function mount()
    {
        $this->cartItems = session()->get('cart', []);
        $this->menus = Menu::all();
    }
    

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
        $this->dispatch('cartUpdated', $cart)->to(CartCount::class);

        session()->put('cart', $cart);
        $this->cartItems = $cart;
    }

    public function render()
    {
        $menus = Menu::where('status', 'active')->get();
        return view('livewire.menu-page',[
            'menus'=>$menus
        ]);
    }
}
