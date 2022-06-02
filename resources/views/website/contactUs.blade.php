@extends('layouts.website.app')

@section('title', __('site.contact_us'))

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
                        <h2>{{ __('site.contact_us') }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.index') }}">@lang('site.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.contact_us') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!--section start-->
    <section class="contact-page section-b-space">
        <div class="container">
            <div class="row section-b-space">
                <div class="col-lg-5">
                    <div class="contact-right">
                        <ul>
                            <li>
                                <div class="contact-icon"><img src="{{ asset('siteAssets/images/icon/phone.png') }}"
                                        alt="Generic placeholder image">
                                    <h6>@lang('site.contact_us')</h6>
                                </div>
                                <div class="media-body">
                                    <p>{{ config('global.settings')->phone }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <h6>@lang('site.address')</h6>
                                </div>
                                <div class="media-body">
                                    @if (app()->getLocale() == 'ar')
                                        <p>{{ config('global.settings')->address_ar }}</p>
                                    @else
                                        <p>{{ config('global.settings')->address_en }}</p>
                                    @endif
                                </div>
                            </li>

                            <li>
                                <div class="contact-icon"><i class="fa fa-fax" aria-hidden="true"></i>
                                    <h6>@lang('site.email')</h6>
                                </div>
                                <div class="media-body">
                                    <p>{{ config('global.settings')->email }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7">
                    <form class="theme-form">
                        @livewire('website.contact.index')
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!--Section ends-->


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
