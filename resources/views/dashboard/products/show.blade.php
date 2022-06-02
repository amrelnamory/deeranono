@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.products') | {{ $product->name }}
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
                    <h1 class="m-0 text-dark">@Lang('site.products')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.products.index') }}">@Lang('site.products')</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>

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
                            <h3 class="card-title">{{ $product->name }}</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">

                                <table class="table table-bordered text-center">
                                    <tbody>
                                        <tr>
                                            <th class="align-middle">@Lang('site.name')</th>
                                            <td class="align-middle">{{ $product->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.category_id')</th>
                                            <td class="align-middle">{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.code')</th>
                                            <td class="align-middle">{{ $product->code }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.quantity')</th>
                                            <td class="align-middle">{{ $product->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.selling_price')</th>
                                            <td class="align-middle">{{ number_format($product->selling_price, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.discount_price')</th>
                                            <td class="align-middle">{{ number_format($product->discount_price, 2) }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="align-middle">@Lang('site.discount')</th>
                                            <td class="align-middle">
                                                @if ($product->discount == 1)
                                                    <i class="fas fa-check-square text-success" style="font-size: 26px"></i>
                                                @else
                                                    <i class="fas fa-times-circle text-danger" style="font-size: 26px"></i>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="align-middle">@Lang('site.color')</th>
                                            <td class="align-middle">
                                                <ul>
                                                    @foreach (json_decode($product->color, true) as $key => $color)
                                                        <li> {{ $color['value'] }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.size')</th>
                                            <td class="align-middle">
                                                <ul>
                                                    @foreach (json_decode($product->size, true) as $key => $size)
                                                        <li> {{ $size['value'] }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="align-middle">@Lang('site.description')</th>
                                            <td class="align-middle">{{ $product->description }}</td>
                                        </tr>

                                        <tr>
                                            <th class="align-middle">@Lang('site.status')</th>
                                            <td class="align-middle">
                                                @if ($product->status == 1)
                                                    <span class="badge badge-success">@Lang('site.active')</span>
                                                @else
                                                    <span class="badge badge-danger">@Lang('site.in_active')</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="align-middle">@Lang('site.images')</th>
                                            <td class="align-middle">

                                                @foreach (json_decode($product->images, true) as $key => $image)
                                                    <a href="{{ $product->image_path . '/' . $image }}"
                                                        data-toggle="lightbox">
                                                        <img src="{{ $product->image_path . '/' . $image }}"
                                                            style="width: 150px" class="img-thumbnail" alt="">
                                                    </a>
                                                @endforeach

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
