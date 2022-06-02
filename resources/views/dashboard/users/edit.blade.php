@extends('layouts.dashboard.app')

@section('title')
    @lang('site.edit') {{ $user->name }} | @lang('site.users')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('site.edit') {{ $user->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">@Lang('site.users')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.edit') {{ $user->name }}</li>

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
                            <h3 class="card-title">@lang('site.edit') {{ $user->name }}</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">
                                <form action="{{ route('dashboard.users.update', $user->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    <div class="form-group">
                                        <label>@Lang('site.name')</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                                        @error('name')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>@Lang('site.job')</label>
                                        <input type="text" class="form-control" value="{{ $user->job }}" name="job">
                                        @error('job')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>@Lang('site.address')</label>
                                        <input type="text" class="form-control" value="{{ $user->address }}"
                                            name="address">
                                        @error('address')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.phone')</label>
                                        <input type="text" class="form-control" value="{{ $user->phone }}"
                                            name="phone">
                                        @error('phone')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@Lang('site.email')</label>
                                        <input type="text" class="form-control" value="{{ $user->email }}"
                                            name="email">
                                    </div>

                                    <div class="form-group">
                                        <label>@Lang('site.permissions')</label>
                                        <div class="float-right">
                                            @lang('site.select_all') : <input id="checkall" class='' type="checkbox">
                                        </div>
                                        <div class="card card-primary card-outline">
                                            <div class="card-body">
                                                @php
                                                    $models = ['users', 'settings', 'slider', 'categories', 'products', 'orders', 'articles', 'companies', 'messages'];
                                                    $maps = ['create', 'read', 'update', 'delete'];
                                                @endphp
                                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                                    @foreach ($models as $index => $model)
                                                        <li class="nav-item">
                                                            <a class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                                                id="custom-content-below-home-tab" data-toggle="pill"
                                                                href="#{{ $model }}" role="tab"
                                                                aria-controls="custom-content-below-home"
                                                                aria-selected="true">@Lang('site.' . $model)</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content mt-2" id="custom-content-below-tabContent">
                                                    @foreach ($models as $index => $model)
                                                        <div class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}"
                                                            id="{{ $model }}" role="tabpanel"
                                                            aria-labelledby="custom-content-below-home-tab">

                                                            @foreach ($maps as $map)
                                                                <label><input type="checkbox" class="checkbox"
                                                                        name="permissions[]"
                                                                        {{ $user->hasPermission($map . '_' . $model) ? 'checked' : '' }}
                                                                        value="{{ $map . '_' . $model }}"> @lang('site.'
                                                                    .
                                                                    $map)</label><br>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            <!-- /.card -->
                                        </div>
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

    @push('scripts')

        <script>
            $("#checkall").click(function() {
                if ($("#checkall").is(':checked')) {
                    $(".checkbox").each(function() {
                        $(this).prop("checked", true);
                    });
                } else {
                    $(".checkbox").each(function() {
                        $(this).prop("checked", false);
                    });
                }
            });
        </script>

    @endpush

@endsection
