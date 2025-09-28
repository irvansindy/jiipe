<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'JIIPE - Java Integrated Industrial and Port Estate')</title>
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-M3XXNCV');</script>
    <!-- End Google Tag Manager -->
    
    <!-- CSS Files -->
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/slick.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/creative.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3XXNCV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    @include('partials.header')
    
    @yield('content')
    
    @include('partials.footer')
    
    <!-- Back to Top -->
    <a href="#" class="back-to-top" style="display: inline;"><i class="fa fa-chevron-up"></i></a>
    
    <!-- WhatsApp Button -->
    <a href="https://wa.me/6281388000168?text=I+would+like+to+know+more+about+JIIPE" target="_blank" class="d-none btn-whatsapp-pulse btn-whatsapp-pulse-border">
        <i class="fab fa-whatsapp"></i>
    </a>
    
    <!-- Scripts -->
    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('asset/js/owlslider/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('asset/js/creative.js?ver=1.0.5') }}"></script>
    
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-447682676"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-447682676');
    </script>
    
    @stack('scripts')
</body>
</html>