@extends('layouts.dashboard.app')

@section('title')
    @lang('site.change_password') - {{ $user->name }} | @lang('site.users')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('site.change_password') - {{ $user->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">@Lang('site.users')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.change_password') - {{ $user->name }}</li>

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
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.change_password') - {{ $user->name }}</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">
                                <form action="{{ route('dashboard.users.updatePassword', $user->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}

                                    <div class="form-group">
                                        <label>@Lang('site.password')</label>

                                        <input type="password" class="form-control" name="password">

                                        @error('password')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>@Lang('site.password_confirmation')</label>

                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary"> <i class="fa fa-edit"></i>
                                            @Lang('site.save')</button>
                                    </div>
                                    
                                </form>
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
