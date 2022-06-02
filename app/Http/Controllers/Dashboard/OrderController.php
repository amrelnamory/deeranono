<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_orders'])->only('index');
        $this->middleware(['permission:create_orders'])->only('create');
        $this->middleware(['permission:update_orders'])->only('edit');
        $this->middleware(['permission:delete_orders'])->only('destroy');
    } //end of constructor

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        return view('dashboard.orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'shipping' => 'required|numeric|min:1',
            'discount' => 'nullable|numeric|min:1',
            'total' => 'required|min:1|numeric',
        ]);

        foreach ($order->products as $id => $item) {

            $product = Product::findOrFail($item->id);

            if ($item->pivot->quantity > $product->quantity) {
                session()->flash('error', __('site.quantity_not_enough'));
                return redirect()->back();
            }
        } //end of foreach

        $order->update([
            'discount' => $request->discount,
            'shipping' => $request->shipping,
            'total' => $request->total,
        ]);

        foreach ($order->products as $id => $item) {

            $product = Product::findOrFail($item->id);

            $product->update([
                'quantity' => $product->quantity - $item->pivot->quantity
            ]);
        } //end of foreach

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.invoice', $order->id);
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'products' => 'required|array',
        ]);

        $subtotal = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::findOrFail($id);
            $subtotal += $product->selling_price * $quantity['quantity'];

            if ($quantity['quantity'] > $product->quantity) {
                session()->flash('error', __('site.quantity_not_enough'));
                return redirect()->back();
            }
        } //end of foreach

        //$order->products()->detach();

        OrderItem::where('order_id', $order->id)->delete();

        $order->products()->attach($request->products);

        $date = Carbon::now()->locale('ar_AR');

        $order->update([
            'subtotal' => $subtotal,
            'month' => $date->monthName,
            'year' => $date->format('Y'),
        ]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.show', $order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        foreach ($order->products as $item) {
            $product = Product::findOrFail($item->id);

            $product->update([
                'quantity' => $product->quantity + $item->pivot->quantity
            ]);
        } //end of for each

        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        return view('dashboard.orders.invoice', compact('order'));
    }
}
