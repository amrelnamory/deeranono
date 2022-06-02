@extends('layouts.website.app')

@section('title', __('site.check_out'))

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
                        <h2>{{ __('site.check_out') }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.index') }}">@lang('site.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.check_out') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="checkout-page">
                <div class="checkout-form">
                    @if (\Cart::count() > 0)
                        <form>
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="checkout-title">
                                        <h3>@lang('site.order_details')</h3>
                                    </div>
                                    @livewire('website.cart.checkout')
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="checkout-details">
                                        <div class="order-box">
                                            <div class="title-box">
                                                <div>@lang('site.product') <span>@lang('site.subtotal')</span></div>
                                            </div>
                                            <ul class="qty">
                                                @foreach ($cart as $item)
                                                    <li>{{ $item->name }} <span>{{ $item->price }} &times;
                                                            {{ $item->qty }} =
                                                            {{ number_format($item->price * $item->qty, 2) }}
                                                            @lang('site.currency')</span></li>

                                                @endforeach
                                            </ul>

                                            <ul class="total">
                                                <li>@lang('site.subtotal')
                                                    <span class="count">{{ number_format(\Cart::subtotal(), 2) }}
                                                        @lang('site.currency')</span>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning">@lang('site.cart_empty')</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->


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
