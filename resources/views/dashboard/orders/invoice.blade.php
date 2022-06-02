@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.invoice') {{ $order->name }}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@Lang('site.invoice') {{ $order->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.orders.index') }}">@Lang('site.orders')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.invoice') {{ $order->name }}</li>

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
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        @if ($order->products->count() > 0)

                            <button class="btn btn-sm col-1 m-2 float-right btn-primary" onclick="printDiv('printMe')"><i
                                    class="fa fa-print"></i> @lang('site.print')</button>

                            <div class="card-body p-3" id="printMe">
                                @include('layouts.dashboard.includes.printHeader')

                                <div class="text-center print-title mb-3">@Lang('site.sales_bill')</div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 invoice-col mb-3">
                                        <p class="mb-3"><b>@lang('site.buying_date') :
                                                {{ $order->created_at->format('Y-m-d') }}</b></p>
                                        <p><b>@lang('site.order_id') : {{ $order->orderNo }}</b></p>
                                    </div>

                                    <div class="col-md-6 col-sm-12 invoice-col mb-3">
                                        <p class="mb-3"><b>@lang('site.name') :
                                                {{ $order->name }}</b></p>
                                        <p><b>@lang('site.phone') : {{ $order->phone }}</b></p>
                                    </div>
                                </div>

                                <table class="table table-bordered text-center mb-4 table-print">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('site.name')</th>
                                            <th>@lang('site.price')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.subtotal')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $index => $product)
                                            <tr>
                                                <td class="align-middle">{{ $index + 1 }}</td>
                                                <td class="align-middle">{{ $product->name }}
                                                    @if ($product->pivot->color != null)
                                                        -
                                                        {{ $product->pivot->color }}
                                                    @endif
                                                    @if ($product->pivot->size != null)
                                                        -
                                                        {{ $product->pivot->size }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    {{ number_format($product->pivot->selling_price, 2) }}
                                                </td>
                                                <td class="align-middle">{{ $product->pivot->quantity }}</td>
                                                <td class="align-middle">
                                                    {{ number_format($product->pivot->quantity * $product->selling_price, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <table class="table table-bordered text-center mb-4 table-print">
                                            <tr>
                                                <th class="align-middle" colspan="2">
                                                    <label>@lang('site.subtotal')</label>
                                                </th>
                                                <td class="align-middle" colspan="10">
                                                    {{ number_format($order->subtotal, 2) }}
                                                </td>
                                            </tr>
                                            @if ($order->discount != null)
                                                <tr>
                                                    <th class="align-middle" colspan="2">
                                                        <label>@lang('site.discount')</label>
                                                    </th>
                                                    <td class="align-middle" colspan="10">
                                                        {{ number_format($order->discount, 2) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($order->shipping != null)
                                                <tr>
                                                    <th class="align-middle" colspan="2">
                                                        <label>@lang('site.shipping')</label>
                                                    </th>
                                                    <td class="align-middle" colspan="10">
                                                        {{ number_format($order->shipping, 2) }}
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th class="align-middle" colspan="2">
                                                    <label>@lang('site.total')</label>
                                                </th>
                                                <td class="align-middle" colspan="10">
                                                    {{ number_format($order->total, 2) }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>

                                @include('layouts.dashboard.includes.printFooter')

                            @else
                                <h2>@Lang('site.no_data_found')</h2>
                        @endif
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
