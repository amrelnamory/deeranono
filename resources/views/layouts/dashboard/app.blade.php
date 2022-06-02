<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | @lang('site.dashboard')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('dashboardAssets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('dashboardAssets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('dashboardAssets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">


    <!--Noty-->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/dist/css/noty.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboardAssets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('dashboardAssets/plugins/datatables-buttons/css/buttons.bootstrap4.css') }}">

    @notifyCss

    <style>
        .small-box .inner h4 {
            margin: 15px 0;
        }

        .small-box .inner h4 a {
            background: #B4B4B4;
            color: #fff !important;
            padding: 3px 10px
        }

    </style>

    @if (app()->getLocale() == 'ar')
        <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" href="{{ asset('dashboardAssets/dist/css/bootstrap-rtl.css') }}">
        <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{{ asset('dashboardAssets/dist/css/custom-rtl.css') }}">
    @else
        <link rel="stylesheet"
            href="{{ asset('dashboardAssets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- Custom style for LTR -->
        <link rel="stylesheet" href="{{ asset('dashboardAssets/dist/css/custom-ltr.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('dashboardAssets/dist/css/custom.css') }}">

    @stack('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('notify::components.notify')

        @include('layouts.dashboard.includes.navbar')

        @include('layouts.dashboard.includes.aside')

        <div class="content-wrapper">

            @yield('content')

        </div>

        <footer class="main-footer">
            جميع الحقوق محفوظة &copy; @php echo date('Y'); @endphp.

        </footer>
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('dashboardAssets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboardAssets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboardAssets/plugins/moment/moment.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('dashboardAssets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('dashboardAssets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Select2 -->
    <script src="{{ asset('dashboardAssets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Jquery Number -->
    <script src="{{ asset('dashboardAssets/dist/js/jquery.number.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('dashboardAssets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dashboardAssets/dist/js/adminlte.js') }}"></script>
    <!--Noty-->
    <script src="{{ asset('dashboardAssets/dist/js/noty.js') }}"></script>
    @include('layouts.dashboard.includes.sessions')
    <!-- DataTables -->
    <script src="{{ asset('dashboardAssets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboardAssets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('dashboardAssets/dist/js/keys.js') }}"></script>
    <script src="{{ asset('dashboardAssets/dist/js/custom.js') }}"></script>

    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('dashboardAssets/dist/js/pages/welcome.js') }}"></script>
    @else
        <script src="{{ asset('dashboardAssets/dist/js/pages/welcome-ltr.js') }}"></script>
    @endif

    @notifyJs

    <script>
        // Select 2
        $('.select2').select2({
            theme: 'bootstrap4'
        });


        // Image Preview
        $(".image").change(function() {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

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

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>

    {{-- <script>
    setInterval(function() {
        $("#notifications_count").load(window.location.href + " #notifications_count");
        $("#notyCount").load(window.location.href + " #notyCount");
        $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
    }, 2000);

</script> --}}

    @stack('scripts')

</body>

</html>
