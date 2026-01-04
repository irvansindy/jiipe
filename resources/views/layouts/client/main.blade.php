{{-- filepath: resources/views/layouts/main.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="language" content="{{ app()->getLocale() }}" />
    <meta name="keywords" content="{{ $metaKey ?? '' }}">
    <meta name="description" content="{{ $metaDesc ?? '' }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('asset/images/favicon.png') }}" />

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Preconnect to external domains (CRITICAL for performance) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://use.fontawesome.com">

    {{-- Preload Critical Fonts only if files exist --}}
    {{-- Uncomment if you're hosting Font Awesome locally:
    <link rel="preload" href="{{ asset('asset/fonts/fontawesome/webfonts/fa-solid-900.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('asset/fonts/fontawesome/webfonts/fa-brands-400.woff2') }}" as="font" type="font/woff2" crossorigin>
    --}}

    <!-- Google Fonts - Combined (Roboto + Montserrat + Public Sans if needed) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;700&display=swap">

    <!-- Critical CSS - Load first -->
    <link rel="stylesheet" href="{{ asset('asset/backend/css/style.default.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/bootstrap-4.0.0/bootstrap.min.css') }}">

    <!-- Font Awesome - Use all.min.css only (single file) -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

    <!-- Other CSS -->
    <link rel="stylesheet" href="{{ asset('asset/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/media.styles.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/creative/creative.css') }}?ver=1.0.32">
    <link rel="stylesheet" href="{{ asset('asset/css/creative/creativeresponsive.css') }}?ver=1.0.25">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('asset/css/cdn/swiper.css') }}">

    @stack('css')

    <!-- Google Tag Manager (Keep in head for early tracking) -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M3XXNCV');
    </script>

    {{-- Google Analytics Dynamic ID --}}
    @php
        $n_id_ga = 'UA-162510558-2';
        if (app()->getLocale() == 'en') {
            $n_id_ga = 'UA-162510558-3';
        } elseif (app()->getLocale() == 'cn') {
            $n_id_ga = 'UA-162510558-4';
        } elseif (app()->getLocale() == 'tw') {
            $n_id_ga = 'UA-162510558-5';
        }
    @endphp

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $n_id_ga }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '{{ $n_id_ga }}');
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9JZLPMYER5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-9JZLPMYER5');
    </script>

    <!-- Baidu Tongji Tracking Code -->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?11d4567d21afc44b50922f500bef6a4c";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

    {{-- Google Webmaster & Analytics --}}
    {!! $google_tools_webmaster ?? '' !!}
    {!! $google_tools_analytic ?? '' !!}

    @if (!empty($purechat_status) && $purechat_status == '1')
        {!! $purechat_code ?? '' !!}
    @endif
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3XXNCV" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>

    @include('layouts.client.partials.header')
    @yield('content')
    @include('layouts.client.partials.footerv2')

    <!-- JavaScript - Load at bottom in specific order (no defer for compatibility) -->
    <!-- jQuery MUST load first -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>

    <!-- Popper.js (required by Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Slick -->
    <script src="{{ asset('asset/js/slick/slick.min.js') }}"></script>

    <!-- Swiper -->
    <script src="{{ asset('asset/js/cdn/swiper.js') }}"></script>

    <!-- Custom scripts (after all libraries loaded) -->
    @stack('js')
</body>

</html>