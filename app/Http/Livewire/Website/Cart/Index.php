<?php

namespace App\Http\Livewire\Website\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
 
class Index extends Component
{
    protected $listeners = ['cart_update' => 'render'];

    public array $quantity = [];

   
    public function render()
    {
        $cart = Cart::content();

        return view('livewire.website.cart.index', compact('cart'));
    }

    public function removeItem($id)
    {
        $cart = Cart::content();

        $item = $cart->search(function ($id, $rowId) {
            return $id;
        });

        Cart::remove($item);

        // Set Flash Message
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => __('site.removed_from_cart_successfully')
        ]);

        $this->emit('cart_updated');
        $this->emit('cart_update');
    }

    public function updateCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = Cart::content();

        $item = $cart->search(function ($id, $rowId) {
            return $id;
        });

        if ($this->quantity[$id] <= $product->quantity) {
            Cart::update($item, $this->quantity[$id]);

            // Set Flash Message
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => __('site.updated_cart_successfully')
            ]);

            $this->emit('cart_updated');
            $this->emit('cart_update');
        } else {
            // Set Flash Message
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => __('site.quantity_not_enough')
            ]);

            $this->emit('cart_update');
        }
    }
}
