@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.orders')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark mb-2">@Lang('site.orders')<span class="mr-3 btn btn-success"
                            style="cursor: default; font-weight: bold;">{{ $orders->count() }}</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.orders')</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            {{-- @if (auth()->user()->hasPermission('create_orders'))
                <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                    @lang('site.add_order')</a>

            @endif --}}

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
                            <h3 class="card-title">@Lang('site.orders')</h3>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <!-- /.card-header -->
                            @if ($orders->count() > 0)

                                <table class="table table-bordered text-center data_table mb-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@Lang('site.order_id')</th>
                                            <th>@Lang('site.name')</th>
                                            <th>@Lang('site.phone')</th>
                                             <th>@Lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $index => $order)
                                            <tr>
                                                <td class="align-middle">{{ $index + 1 }}</td>
                                                <td class="align-middle">{{ $order->orderNo }}</td>
                                                <td class="align-middle">{{ $order->name }}</td>
                                                <td class="align-middle">{{ $order->phone }}</td>
  
                                                <td class="align-middle">
                                                    @if ($order->total != null)
                                                    <a href="{{ route('dashboard.orders.invoice', $order->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-eye"></i>
                                                        @Lang('site.the_invoice')</a>
                                                    @endif
                                                    <a href="{{ route('dashboard.orders.show', $order->id) }}"
                                                        class="btn btn-success btn-sm"><i class="fa fa-eye"></i>
                                                        @Lang('site.show_order')</a>

                                                    @if (auth()->user()->hasPermission('update_orders'))
                                                        <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                            @Lang('site.edit')</a>

                                                    @endif
                                                    @if (auth()->user()->hasPermission('delete_orders'))
                                                        <form action="{{ route('dashboard.orders.destroy', $order->id) }}"
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
