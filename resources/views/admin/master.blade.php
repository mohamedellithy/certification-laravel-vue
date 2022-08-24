<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ Config::get('app.name') }} | @yield('title','لوحة التحكم')</title>
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
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('asset/css/vertical-layout-light/style.css' ) }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('asset/images/favicon.png') }}" />

    <!-- add styles  css -->
    @stack('header_styles')
    <!-- add scripts js -->
    @stack('header_scripts')
    <link id="theme-style" rel="stylesheet" href="{{ asset('font.css') }}">
    <style>
        textarea {
            resize: vertical;
        }
        .btn-toggle-nav li textarea.form-control-lg{
            max-height: auto !important;
            height: auto !important;
            min-height: auto !important;
        }
        .ms-auto {
            margin-right: auto !important;
            margin-left: 0px !important;
        }
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .navbar-dropdown{
            right: -137px;
        }
        .sidebar .nav .nav-item .nav-link i.menu-icon {
            margin: 10px;
        }
        .sidebar .nav .nav-item .nav-link{
            padding: 10px 8px 10px 35px;
            color:#1F3BB3;
        }
        .sidebar .collapse .nav  .nav-item{
            margin: 0px 16px;
        }
        .toggle-btn-sidebar{
            padding: 0px 10px;
        }
        .statistics-details {
            padding: 10px 40px;
        }
        .sidebar ,
        .navbar .navbar-brand-wrapper{
            background-color: white;
        }
        .sidebar .nav .nav-item .nav-link .menu-title ,
        .sidebar .nav .nav-item.active > .nav-link .menu-title{
            font-size: 16px;
        }
        .sidebar .nav .nav-item .nav-link i{
            font-size: 14px;
        }
        .navbar .navbar-brand-wrapper .navbar-brand img{
            height: 80px;
        }
        .form-group label{
            font-weight: bold !important;
        }
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .navbar-dropdown .dropdown-item i {
            font-size: 16px;
            padding: 6px 6px;
        }
    </style>
</head>

<body >
    <div class="container-scroller" >
        <!-- partial:partials/_banner -->
        <!-- @include('admin.layout.banner') -->

        <!-- partial:partials/_navbar -->
        @include('admin.layout.header')

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            @include('admin.layout.setting')

            <!-- partial:partials/right-sidebar.html -->
            @include('admin.layout.right-sidebar')

            <!-- partial:partials/_sidebar.html -->
            @include('admin.layout.sidebar')

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="statistics-title">New Sessions</p>
                                            <h3 class="rate-percentage">68.8</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <p class="statistics-title">Avg. Time on Site</p>
                                            <h3 class="rate-percentage">2m:35s</h3>
                                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <p class="statistics-title">New Sessions</p>
                                            <h3 class="rate-percentage">68.8</h3>
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <p class="statistics-title">Avg. Time on Site</p>
                                            <h3 class="rate-percentage">2m:35s</h3>
                                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @yield('content_page')
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('admin.layout.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('asset/vendors/js/vendor.bundle.base.js') }} "></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('asset/vendors/chart.js/Chart.min.js') }} "></script>
    <script src="{{ asset('asset/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }} "></script>
    <script src="{{ asset('asset/vendors/progressbar.js/progressbar.min.js') }} "></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:700|Roboto:400,400i,700&display=swap" rel="stylesheet">

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
    <script src="{{ asset('asset/js/Chart.roundedBarCharts.js') }} "></script>
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
