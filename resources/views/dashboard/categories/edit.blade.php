@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.categories') | @Lang('site.edit') {{ $category->name }}

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@Lang('site.categories')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.categories.index') }}">@Lang('site.categories')</a>
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

                                <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.name')</label>
                                            <input type="text" name="{{ $locale }}[name]"
                                                class="form-control @error($locale . '.name') is-invalid @enderror"
                                                value="{{ $category->translate($locale)->name }}">
                                            @error($locale . '.name')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <label>@lang('site.main_department')</label>
                                        <select name="parent" class="form-control select2 custom-select">
                                            <option value="">@lang('site.main_department')</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $category->parent == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('parent')
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
                                        <img src="{{ $category->image_path }}" style="width: 150px"
                                            class="img-thumbnail image-preview" alt="">
                                    </div>

                                    <div class="text-center">
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
