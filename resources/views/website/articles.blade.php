@extends('layouts.website.app')

@section('title', __('site.articles'))

@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{ __('site.articles') }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.index') }}">@lang('site.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.articles') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- Articles -->


    <section class="blog ratio2_3 pb-5 section-t-space">
        <div class="container">
            <div class="row">
                @foreach ($articles as $article)
                    @php
                        $image = json_decode($article->images, true);
                    @endphp

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('website.singleArticle', $article->slug) }}">
                            <div class="classic-effect">
                                <div>
                                    <img src="{{ $article->image_path . '/' . $image[0] }}"
                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                </div>
                                <span></span>
                            </div>
                        </a>
                        <div class="blog-details">
                            <h4>{{ \Carbon\Carbon::Parse($article->created_at)->isoFormat('DD-MMMM-YYYY') }}</h4>
                            <a href="{{ route('website.singleArticle', $article->id) }}">
                                <p>{{ $article->title }}</p>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End of Articles -->


@endsection
