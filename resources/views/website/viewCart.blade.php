@extends('layouts.website.app')

@section('title', __('site.cart'))

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
                        <h2>{{ __('site.cart') }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.index') }}">@lang('site.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.cart') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!--section start-->
    <section class="cart-section section-b-space">
        <div class="container">
            <div class="row">

                @livewire('website.cart.index')

            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="{{ route('website.products') }}"
                        class="btn btn-solid">@lang('site.continue_shopping')</a></div>
                @if (\Cart::count() > 0)
                    <div class="col-6"><a href="{{ route('website.completeOrder') }}"
                            class="btn btn-solid">@lang('site.check_out')</a></div>
                @endif
            </div>
        </div>
    </section>
    <!--section end-->

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
