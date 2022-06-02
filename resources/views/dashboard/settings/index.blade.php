@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.settings')
@endsection

@push('css')
    <style type="text/css">
        .settings-tab-opener {
            box-shadow: 0px 6px 12px #ebebeb;
            border-radius: 11px;
            cursor: pointer;
            width: 120px;
            height: 45px;
        }

        .settings-tab-opener.active {
            box-shadow: 0px 6px 12px #c8e0ff !important;
            color: #fff;
            background: #2196f3;
        }

        .taber:not(.active) {
            display: none;
        }

    </style>
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark mb-2">@Lang('site.settings')<span class="mr-3 btn btn-success"
                            style="cursor: default; font-weight: bold;">{{ $settings->count() }}</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.settings')</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="col-12 p-4" style="background: #fff" class="mb-3">
                <div class="row">
                    <div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener active"
                        data-opentab="general-tab">
                        عام
                    </div>

                    <div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener"
                        data-opentab="links-tab">
                        سوشيال ميديا
                    </div>

                    <div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener"
                        data-opentab="logos-tab">
                        اللوجو
                    </div>

                    <div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener"
                        data-opentab="images-tab">
                        صور
                    </div>

                </div>

                <form class="mt-4" method="POST"
                    action="{{ route('dashboard.settings.update', $settings->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="container">

                        <div class="row taber active" id="general-tab">
                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    اسم الموقع باللغة العربية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="site_title_ar" class="form-control"
                                        value="{{ $settings->site_title_ar }}" maxlength="190">
                                </div>
                            </div>
                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    اسم الموقع باللغة الانجليزية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="site_title_en" class="form-control"
                                        value="{{ $settings->site_title_en }}" maxlength="190">
                                </div>
                            </div>
                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    رسالة ترحيبية باللغة العربية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <textarea name="welcome_message_ar"
                                        class="form-control">{{ $settings->welcome_message_ar }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    رسالة ترحيبية باللغة الانجليزية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <textarea name="welcome_message_en"
                                        class="form-control">{{ $settings->welcome_message_en }}</textarea>
                                </div>
                            </div>

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    نبذة عن الموقع باللغة العربية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <textarea name="about_ar" class="form-control">{{ $settings->about_ar }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    نبذة عن الموقع باللغة الانجليزية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <textarea name="about_en" class="form-control">{{ $settings->about_en }}</textarea>
                                </div>
                            </div>

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    البريد الالكتروني
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="email" class="form-control" value="{{ $settings->email }}">
                                </div>
                            </div>

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    رقم الهاتف
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="phone" class="form-control" value="{{ $settings->phone }}"
                                        maxlength="190">
                                </div>
                            </div>

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    رقم واتس آب
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="whatsapp" class="form-control"
                                        value="{{ $settings->whatsapp }}">
                                </div>
                            </div>
                        </div>


                        <div class="row  taber" id="links-tab">

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    رابط فيس بوك
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="facebook" class="form-control"
                                        value="{{ $settings->facebook }}">
                                </div>
                            </div>
                            @error('facebook')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    رابط انستجرام
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="instagram" class="form-control"
                                        value="{{ $settings->instagram }}">
                                </div>
                            </div>
                            @error('instagram')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    رابط يوتيوب
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="youtube" class="form-control"
                                        value="{{ $settings->youtube }}">
                                </div>
                            </div>
                            @error('youtube')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    رابط بينتريست
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="pinterest" class="form-control"
                                        value="{{ $settings->pinterest }}">
                                </div>
                            </div>
                            @error('pinterest')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="row taber" id="logos-tab">

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    لوجو الموقع
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="file" name="logo" class="form-control image">
                                    <div class="col-12 p-2">
                                        <img src="{{ $settings->logo_path }}" class="img-thumbnail image-preview"
                                            width="150px">
                                    </div>
                                </div>
                            </div>
                            @error('logo')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    الصورة المصغرة
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="file" name="favicon" class="form-control image2">
                                    <div class="col-12 p-2">
                                        <img src="{{ $settings->favicon_path }}" class="img-thumbnail image-preview2"
                                            width="50px">
                                    </div>
                                </div>
                            </div>
                            @error('favicon')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row taber" id="images-tab">

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    صورة بجانب الأقسام
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="file" name="collection_image" class="form-control image3">
                                    <div class="col-12 p-2">
                                        <img src="{{ $settings->collection_path }}" class="img-thumbnail image-preview3"
                                            width="150px">
                                    </div>
                                </div>
                            </div>
                            @error('collection_image')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    صورة في منتصف الصفحة الرئيسية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="file" name="banner_image" class="form-control image4">
                                    <div class="col-12 p-2">
                                        <img src="{{ $settings->banner_path }}" class="img-thumbnail image-preview4"
                                            width="150px">
                                    </div>
                                </div>
                            </div>
                            @error('banner_image')
                                <div class="text-danger text-bold">{{ $message }}</div>
                            @enderror

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    عنوان الصورة باللغة العربية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="banner_title_ar" class="form-control"
                                        value="{{ $settings->banner_title_ar }}" maxlength="190">
                                </div>
                            </div>

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    عنوان الصورة باللغة الانجليزية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="banner_title_en" class="form-control"
                                        value="{{ $settings->banner_title_en }}" maxlength="190">
                                </div>
                            </div>

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    وصف الصورة باللغة العربية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="banner_description_ar" class="form-control"
                                        value="{{ $settings->banner_description_ar }}" maxlength="190">
                                </div>
                            </div>

                            <div class="col-12 px-0 d-flex mb-3 row pb-3">
                                <div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
                                    وصف الصورة باللغة الانجليزية
                                </div>
                                <div class="col-12 col-lg-9 px-2">
                                    <input type="text" name="banner_description_en" class="form-control"
                                        value="{{ $settings->banner_description_en }}" maxlength="190">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i>
                            @Lang('site.save')</button>
                    </div>
                </form>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @push('scripts')
        <script type="text/javascript">
            $('.settings-tab-opener').on('click', function() {
                $('.settings-tab-opener').removeClass('active');
                $(this).addClass('active');
                var open_id = $(this).attr('data-opentab');
                $('.taber').removeClass('active');
                $('.taber#' + open_id).addClass('active');
            });

            // Image Preview
            $(".image2").change(function() {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.image-preview2').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }

            });

            // Image Preview
            $(".image3").change(function() {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.image-preview3').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }

            });

            // Image Preview
            $(".image4").change(function() {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.image-preview4').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }

            });
        </script>
    @endpush

@endsection
