<div>
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label>@Lang('site.car_name')</label>
                <select wire:model="car_id" class="form-control custom-select">
                    <option value="">@Lang('site.choose')</option>
                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}" {{ $car->id == $car_id ? 'checked' : '' }}> {{ $car->name }} - {{ $car->model }} - {{ $car->plate_no }} </option>
                    @endforeach

                </select>
                @error('car_id')
                    <div class="text-danger text-bold">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label>@Lang('site.invoice_date')</label>
                <input type="date" wire:model="invoice_date" class="form-control" value="{{$invoice_date}}">

                @error('invoice_date')
                    <div class="text-danger text-bold">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>


    <table class="table table-hover table-bordered">
        <thead>
            <tr class="text-center">
                <th colspan="6">@Lang('site.items')</th>
            </tr>
            <tr class="text-center">
                <th width="30%">@Lang('site.item')</th>
                <th>@Lang('site.quantity')</th>
                <th>@Lang('site.price')</th>
                <th>@Lang('site.total_item')</th>
                <th>@Lang('site.change_date')</th>
                <th>@Lang('site.action')</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($items as $index => $item)
                <tr>
                    <td class="align-middle">
                        <div class="form-group">
                            <input type="text" wire:model="items.{{ $index }}.item" class="form-control">
                            @error('items.' . $index . '.item')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="form-group">
                            <input type="text" wire:model="items.{{ $index }}.quantity" class="form-control">
                            @error('items.' . $index . '.quantity')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="form-group">
                            <input type="text" wire:model="items.{{ $index }}.price" class="form-control">
                            @error('items.' . $index . '.price')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="form-group">
                            <input type="text" value="{{ (float) $item['price'] * (float) $item['quantity'] }}"
                                readonly class="form-control">
                            @error('items.' . $index . '.total_item')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        @php
                            $total += (float) $item['price'] * (float) $item['quantity'];
                        @endphp
                    </td>
                    <td class="align-middle">
                        <div class="form-group">
                            <input type="date" wire:model="items.{{ $index }}.change_date"
                                class="form-control">
                            @error('items.' . $index . '.change_date')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                    <td class="align-middle text-center">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="removeRow({{ $index }})"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">
                    <button wire:click.prevent="addNewRow" class="btn btn-success"><i class="fa fa-plus"></i>
                        @Lang('site.add_new_item')</button>
                </td>
            </tr>
        </tbody>
    </table>
 

    <div class="form-group text-center">
        <button wire:loading.remove wire:click.prevent="update" class="btn btn-lg m-auto text-center btn-primary">
            <i class="fa fa-plus"></i>@Lang('site.save')
        </button>

        <button wire:loading wire:target="update" class="btn btn-lg m-auto text-center btn-primary">
            <i class="fas fa-spinner fa-spin text-2xl"></i>
        </button>
    </div>

</div>
 
