<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartList extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];

    public function removeCart($id)
    {
        \CartFacade::remove($id);

        session()->flash('success', 'Item has removed !');
    }

    public function clearAllCart()
    {
        \CartFacade::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');
    }

    public function render()
    {
        $this->cartItems = \CartFacade::getContent()->toArray();
        return view('livewire.cart-list');
    }
}
