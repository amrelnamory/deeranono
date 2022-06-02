@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.products')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark mb-2">@Lang('site.products')<span class="mr-3 btn btn-success"
                            style="cursor: default; font-weight: bold;">{{ $products->count() }}</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.products')</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (auth()->user()->hasPermission('create_products'))
                <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                    @lang('site.add_product')</a>

            @endif

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
                            <h3 class="card-title">@Lang('site.products')</h3>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <!-- /.card-header -->
                            @if ($products->count() > 0)

                                <table class="table table-bordered text-center data_table mb-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@Lang('site.name')</th>
                                            <th>@Lang('site.category_id')</th>
                                            <th>@Lang('site.quantity')</th>
                                            <th>@Lang('site.selling_price')</th>
                                            <th>@Lang('site.image')</th>
                                            <th>@Lang('site.status')</th>
                                            <th>@Lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $index => $product)

                                            @php
                                                $image = json_decode($product->images, true);
                                            @endphp

                                            <tr>
                                                <td class="align-middle">{{ $index + 1 }}</td>
                                                <td class="align-middle">{{ $product->name }}</td>
                                                <td class="align-middle">{{ $product->category->name }}</td>
                                                <td class="align-middle">{{ $product->quantity }}</td>
                                                <td class="align-middle">{{ number_format($product->selling_price, 2) }}
                                                </td>

                                                <td class="align-middle"><img
                                                        src="{{ $product->image_path . '/' . $image[0] }}"
                                                        style="width: 150px;" class="img-thumbnail" alt=""></td>
                                                <td class="align-middle">
                                                    @if ($product->status == 1)
                                                        <span class="badge badge-success">@Lang('site.active')</span>
                                                    @else
                                                        <span class="badge badge-danger">@Lang('site.in_active')</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">

                                                    <a href="{{ route('dashboard.products.show', $product->id) }}"
                                                        class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i>
                                                        @Lang('site.show_product_details')</a>

                                                    @if (auth()->user()->hasPermission('update_products'))
                                                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                            @Lang('site.edit')</a>

                                                    @endif

                                                    @if (auth()->user()->hasPermission('delete_products'))
                                                        <form
                                                            action="{{ route('dashboard.products.updateStatus', $product->id) }}"
                                                            method="post" style="display: inline-block">
                                                            {{ csrf_field() }}
                                                            {{ method_field('put') }}

                                                            @if ($product->status == 1)
                                                                <button type="submit" class="btn btn-warning btn-sm"><i
                                                                        class="fas fa-thumbs-down"></i>
                                                                    @lang('site.deactivate')</button>
                                                            @else
                                                                <button type="submit" class="btn btn-success btn-sm"><i
                                                                        class="fas fa-thumbs-up"></i>
                                                                    @lang('site.activate')</button>
                                                            @endif

                                                        </form><!-- end of form -->
                                                    @endif

                                                    @if (auth()->user()->hasPermission('delete_products'))
                                                        <form
                                                            action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                            method="post" style="display: inline-block">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                                    class="fa fa-trash"></i>
                                                                @lang('site.delete')</button>
                                                        </form><!-- end of form -->

                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h2>@Lang('site.no_data_found')</h2>
                            @endif
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
