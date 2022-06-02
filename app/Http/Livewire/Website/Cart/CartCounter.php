<?php

namespace App\Http\Livewire\Website\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
 
class CartCounter extends Component
{
    protected $listeners = ['cart_updated' => 'render'];
    public function render()
    {
        $cart = Cart::content();
        $cart_count = $cart->count();
        return view('livewire.website.cart.cart-counter', compact('cart_count', 'cart'));
    }
}
