<?php

namespace App\Http\Livewire\Dashboard\MaintenanceInvoices;

use App\Models\Car;
use App\Models\MaintenanceInvoice;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Create extends Component
{
    use WithFileUploads;

    public $items = [];
    public $car_id;
    public $invoice_date;
    public $total = 0;
    public $images = [];

    protected $rules = [
        'items.*.item'              => 'required',
        'items.*.quantity'          => 'required',
        'items.*.price'             => 'required',
        'items.*.change_date'       => 'nullable|date',
        'car_id'                    => 'required',
        'invoice_date'              => 'required|date',
        'images'                    => 'nullable',
        'images.*'                  => 'nullable|image',
    ];


    public function mount()
    {
        $this->items = [
            ['item' => '', 'quantity' => '', 'price' => '', 'total_item' => '', 'change_date' => '']
        ];
    }

    public function render()
    {
        $cars = Car::all();
        return view('livewire.dashboard.maintenance-invoices.create', compact('cars'));
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

    public function remove($index)
    {
        array_splice($this->images, $index, 1);
    }


    public function store()
    {
        $this->validate();

        foreach ($this->items as $key => $item) {
            $this->items[$key]['total_item'] = (float)$this->items[$key]['quantity'] * (float)$this->items[$key]['price'];

            $this->total += (float)$item['quantity'] * (float)$item['price'];
        }

        $invoice = MaintenanceInvoice::create([
            'car_id' => $this->car_id,
            'date' => $this->invoice_date,
            'total' => $this->total,
            'user_id' => auth()->user()->id,
        ]);

        if ($this->images) {

            foreach ($this->images as $key => $image) {

                Image::make($image)
                    ->save(public_path() . '/uploads/maintenanceInvoices/' .  $image->hashName(), 60);

                $Imgdata[] = $image->hashName();
            }

            $invoice->update([
                'images' => json_encode($Imgdata)
            ]);
        } else {
            $invoice->update([
                'images' => 'not-found.jpg'
            ]);
        } //end of if

        $invoice->items()->createMany(
            $this->items
        );

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.maintenanceInvoices.index');
    }
}
