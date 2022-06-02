@extends('layouts.website.app')

@section('title', __('site.products'))

@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{ __('site.products') }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.index') }}">@lang('site.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.products') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- section start -->
    <section class="section-b-space ratio_asos">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 collection-filter">
                        <!-- side-bar colleps block stat -->
                        <div class="collection-filter-block">
                            <!-- brand filter start -->
                            <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
                                        aria-hidden="true"></i> back</span></div>
                            <div class="collection-collapse-block open">
                                <h3 class="collapse-block-title">@lang('site.categories')</h3>
                                <div class="collection-collapse-block-content mt-4">
                                    <div class="collection-brand-filter">

                                        <dl class="category-list">
                                            @foreach (config('global.categories') as $category)
                                                <dt class="mb-3 fs-5"><a href="{{route('website.subCategory', $category->id)}}">{{ $category->name }}</a></dt>

                                                @if ($category->parents->count())
                                                    @foreach ($category->parents as $item)
                                                        <dd class="fs-5">
                                                            <a href="{{route('website.subCategory', $item->id)}}">{{ $item->name }}</a>
                                                        </dd>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </dl>


                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="collection-product-wrapper">
                                        <div class="product-wrapper-grid">
                                            <div class="row margin-res">
                                                @foreach ($products as $product)
                                                    @php
                                                        $image = json_decode($product->images, true);
                                                    @endphp

                                                    <div class="col-xl-3 col-6 col-grid-box">
                                                        <div class="product-box">
                                                            <div class="img-wrapper">
                                                                @if ($product->discount_price)
                                                                    <div class="lable-block">
                                                                        <span
                                                                            class="lable3">{{ $product->discount_percent }}</span>
                                                                        <span
                                                                            class="lable4">@lang('site.on_sale')</span>
                                                                    </div>
                                                                @endif
                                                                <div class="front">
                                                                    <a href="{{route('website.singleProduct', $product->id)}}">
                                                                        <img src="{{ $product->image_path . '/' . $image[0] }}"
                                                                            class="img-fluid blur-up lazyload bg-img"
                                                                            alt="{{ $product->name }}"></a>
                                                                </div>
                                                                <div class="back">
                                                                    <a href="{{route('website.singleProduct', $product->id)}}">
                                                                        <img src="{{ $product->image_path . '/' . $image[1] }}"
                                                                            class="img-fluid blur-up lazyload bg-img"
                                                                            alt="{{ $product->name }}"></a>
                                                                </div>

                                                            </div>
                                                            <div class="product-detail">
                                                                <div>
                                                                    <a href="{{route('website.singleProduct', $product->id)}}">
                                                                        <h6>{{ $product->name }}</h6>
                                                                    </a>

                                                                    @if ($product->discount_price)
                                                                        <h4>{{ number_format($product->discount_price, 2) }}
                                                                            @lang('site.currency')

                                                                            <del>{{ number_format($product->selling_price, 2) }}
                                                                                @lang('site.currency')</del>
                                                                        </h4>
                                                                    @else
                                                                        <h4>{{ number_format($product->selling_price, 2) }}
                                                                            @lang('site.currency')</h4>
                                                                    @endif


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="product-pagination">
                                            <div class="theme-paggination-block">
                                                {{ $products->links('vendor.pagination.custom-pagination') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section End -->

@endsection
