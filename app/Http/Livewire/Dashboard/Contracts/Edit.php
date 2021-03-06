<?php

namespace App\Http\Livewire\Dashboard\Contracts;

use App\Models\Car;
use App\Models\Client;
use App\Models\Contract;
use Livewire\Component;

class Edit extends Component
{
    public $contract;
    public $contract_date;
    public $lessor_name;
    public $lessor_nat_id;
    public $lessor_company;
    public $lessor_commercial_no;
    public $lessor_unified_no;
    public $lessor_place;
    public $lessor_release_date;
    public $client_id;
    public $tenant_company;
    public $tenant_commercial_no;
    public $tenant_unified_no;
    public $tenant_place;
    public $tenant_release_date;
    public $car_id;
    public $counter_no;
    public $rent_amount;
    public $total_amount;
    public $rent_start_date;
    public $rent_end_date;
    public $contract_type;
    public $driver_name;
    public $driver_nationality;
    public $driver_residence_no;
    public $contract_terms;
    public $isDisabled = false;

    protected $rules = [
        'contract_date' => 'required|date',
        'lessor_name' => 'required',
        'lessor_nat_id' => 'required|numeric',
        'lessor_company' => 'required',
        'lessor_commercial_no' => 'required|numeric',
        'lessor_unified_no' => 'required|numeric',
        'lessor_place' => 'required',
        'lessor_release_date' => 'required',
        'client_id' => 'required',
        'tenant_company' => 'required',
        'tenant_commercial_no' => 'required|numeric',
        'tenant_unified_no' => 'required|numeric',
        'tenant_place' => 'required',
        'tenant_release_date' => 'required',
        'car_id' => 'required',
        'counter_no' => 'required',
        'rent_amount' => 'required|numeric',
        'total_amount' => 'required|numeric|gte:rent_amount',
        'rent_start_date' => 'required|date',
        'rent_end_date' => 'required|date',
        'contract_type' => 'required',
        'driver_name' => 'required',
        'driver_nationality' => 'required',
        'driver_residence_no' => 'required',
        'contract_terms' => 'required',
    ];


    public function mount(Contract $contract)
    {
        $this->contract = $contract;
        $this->contract_date = $contract->contract_date;
        $this->lessor_name = $contract->lessor_name;
        $this->lessor_nat_id = $contract->lessor_nat_id;
        $this->lessor_company = $contract->lessor_company;
        $this->lessor_commercial_no = $contract->lessor_commercial_no;
        $this->lessor_unified_no = $contract->lessor_unified_no;
        $this->lessor_place = $contract->lessor_place;
        $this->lessor_release_date = $contract->lessor_release_date;
        $this->client_id = $contract->client_id;
        $this->tenant_company = $contract->tenant_company;
        $this->tenant_commercial_no = $contract->tenant_commercial_no;
        $this->tenant_unified_no = $contract->tenant_unified_no;
        $this->tenant_place = $contract->tenant_place;
        $this->tenant_release_date = $contract->tenant_release_date;
        $this->car_id = $contract->car_id;
        $this->counter_no = $contract->counter_no;
        $this->rent_amount = $contract->rent_amount;
        $this->total_amount = $contract->total_amount;
        $this->rent_start_date = $contract->rent_start_date;
        $this->rent_end_date = $contract->rent_end_date;
        $this->contract_type = $contract->contract_type;
        $this->driver_name = $contract->driver_name;
        $this->driver_nationality = $contract->driver_nationality;
        $this->driver_residence_no = $contract->driver_residence_no;
        $this->contract_terms = $contract->contract_terms;
    }


    public function render()
    {
        $clients = Client::all();
        $cars = Car::all();

        return view('livewire.dashboard.contracts.edit', compact('clients', 'cars'));
    }

    public function enable()
    {
        $this->isDisabled = true;
    }

    public function disable()
    {
        $this->isDisabled = false;
    }

    public function update()
    {
        $this->validate();

        $start_timestamp = $this->rent_start_date;
        $end_timestamp = $this->rent_end_date;

        $found = Contract::query()
            ->where('id', '!=', $this->contract->id)
            ->where('car_id', $this->car_id)
            ->where(function ($exits) use ($start_timestamp, $end_timestamp) {
                $exits->where(function ($findConflict) use ($start_timestamp, $end_timestamp) {
                    $findConflict->whereBetween('rent_start_date', [$start_timestamp, $end_timestamp])
                        ->orWhereBetween('rent_end_date', [$start_timestamp, $end_timestamp]);
                })
                    ->orWhere(function ($middleClause) use ($start_timestamp, $end_timestamp) {
                        $middleClause
                            ->where('rent_start_date', '<=', $end_timestamp)
                            ->where('rent_end_date', '>=', $start_timestamp);
                    });
            })
            ->get();

        if ($found->count() > 0) {

            session()->flash('error', '?????????? ?????????????? ?????? ??????????');

            return redirect()->back();
        } else {

            $this->contract->update([
                'contract_date' => $this->contract_date,
                'lessor_name' => $this->lessor_name,
                'lessor_nat_id' => $this->lessor_nat_id,
                'lessor_company' => $this->lessor_company,
                'lessor_commercial_no' => $this->lessor_commercial_no,
                'lessor_unified_no' => $this->lessor_unified_no,
                'lessor_place' => $this->lessor_place,
                'lessor_release_date' => $this->lessor_release_date,
                'client_id' => $this->client_id,
                'tenant_company' => $this->tenant_company,
                'tenant_commercial_no' => $this->tenant_commercial_no,
                'tenant_unified_no' => $this->tenant_unified_no,
                'tenant_place' => $this->tenant_place,
                'tenant_release_date' => $this->tenant_release_date,
                'car_id' => $this->car_id,
                'counter_no' => $this->counter_no,
                'rent_amount' => $this->rent_amount,
                'total_amount' => $this->total_amount,
                'rent_start_date' => $this->rent_start_date,
                'rent_end_date' => $this->rent_end_date,
                'contract_type' => $this->contract_type,
                'driver_name' => $this->driver_name,
                'driver_nationality' => $this->driver_nationality,
                'driver_residence_no' => $this->driver_residence_no,
                'contract_terms' => $this->contract_terms,
                'user_id' => auth()->user()->id,
            ]);

            session()->flash('success', __('site.updated_successfully'));

            return redirect()->route('dashboard.contracts.index');
        }
    }
}
