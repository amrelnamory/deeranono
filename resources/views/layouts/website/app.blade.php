<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{ config('global.settings')->favicon_path }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ config('global.settings')->favicon_path }}" type="image/x-icon">

    @if (app()->getLocale() == 'ar')
        <title>{{ config('global.settings')->site_title_ar }} | @yield('title')</title>
    @else
        <title>{{ config('global.settings')->site_title_en }} | @yield('title')</title>
    @endif

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('siteAssets/css/vendors/fontawesome.css') }}">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('siteAssets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('siteAssets/css/vendors/slick-theme.css') }}">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('siteAssets/css/vendors/animate.css') }}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('siteAssets/css/vendors/themify-icons.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('siteAssets/css/vendors/bootstrap.css') }}">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('siteAssets/css/style.css') }}">

    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('siteAssets/css/custom.css') }}">

    @stack('css')


</head>

<body class="theme-color-24 {{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">

    @include('layouts.website.includes.header')

    @yield('content')

    @include('layouts.website.includes.footer')

    <div id="WAButton"></div>

    <!-- tap to top -->
    <div class="tap-top top-cls">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top end -->


    <!-- latest jquery-->
    <script src="{{ asset('siteAssets/js/jquery-3.3.1.min.js') }}"></script>

    <!-- fly cart ui jquery-->
    <script src="{{ asset('siteAssets/js/jquery-ui.min.js') }}"></script>

    <!-- exitintent jquery-->
    <script src="{{ asset('siteAssets/js/jquery.exitintent.js') }}"></script>
    <script src="{{ asset('siteAssets/js/exit.js') }}"></script>

    <!-- slick js-->
    <script src="{{ asset('siteAssets/js/slick.js') }}"></script>

    <!-- menu js-->
    <script src="{{ asset('siteAssets/js/menu.js') }}"></script>

    <!-- lazyload js-->
    <script src="{{ asset('siteAssets/js/lazysizes.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('siteAssets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Bootstrap Notification js-->
    <script src="{{ asset('siteAssets/js/bootstrap-notify.min.js') }}"></script>

    <!-- Fly cart js-->
    <script src="{{ asset('siteAssets/js/fly-cart.js') }}"></script>

    <!-- Whatsapp js-->
    <script src="{{ asset('siteAssets/js/whatsapp.js') }}"></script>

    <!-- Theme js-->
    <script src="{{ asset('siteAssets/js/script.js') }}"></script>

    <script>
        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>

    @if (app()->getLocale() == 'ar')
        <script type="text/javascript">
            var num = "{{ config('global.settings')->whatsapp }}";
            // WhatsApp
            $(function() {
                $('#WAButton').floatingWhatsApp({
                    phone: num,
                    headerTitle: 'راسلنا على واتس اب',
                    popupMessage: 'مرحبأ، كيف يمكننا مساعدتك ؟',
                    showPopup: true,
                    buttonImage: '<img src=https://www.deeranono.com/siteAssets/svg/whatsapp.svg />',
                    position: "right",
                    zIndex: '99999999999999',
                    size: '50'
                });
            });
        </script>
    @else
        <script type="text/javascript">
            var num = "{{ config('global.settings')->whatsapp }}";
            // WhatsApp
            $(function() {
                $('#WAButton').floatingWhatsApp({
                    phone: num,
                    headerTitle: 'Contact Us on Whatsapp',
                    popupMessage: 'Hello, How can we help you ?',
                    showPopup: true,
                    buttonImage: '<img src=https://www.deeranono.com/siteAssets/svg/whatsapp.svg />',
                    position: "left",
                    zIndex: '99999999999999',
                    size: '50'
                });
            });
        </script>
    @endif

    @stack('scripts')
</body>

</html>
