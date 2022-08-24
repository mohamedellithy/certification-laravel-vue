<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl"> 
<head>
    <title>{{ Config::get('app.name') }} | @yield('title','الرئيسية')</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:700|Roboto:400,400i,700&display=swap" rel="stylesheet">
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('front/fontawesome/js/all.min.js') }}"></script>
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ asset('front/css/theme.css') }}">
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ Config('settings.client_code_google_adsense') ?? null }}" crossorigin="anonymous"></script> -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('font.css') }}">
    @stack('header_styles')
    @stack('header_scripts')
    <style>
        .site-logo{
            text-align: center;
        }
    </style>
</head>
<body>
   <!--//header-->
    @include('Front.layout.header')
    @include('Front.ads.left')
    @include('Front.ads.right')
    @yield('content')
    <!--//reviews-section-->
    @include('Front.ads.bottom')
    @include('Front.layout.footer')
    <!-- Javascript -->          
    <script src="{{ asset('front/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('front/plugins/bootstrap/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('front/plugins/smoothscroll.min.js') }}"></script> 
    <script src="{{ asset('front/js/main.js') }}"></script>
    @stack('footer_styles')
    @stack('footer_scripts')
    <script>
        window.default_locale = "{{ config('app.lang') }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
    </script>
</body>
</html> 

