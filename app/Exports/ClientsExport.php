<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientsExport implements FromView
{
    public function view(): View
    {
        return view('dashboard.clients.pdf', [
            'clients' => Client::all()
        ]);
    }
}
