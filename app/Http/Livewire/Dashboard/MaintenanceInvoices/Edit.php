<?php

namespace App\Http\Livewire\Dashboard\MaintenanceInvoices;

use App\Models\Car;
use App\Models\MaintenanceInvoice;
use Livewire\Component;

class Edit extends Component
{

    public $invoice;
    public $items = [];
    public $allItems;
    public $car_id;
    public $invoice_date;
    public $total = 0;

    protected $rules = [
        'items.*.item'              => 'required',
        'items.*.quantity'          => 'required',
        'items.*.price'             => 'required',
        'items.*.change_date'       => 'nullable|date',
        'car_id'                    => 'required',
        'invoice_date'              => 'required|date',
    ];

    public function mount(MaintenanceInvoice $invoice)
    {
        $this->invoice = $invoice;
        $this->car_id = $invoice->car_id;
        $this->invoice_date = $invoice->date;

        foreach ($this->invoice->items as $key => $item) {
            $this->items[] =
                ['item' => $item->item, 'quantity' => $item->quantity, 'price' => $item->price, 'total_item' => $item->total_item, 'change_date' => $item->change_date];
        }
    }

    public function render()
    {
        $cars = Car::all();
        return view('livewire.dashboard.maintenance-invoices.edit', compact('cars'));
    }


    public function addNewRow()
    {
        $this->items[] = ['item' => '', 'quantity' => '', 'price' => '', 'total_item' => '', 'change_date' => ''];
    }

    public function removeRow($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }


    public function update()
    {
        $this->validate();

        foreach ($this->items as $key => $item) {
            $this->items[$key]['total_item'] = (float)$this->items[$key]['quantity'] * (float)$this->items[$key]['price'];

            $this->total += (float)$item['quantity'] * (float)$item['price'];
        }

        $this->invoice->update([
            'car_id' => $this->car_id,
            'date' => $this->invoice_date,
            'total' => $this->total,
            'user_id' => auth()->user()->id,
        ]);

        $this->invoice->items()->where('maintenance_invoice_id', $this->invoice->id)->delete();

        $this->invoice->items()->createMany(
            $this->items
        );

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.maintenanceInvoices.index');
    }
}
