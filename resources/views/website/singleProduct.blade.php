@extends('layouts.website.app')

@section('title', $product->name)

@push('css')
    @livewireStyles
@endpush

@section('content')


    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{ $product->name }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.index') }}">@lang('site.home')</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('website.products') }}">@lang('site.products')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- section start -->
    <section>
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-xs-12">
                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="slider-right-nav">
                                    @foreach (json_decode($product->images, true) as $image)
                                        <div><img src="{{ $product->image_path . '/' . $image }}" alt=""
                                                class="img-fluid blur-up lazyload"></div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-10 col-xs-12 order-up">
                        <div class="product-right-slick">
                            @foreach (json_decode($product->images, true) as $image)
                                <div><img src="{{ $product->image_path . '/' . $image }}" alt=""
                                        class="img-fluid blur-up lazyload image_zoom_cls-0"></div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">

                            <h2>{{ $product->name }}</h2>
                            @if ($product->discount_price)
                                <h3 class="price-detail">{{ number_format($product->discount_price, 2) }}
                                    @lang('site.currency') <del>{{ number_format($product->selling_price, 2) }}
                                        @lang('site.currency')</del>&nbsp; <span>{{ $product->discount_percent }}
                                        @lang('site.sale')</span></h3>

                            @else
                                <h3 class="price-detail">{{ number_format($product->selling_price, 2) }}
                                    @lang('site.currency')</h3>

                            @endif

                            @livewire('website.product.index', ['product' => $product], key($product->id))


                            @if ($product->description != null)
                                <div class="border-product">
                                    <h6 class="product-title">@lang('site.product_decription')</h6>
                                    <p>{{ $product->description }}</p>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->



    <!-- product section start -->
    <section class="section-b-space ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>@lang('site.related_products')</h2>
                </div>
            </div>
            <div class="row search-product">

                @foreach ($related_products as $related)
                    @php
                        $image = json_decode($related->images, true);
                    @endphp
                    <div class="col-xl-2 col-md-4 col-6">
                        <div class="product-box">
                            <div class="img-wrapper">
                                @if ($related->discount_price)
                                    <div class="lable-block">
                                        <span class="lable3">{{ $related->discount_percent }}</span>
                                        <span class="lable4">@lang('site.on_sale')</span>
                                    </div>
                                @endif
                                <div class="front">
                                    <a href="{{ route('website.singleProduct', $related->id) }}"><img
                                            src="{{ $product->image_path . '/' . $image[0] }}"
                                            class="img-fluid blur-up lazyload bg-img" alt="{{ $related->name }}"></a>
                                </div>
                                <div class="back">
                                    <a href="{{ route('website.singleProduct', $related->id) }}"><img
                                            src="{{ $product->image_path . '/' . $image[1] }}"
                                            class="img-fluid blur-up lazyload bg-img" alt="{{ $related->name }}"></a>
                                </div>

                            </div>
                            <div class="product-detail">

                                <a href="{{ route('website.singleProduct', $related->id) }}">
                                    <h6>{{ $related->name }}</h6>
                                </a>
                                @if ($related->discount_price)
                                    <h4>{{ number_format($related->discount_price, 2) }}
                                        @lang('site.currency')

                                        <del>{{ number_format($related->selling_price, 2) }}
                                            @lang('site.currency')</del>
                                    </h4>
                                @else
                                    <h4>{{ number_format($related->selling_price, 2) }}
                                        @lang('site.currency')</h4>
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- product section end -->

    {{-- @push('scripts')
        <script src="{{ asset('siteAssets/js/jquery.elevatezoom.js') }}"></script>
    @endpush --}}

    @push('scripts')
        @livewireScripts

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            window.addEventListener('alert', ({
                detail: {
                    type,
                    message
                }
            }) => {
                Toast.fire({
                    icon: type,
                    title: message
                })
            })
        </script>
    @endpush

@endsection
