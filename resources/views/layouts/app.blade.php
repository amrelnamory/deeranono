<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('site.login') | @lang('site.management_program')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('dashboardAssets/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dashboardAssets/dist/css/adminlte.min.css')}}">

    @if (app()->getLocale() == "ar")
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="{{asset('dashboardAssets/dist/css/bootstrap-rtl.css')}}">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{asset('dashboardAssets/dist/css/custom-rtl.css')}}">
    @else
    <link rel="stylesheet"
        href="{{asset('dashboardAssets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Custom style for LTR -->
    <link rel="stylesheet" href="{{asset('dashboardAssets/dist/css/custom-ltr.css')}}">
    @endif
    
    <link rel="stylesheet" href="{{asset('dashboardAssets/dist/css/custom.css')}}">

</head>

<body class="hold-transition login-page">


    @yield('content')


    <footer class="main-footer m-0" style="position:fixed; bottom:0; width:100%;">
        
        جميع الحقوق محفوظة &copy; @php echo date('Y'); @endphp.
         
    </footer>
    <!-- ./wrapper -->
 

    <script src="{{asset('dashboardAssets/dist/js/keys.js')}}"></script>


</body>

</html>
