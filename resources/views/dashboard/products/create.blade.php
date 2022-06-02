@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.products') | @Lang('site.add_product')
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
                    <h1 class="m-0 text-dark">@Lang('site.products')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.products.index') }}">@Lang('site.products')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.add_product')</li>

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
                            <h3 class="card-title">@Lang('site.add_product')</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">

                                <form action="{{ route('dashboard.products.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('post') }}
                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.name')</label>
                                            <input type="text" name="{{ $locale }}[name]" class="form-control"
                                                value="{{ old($locale . '.name') }}">
                                            @error($locale . '.name')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <label>@lang('site.category_id')</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">@lang('site.category_id')</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>@Lang('site.quantity')</label>

                                        <input type="text" class="form-control" name="quantity"
                                            value="{{ old('quantity') }}">

                                        @error('quantity')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>@Lang('site.code')</label>

                                        <input type="text" class="form-control" name="code" value="{{ old('code') }}">

                                        @error('code')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.color')</label>
                                            <input type="text" name="{{ $locale }}[color]" class="color{{$index}}"
                                                value="{{ old($locale . '.color') }}">
                                            @error($locale . '.color')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <label>@Lang('site.size')</label>

                                        <input type="text" name="size" value="{{ old('size') }}">

                                        @error('size')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>@Lang('site.selling_price')</label>

                                        <input type="text" class="form-control" name="selling_price"
                                            value="{{ old('selling_price') }}">

                                        @error('selling_price')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>@Lang('site.discount_price')</label>

                                        <input type="text" class="form-control" name="discount_price"
                                            value="{{ old('discount_price') }}">

                                        @error('discount_price')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>
 
                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.description')</label>
                                            <textarea name="{{ $locale }}[description]" rows="3"
                                                class="form-control">{{ old($locale . '.description') }}</textarea>
                                            @error($locale . '.description')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <label for="customFile">@Lang('site.images')</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="images[]" multiple="multiple"
                                                id="customFile">
                                            <label class="custom-file-label" for="customFile">@Lang('site.choose')</label>
                                        </div>
                                        @error('images')
                                            <div class="text-danger text-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div id="images_upload">

                                    </div>
                                    <!-- end #images_upload -->
 
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


    @push('scripts')

        <script src="{{ asset('dashboardAssets/plugins/tagify/dist/tagify.js') }}"></script>


        <script>
            var color = document.querySelector('input[class=color0]');

            new Tagify(color);

            var color2 = document.querySelector('input[class=color1]');

            new Tagify(color2);

            var size = document.querySelector('input[name=size]');

            new Tagify(size);

            

            var fileCollection = new Array();
            $('#customFile').on('change', function(e) {
                var files = e.target.files;
                $.each(files, function(i, file) {
                    fileCollection.push(file);
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function(e) {
                        var template = '<img src="' + e.target.result +
                            '" style="width: 150px" class="img-thumbnail" alt="">';
                        $('#images_upload').append(template);
                    };
                });
            });
        </script>

    @endpush

@endsection
