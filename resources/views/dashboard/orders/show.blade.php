@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.orders') | {{ $order->name }}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@Lang('site.orders')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.orders.index') }}">@Lang('site.orders')</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $order->name }}</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $order->name }}</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">

                                <table class="table table-bordered text-center">
                                    <tbody>
                                        <tr>
                                            <th class="align-middle">@Lang('site.order_id')</th>
                                            <td class="align-middle">{{ $order->orderNo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.name')</th>
                                            <td class="align-middle">{{ $order->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.phone')</th>
                                            <td class="align-middle">{{ $order->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.address')</th>
                                            <td class="align-middle">{{ $order->address }}</td>
                                        </tr>
                                        @if ($order->email != null)
                                            <tr>
                                                <th class="align-middle">@Lang('site.email')</th>
                                                <td class="align-middle">{{ $order->email }}</td>
                                            </tr>
                                        @endif


                                        <tr>
                                            <th class="align-middle">@Lang('site.products')</th>
                                            <td class="align-middle">
                                                <table style="width: 100%">
                                                    <thead>
                                                        <th>@lang('site.product')</th>
                                                        <th>@lang('site.quantity')</th>
                                                        <th>@lang('site.price')</th>
                                                        <th>@lang('site.total')</th>
                                                        <th>@lang('site.image')</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                            @php
                                                                $image = json_decode($product->images, true);
                                                            @endphp

                                                            <tr>
                                                                <td class="align-middle"><a target="_blank"
                                                                        href="{{ route('dashboard.products.show', $product->id) }}">
                                                                        {{ $product->name }}
                                                                        @if ($product->pivot->color != null)
                                                                            -
                                                                            {{ $product->pivot->color }}
                                                                        @endif
                                                                        @if ($product->pivot->size != null)
                                                                            -
                                                                            {{ $product->pivot->size }}
                                                                        @endif
                                                                    </a> </td>
                                                                <td class="align-middle">
                                                                    {{ $product->pivot->quantity }}</td>
                                                                <td class="align-middle">
                                                                    {{ number_format($product->pivot->selling_price, 2) }}
                                                                </td>
                                                                <td class="align-middle">
                                                                    {{ number_format($product->pivot->selling_price * $product->pivot->quantity, 2) }}
                                                                </td>
                                                                <td class="align-middle"><a target="_blank"
                                                                        href="{{ route('dashboard.products.show', $product->id) }}"><img
                                                                            class="img-thumbinal" width="80"
                                                                            src="{{ $product->image_path . '/' . $image[0] }}"
                                                                            alt="{{ $product->name }}"></a></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="align-middle">@Lang('site.subtotal')</th>
                                            <td class="align-middle">
                                                <input type="hidden" id="subtotal" value="{{ $order->subtotal }}">
                                                {{ number_format($order->subtotal, 2) }}
                                            </td>
                                        </tr>
                                        @if ($order->shipping != null)
                                            <tr>
                                                <th class="align-middle">@Lang('site.shipping')</th>
                                                <td class="align-middle">{{ number_format($order->shipping, 2) }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($order->discount != null)
                                            <tr>
                                                <th class="align-middle">@Lang('site.discount')</th>
                                                <td class="align-middle">{{ number_format($order->discount, 2) }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if ($order->total != null)
                                            <tr>
                                                <th class="align-middle">@Lang('site.total')</th>
                                                <td class="align-middle">{{ number_format($order->total, 2) }}
                                                </td>
                                            </tr>
                                        @endif


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    @if ($order->total == null)
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">@lang('site.check_out')</h3>
                            </div>
                            <div class="card-body pt-3 pb-3">
                                <!-- /.card-header -->
                                <div class="container-fluid">

                                    <form action="{{ route('dashboard.orders.update', $order->id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>@lang('site.shipping')</label>
                                            <input type="text" name="shipping" class="form-control"
                                                value="{{ old('shipping') }}" id="shipping">
                                            @error('shipping')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.discount')</label>
                                            <input type="text" name="discount" class="form-control"
                                                value="{{ old('discount') }}" id="discount">
                                            @error('discount')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.total')</label>
                                            <input type="text" name="total" class="form-control"
                                                value="{{ old('total') }}" id="total" readonly>
                                            @error('total')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary"><i
                                                    class="fa fa-plus"></i>
                                                @Lang('site.save')</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        @push('scripts')
                            <script>
                                $('input').on('change keyup click', function() {
                                    var subtotal = document.getElementById("subtotal").value;

                                    var shipping = document.getElementById("shipping").value;

                                    var discount = document.getElementById("discount").value;

                                    var total = (Number(subtotal) - Number(discount)) + Number(shipping);

                                    document.getElementById("total").value = total;
                                });
                            </script>
                        @endpush

                    @endif
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
