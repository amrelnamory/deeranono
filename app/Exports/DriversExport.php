<?php

namespace App\Exports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DriversExport implements FromView
{
    public function view(): View
    {
        return view('dashboard.drivers.pdf', [
            'drivers' => Driver::all()
        ]);
    }
}
