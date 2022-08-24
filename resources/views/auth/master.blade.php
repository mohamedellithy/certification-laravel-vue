<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ Config::get('app.name') }} | @yield('title','تسجيل الدحول')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('asset/vendors/feather/feather.css' ) }}">
    <link rel="stylesheet" href="{{ asset('asset/vendors/mdi/css/materialdesignicons.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('asset/vendors/ti-icons/css/themify-icons.css' ) }}">
    <link rel="stylesheet" href="{{ asset('asset/vendors/typicons/typicons.css' ) }}">
    <link rel="stylesheet" href="{{ asset('asset/vendors/simple-line-icons/css/simple-line-icons.css' ) }}">
    <link rel="stylesheet" href="{{ asset('asset/vendors/css/vendor.bundle.base.css' ) }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('asset/vendors/datatables.net-bs4/dataTables.bootstrap4.css' ) }}">
    <link rel="stylesheet" href="{{ asset('asset/js/select.dataTables.min.css' ) }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:700|Roboto:400,400i,700&display=swap" rel="stylesheet">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('asset/css/vertical-layout-light/style.css' ) }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('asset/images/favicon.png') }}" />
    <link id="theme-style" rel="stylesheet" href="{{ asset('font.css') }}">
    <!-- add styles  css -->
    @stack('header_styles')
    <!-- add scripts js -->
    @stack('header_scripts')
</head>

<body>
    <div class="container-scroller">
        @yield('content_page')
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('asset/vendors/js/vendor.bundle.base.js') }} "></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('asset/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }} "></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('asset/js/off-canvas.js') }} "></script>
    <script src="{{ asset('asset/js/hoverable-collapse.js') }} "></script>
    <script src="{{ asset('asset/js/template.js') }} "></script>
    <script src="{{ asset('asset/js/settings.js') }} "></script>
    <script src="{{ asset('asset/js/todolist.js') }} "></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('asset/js/jquery.cookie.js') }} " type="text/javascript"></script>
    <script src="{{ asset('asset/js/dashboard.js') }} "></script>
    <!-- End custom js for this page-->
    <!-- add styles  css -->
    @stack('footer_styles')
    <!-- add scripts js -->
    @stack('footer_scripts')
    <script>
        window.default_locale = "{{ config('app.lang') }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
    </script>
</body>

</html>
