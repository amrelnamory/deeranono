    <!-- header start -->
    <header>
        <div class="mobile-fix-option"></div>

        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-contact">
                            <ul>
                                <li>
                                    @if (app()->getLocale() == 'ar')
                                        {{ config('global.settings')->welcome_message_ar }}
                                    @else
                                        {{ config('global.settings')->welcome_message_en }}
                                    @endif

                                </li>
                                <li>
                                    <i class="fa fa-mobile-phone" style="font-size: 20px"
                                        aria-hidden="true"></i>{{ config('global.settings')->phone }}
                                </li>

                            </ul>


                        </div>
                    </div>
                    <div class="col-lg-6 text-end">
                        <ul class="header-dropdown">

                            <li><a href="{{ config('global.settings')->facebook }}"><i class="fa fa-facebook"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="{{ config('global.settings')->instagram }}"><i class="fa fa-instagram"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="{{ config('global.settings')->pinterest }}"><i class="fa fa-pinterest"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="{{ config('global.settings')->youtube }}"><i class="fa fa-youtube-play"
                                        aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo">
                                <a href="{{ route('website.index') }}"><img
                                        src="{{ config('global.settings')->logo_path }}"
                                        class="img-fluid blur-up lazyload" alt="" width="100"></a>
                            </div>
                        </div>
                        <div class="menu-right pull-right">
                            <div>
                                <nav id="main-nav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                        <li>
                                            <div class="mobile-back text-end">@lang('site.back')
                                                @if (app()->getLocale() == 'ar')
                                                    <i class="fa fa-angle-left pe-2" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                                                @endif
                                            </div>
                                        </li>
                                        <li><a href="{{ route('website.index') }}"
                                                class="{{ Route::currentRouteNamed('website.index') ? 'active' : '' }}">@lang('site.home')</a>
                                        </li>

                                        @foreach (config('global.categories') as $category)
                                            <li>
                                                <a class="{{ Request::is('*/products/' . $category->id) ? 'active' : '' }}"
                                                    href="{{ route('website.subCategory', $category->id) }}">{{ $category->name }}</a>
                                                @if ($category->parents->count())
                                                    <ul>
                                                        @foreach ($category->parents as $item)
                                                            <li><a class="{{ Request::is('*/products/' . $item->id) ? 'active' : '' }}"
                                                                    href="{{ route('website.subCategory', $item->id) }}">{{ $item->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach

                                        <li>
                                            <a class="{{ Route::currentRouteNamed('website.articles') ? 'active' : '' }} {{ Route::currentRouteNamed('website.singleArticle') ? 'active' : '' }}"
                                                href="{{ route('website.articles') }}">@lang('site.articles')</a>
                                        </li>

                                        <li>
                                            <a class="{{ Route::currentRouteNamed('website.contactUs') ? 'active' : '' }}"
                                                href="{{ route('website.contactUs') }}">@lang('site.contact_us')</a>
                                        </li>

                                        <li>

                                            @if (app()->getLocale() == 'ar')
                                                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">EN</a>
                                            @else
                                                <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">AR</a>
                                            @endif

                                        </li>

                                    </ul>
                                </nav>
                            </div>
                            <div>
                                <div class="icon-nav">
                                    <ul>
                                        <li class="onhover-div mobile-search">
                                            <div><img src="{{ asset('siteAssets/images/icon/search.png') }}"
                                                    onclick="openSearch()" class="img-fluid blur-up lazyloaded" alt="">
                                                <i class="ti-search" onclick="openSearch()"></i>
                                            </div>
                                            <div id="search-overlay" class="search-overlay" style="display: none;">
                                                <div>
                                                    <span class="closebtn" onclick="closeSearch()"
                                                        title="Close Overlay">×</span>
                                                    <div class="overlay-content">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <form action="#">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control"
                                                                                id="exampleInputPassword1"
                                                                                placeholder="Search a Product">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary"><i
                                                                                class="fa fa-search"></i></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="onhover-div mobile-setting">
                                            <div><img src="{{ asset('siteAssets/images/icon/setting.png') }}"
                                                    class="img-fluid blur-up lazyloaded" alt="">
                                                <i class="ti-settings"></i>
                                            </div>
                                            <div class="show-div setting">
                                                <h6>@lang('site.language')</h6>
                                                <ul>
                                                    <li>

                                                        @if (app()->getLocale() == 'ar')
                                                            <a
                                                                href="{{ LaravelLocalization::getLocalizedURL('en') }}">EN</a>
                                                        @else
                                                            <a
                                                                href="{{ LaravelLocalization::getLocalizedURL('ar') }}">AR</a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="onhover-div mobile-cart">
                                            <div><img src="{{ asset('siteAssets/images/icon/cart.png') }}"
                                                    class="img-fluid blur-up lazyloaded" alt="">
                                                <i class="ti-shopping-cart"></i>
                                            </div>

                                            @livewire('website.cart.cart-counter')

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
