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
                    <h1 class="m-0 text-dark">@Lang('site.edit_order')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.orders.index') }}">@Lang('site.orders')</a>
                        </li>

                        <li class="breadcrumb-item active">@Lang('site.edit')</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div id="result"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h1 class="card-title">@Lang('site.products')</h1>
                        </div>
                        <div class="card-body table-responsive pt-3 pb-3">
                            <!-- /.card-header -->

                            <table class="table table-hover table-bordered text-center data_table">
                                <thead>
                                    <tr>
                                        <th>الكود</th>
                                         <th>@lang('site.name')</th>
                                        <th>@lang('site.category_id')</th>
                                        <th>الكمية الموجودة</th>
                                        <th>@lang('site.price')</th>
                                         <th>@lang('site.add')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($products as $product)
                                        @php
                                            $date = \Carbon\Carbon::now()->locale('ar_AR');
                                            $ndate = $date->isoFormat('YYYY-MM-DD');
                                        @endphp

                                        <tr>
                                            <td>{{ $product->code }}</td>
                                             <td>{{ $product->name }}</td>

                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ number_format($product->selling_price, 2) }}</td>

 
                                            @if ($product->quantity != 0)
                                                <td class="align-middle">
                                                    <a href="" id="product-{{ $product->id }}"
                                                        data-name="{{ $product->name }}" data-id="{{ $product->id }}"
                                                        data-price="{{ $product->selling_price }}"
                                                        data-quantity="{{ $product->quantity }}"
                                                        class="btn btn-success {{ in_array($product->id, $order->products->pluck('id')->toArray()) ? 'disabled' : 'btn-success add-product-btn' }} btn-sm">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- end of table -->


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-12 col-sm-12">

                    <div class="card card-primary">

                        <div class="card-header">
                            <h1 class="card-title">@Lang('site.orders')</h1>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('dashboard.orders.updateOrder', $order->id) }}" method="post"
                                id="store-order" name="billForm">

                                {{ csrf_field() }}
                                {{ method_field('put') }}
 
                                <table class="table table-hover table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.product')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.price')</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody class="order-list">
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td class="align-middle">{{ $product->name }}
                                                    <input type="hidden"
                                                        name="products[{{ $product->id }}][selling_price]"
                                                        value="{{ $product->pivot->selling_price }}">
                                                </td>
                                                <td class="align-middle">
                                                    <input type="number" name="products[{{ $product->id }}][quantity]"
                                                        data-price="{{ $product->selling_price }}"
                                                        class="form-control input-sm product-quantity" min="1"
                                                        value="{{ $product->pivot->quantity }}"
                                                        max="{{ $product->quantity + $product->pivot->quantity }}"
                                                        title="الكمية لا يجب أن تتعدى {{ $product->quantity + $product->pivot->quantity }}">
                                                </td>
                                                <td class="product-price align-middle">
                                                    {{ $product->selling_price * $product->pivot->quantity }}

                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-danger btn-sm remove-product-btn"
                                                        data-id="{{ $product->id }}"><span
                                                            class="fa fa-trash"></span></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><!-- end of table -->
 

                                <div class="text-center">
                                    <button class="btn btn-lg btn-primary" name="btnsave" id="add-order-form-btn"><i
                                            class="fa fa-plus"></i> @lang('site.save')</button>
                                </div>

                            </form>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
@endsection
