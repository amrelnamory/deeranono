<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">

        <span class="brand-text font-weight-light"> @lang('site.deeranono') </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->image_path }}" width="20" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color: #fff !important">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard.welcome') }}"
                        class="nav-link {{ Request::is('*/dashboard') ? 'active' : '' }}"> <i
                            class="nav-icon fas fa-home"></i>
                        <p>@Lang('site.home')</p>
                    </a>
                </li>

                @if (auth()->user()->hasPermission('read_categories'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.categories.index') }}"
                            class="nav-link {{ Route::currentRouteNamed('dashboard.categories.index') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.categories.create') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.categories.edit') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>@Lang('site.categories')</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read_products'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.products.index') }}"
                            class="nav-link {{ Route::currentRouteNamed('dashboard.products.index') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.products.create') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.products.edit') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.products.show') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tshirt"></i>
                            <p>@Lang('site.products')</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read_articles'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.articles.index') }}"
                            class="nav-link {{ Route::currentRouteNamed('dashboard.articles.index') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.articles.create') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.articles.edit') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.articles.show') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>@Lang('site.articles')</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read_slider'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.slides.index') }}"
                            class="nav-link {{ Route::currentRouteNamed('dashboard.slides.index') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.slides.create') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.slides.edit') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.slides.show') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-images"></i>
                            <p>@Lang('site.slides')</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read_brands'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.brands.index') }}"
                            class="nav-link {{ Route::currentRouteNamed('dashboard.brands.index') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.brands.create') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.brands.edit') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.brands.show') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>@Lang('site.brands')</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read_orders'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.orders.index') }}"
                            class="nav-link {{ Route::currentRouteNamed('dashboard.orders.index') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.orders.create') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.orders.edit') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.orders.show') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.orders.invoice') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>@Lang('site.orders')</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read_messages'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.messages.index') }}"
                            class="nav-link {{ Request::is('*/dashboard/messages*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>@Lang('site.messages')</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read_settings'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.settings.index') }}"
                            class="nav-link {{ Request::is('*/dashboard/settings*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>@Lang('site.settings')</p>
                        </a>
                    </li>
                @endif
  
                
                @if (auth()->user()->hasPermission('read_users'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.users.index') }}"
                            class="nav-link {{ Request::is('*/dashboard/users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>@Lang('site.users')</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
