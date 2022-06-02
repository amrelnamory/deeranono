@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.brands') | @Lang('site.edit') {{ $brand->name }}

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@Lang('site.brands')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.brands.index') }}">@Lang('site.brands')</a>
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
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@Lang('site.edit')</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">

                                <form action="{{ route('dashboard.brands.update', $brand->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}

                                    <div class="form-group">
                                        <label>@lang('site.name')</label>
                                        <input type="text" name="name" class="form-control" value="{{ $brand->name }}">
                                        @error('name')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="customFile">@Lang('site.image')</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input image" name="image" id="customFile">
                                            <label class="custom-file-label"
                                                for="customFile">@Lang('site.choose_image')</label>
                                        </div>
                                        @error('image')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ $brand->image_path }}" style="width: 150px"
                                            class="img-thumbnail image-preview" alt="">
                                    </div>

                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                        @Lang('site.edit')</button>
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
