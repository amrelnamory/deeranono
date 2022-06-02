@extends('layouts.website.app')

@section('title')
    {{ __('site.articles') }} | {{ $article->title }}
@endsection

@section('content')


    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{ $article->title }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.index') }}">@lang('site.home')</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('website.articles') }}">@lang('site.articles')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!--section start-->
    <section class="blog-detail-page section-b-space ratio2_3">
        <div class="container">
            <div class="row">

                <section class="p-0">
                    <div class="slide-1 home-slider">
                        @foreach (json_decode($article->images, true) as $image)
                            <div>
                                <div class="home text-center">
                                    <img src="{{ $article->image_path . '/' . $image }}" alt=""
                                        class="bg-img blur-up lazyload">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>


                <div class="col-sm-12 blog-detail"> 
                    <p>
                        {!! $article->description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

@endsection
