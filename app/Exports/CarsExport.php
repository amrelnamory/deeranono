<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CarsExport implements FromView
{
    
    public function view(): View
    {
        return view('dashboard.cars.pdf', [
            'cars' => Car::all()
        ]);
    }
}
