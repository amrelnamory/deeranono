@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.brands')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark mb-2">@Lang('site.brands')<span class="mr-3 btn btn-success"
                            style="cursor: default; font-weight: bold;">{{ $brands->count() }}</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.brands')</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (auth()->user()->hasPermission('create_brands'))
                <a href="{{ route('dashboard.brands.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                    @lang('site.add_brand')</a>

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
                            <h3 class="card-title">@Lang('site.brands')</h3>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <!-- /.card-header -->
                            @if ($brands->count() > 0)

                                <table class="table table-bordered text-center data_table mb-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@Lang('site.name')</th>
                                            <th>@Lang('site.image')</th>
                                            <th>@Lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $index => $brand)
                                            <tr>
                                                <td class="align-middle">{{ $index + 1 }}</td>
                                                <td class="align-middle">{{ $brand->name }}</td>

                                                <td class="align-middle"><img src="{{ $brand->image_path }}"
                                                        style="width: 150px;" class="img-thumbnail" alt=""></td>

                                                <td class="align-middle">
                                                    @if (auth()->user()->hasPermission('update_brands'))
                                                        <a href="{{ route('dashboard.brands.edit', $brand->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                            @Lang('site.edit')</a>

                                                    @endif
                                                    @if (auth()->user()->hasPermission('delete_brands'))
                                                        <form action="{{ route('dashboard.brands.destroy', $brand->id) }}"
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
