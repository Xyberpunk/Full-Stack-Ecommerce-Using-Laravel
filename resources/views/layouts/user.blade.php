<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title ?? 'Rural - T-Shirt Store' }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="auth-user-id" content="{{ auth()->id() ?? '' }}">
    <meta name="keywords" content="tshirt store ecommerce html website templates">
    <meta name="description" content="Rural is a T-Shirt Store HTML Website Template">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}?v={{ filemtime(public_path('assets/css/bootstrap.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}?v={{ filemtime(public_path('assets/vendor/swiper/swiper-bundle.min.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}?v={{ filemtime(public_path('assets/fonts/fonts.css')) }}">
    @stack('styles')
</head>
<body @yield('body_attributes')>
    @yield('content')

    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}?v={{ filemtime(public_path('assets/js/jquery-1.11.0.min.js')) }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}?v={{ filemtime(public_path('assets/vendor/swiper/swiper-bundle.min.js')) }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}?v={{ filemtime(public_path('assets/js/bootstrap.bundle.min.js')) }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins.js') }}?v={{ filemtime(public_path('assets/js/plugins.js')) }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}?v={{ filemtime(public_path('assets/js/script.js')) }}"></script>
    @stack('scripts')
</body>
</html>
