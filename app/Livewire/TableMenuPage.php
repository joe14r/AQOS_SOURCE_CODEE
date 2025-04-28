<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\Table;
use App\Livewire\CartCount;

class TableMenuPage extends Component
{

    public $menus;
    public $cartItems = [];
    public $tid;
    public $booked_table;

    public function mount($tid)
    {
        $this->tid=$tid;
        $this->cartItems = session()->get('cart', []);
        $this->menus = Menu::all();
        $this->booked_table = Table::where('tid', $this->tid)->get()->first();
        if ($this->booked_table) {
            //\Log::warning('Yes! booked table found in session.');
            session()->put('table_booked', [
            'id' => $this->booked_table->id,
            'tid' => $this->booked_table->tid,
            'title' => $this->booked_table->title,
        ]);
        }
        
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

    // public function render()
    // {
    //     $menus = Menu::where('status', 'active')->get();
    //     return view('livewire.menu-page',[
    //         'menus'=>$menus
    //     ]);
    // }
    public function render()
    {
        $menus = Menu::where('status', 'active')->get();
        // $table = Table::where('tid', $this->tid)->get()->first();
        // session()->put('table_booked', $table);
        return view('livewire.table-menu-page',[
            'menus'=>$menus,
            'booked_table'=>$this->booked_table
        ]);
    }
}
