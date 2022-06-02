@extends('layouts.dashboard.app')

@section('title')
    @lang('site.users')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@Lang('site.users')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.users')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (auth()->user()->hasPermission('create_users'))
                <a href="{{ route('dashboard.users.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
                    @lang('site.add_user')</a>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">@Lang('site.users') </h3>
                        </div>
                        <div class="card-body table-responsive p-3 ">
                            <!-- /.card-header -->
                            @if ($users->count() > 0)
                                <table class="table table-bordered text-center mb-4 data_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@Lang('site.name')</th>
                                            <th>@Lang('site.email')</th>
                                            <th>@lang('site.phone')</th>
                                            <th>@Lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td class="align-middle">{{ $index + 1 }}</td>
                                                <td class="align-middle">{{ $user->name }}</td>
                                                <td class="align-middle">{{ $user->email }}</td>
                                                <td class="align-middle">{{ $user->phone }}</td>

                                                <td class="align-middle">

                                                    @if (auth()->user()->hasPermission('update_users'))
                                                        <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                            class="btn btn-sm btn-info m-1"><i class="fa fa-edit"></i>
                                                            @Lang('site.edit')</a>
                                                    @endif

                                                    @if (auth()->user()->hasPermission('update_users'))
                                                        <a href="{{ route('dashboard.users.changePassword', $user->id) }}"
                                                            class="btn btn-sm btn-warning m-1"><i class="fa fa-key"></i>
                                                            @Lang('site.change_password')</a>
                                                    @endif

                                                    @if (auth()->user()->hasPermission('delete_users'))
                                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}"
                                                            method="post" style="display: inline-block">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="btn btn-sm btn-danger delete m-1"><i
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
