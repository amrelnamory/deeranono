@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.slides') | @Lang('site.edit') {{ $slide->title }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('dashboardAssets/plugins/tagify/dist/tagify.css') }}">

@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@Lang('site.slides')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.slides.index') }}">@Lang('site.slides')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.edit') {{ $slide->title }}</li>

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
                            <h3 class="card-title">@Lang('site.edit') {{ $slide->title }}</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">

                                <form action="{{ route('dashboard.slides.update', $slide->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}

                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.title')</label>
                                            <input type="text" name="{{ $locale }}[title]" class="form-control"
                                                value="{{ $slide->translate($locale)->title }}">
                                            @error($locale . '.title')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.description')</label>
                                            <textarea name="{{ $locale }}[description]" rows="3"
                                                class="form-control">{{ $slide->translate($locale)->description }}</textarea>
                                            @error($locale . '.description')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

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
                                        <img src="{{ $slide->image_path }}" style="width: 150px"
                                            class="img-thumbnail image-preview" alt="">
                                    </div>


                                    <div class="text-center mt-2">
                                        <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-plus"></i>
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
