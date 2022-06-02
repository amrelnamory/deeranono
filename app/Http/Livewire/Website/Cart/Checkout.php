<?php

namespace App\Http\Livewire\Website\Cart;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Checkout extends Component
{
    public $name;
    public $phone;
    public $address;
    public $email;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required',
            'phone' => 'required|digits:11',
            'address' => 'required',
            'email' => 'nullable|email',

        ]);
    }

    public function render()
    {
        return view('livewire.website.cart.checkout');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required|digits:11',
            'address' => 'required',
            'email' => 'nullable|email',
        ]);

        $date = Carbon::now()->locale('ar_AR');

        $order = Order::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'email' => $this->email,
            'subtotal' => Cart::subtotal(),
            'month' => $date->monthName,
            'year' => $date->format('Y'),
        ]);

        $order->update([
            'orderNo' => $order->id . date('d') . date('m') . date('Y')
        ]);

        $cart = Cart::content();
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'color' => $item->options->color,
                'size' => $item->options->size,
                'quantity' => $item->qty,
                'selling_price' => $item->price,
                'subtotal' => $item->qty * $item->price,
            ]);
        }

        session()->flash('success', $order->orderNo);
        Cart::destroy();
        return redirect()->route('website.orderSuccess');
    }
}
