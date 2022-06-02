<?php

namespace App\Http\Livewire\Website\Product;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Index extends Component
{
    public $product;
    public $quantity;
    public $color;
    public $size;
    public $size_field;


    public function mount(Product $product)
    {
        $this->product = $product;

        if ($this->product->size != null) {
            $this->size_field = 1;
        } else {
            $this->size_field = 0;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'color' => 'required',
            'size' => 'required_if:size_field,==,1',
            'quantity' => 'required',

        ]);
    }

    public function render()
    {
        return view('livewire.website.product.index');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);


        $this->validate([
            'color' => 'required',
            'size' => 'required_if:size_field,==,1',
            'quantity' => 'required',
        ]);

        if ($product->discount_price == null) {

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $this->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => array(
                    'size' => $this->size,
                    'color' => $this->color
                )
            ]);
        } else {
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $this->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => array(
                    'size' => $this->size,
                    'color' => $this->color
                )
            ]);
        }

        // Set Flash Message
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => __('site.added_to_cart_successfully')
        ]);

        $this->emit('cart_updated');

        $this->color = '';
        $this->size = '';
        $this->quantity = '';
    }
}
