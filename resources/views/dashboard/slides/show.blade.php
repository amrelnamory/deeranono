@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.slides') | {{ $slide->title }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('dashboardAssets/plugins/ekko-lightbox/ekko-lightbox.css') }}">

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
                        <li class="breadcrumb-item active">{{ $slide->title }}</li>

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
                            <h3 class="card-title">{{ $slide->title }}</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">

                                <table class="table table-bordered text-center">
                                    <tbody>
                                        <tr>
                                            <th class="align-middle">@Lang('site.title')</th>
                                            <td class="align-middle">{{ $slide->title }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th class="align-middle">@Lang('site.description')</th>
                                            <td class="align-middle">{!! $slide->description !!}</td>
                                        </tr> 

                                        <tr>
                                            <th class="align-middle">@Lang('site.images')</th>
                                            <td class="align-middle">

                                                
                                                    <a href="{{ $slide->image_path }}"
                                                        data-toggle="lightbox">
                                                        <img src="{{ $slide->image_path }}"
                                                            style="width: 150px" class="img-thumbnail" alt="">
                                                    </a>
                                              

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

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
        <script src="{{ asset('dashboardAssets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

        <script>
            $(function() {
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });


            })
        </script>


    @endpush

@endsection
