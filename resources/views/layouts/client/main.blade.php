<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="language" content="{{ app()->getLocale() }}" />
    <meta name="keywords" content="{{ $metaKey ?? '' }}">
    <meta name="description" content="{{ $metaDesc ?? '' }}">

    <!-- OPENNGRAPH META TAGS FOR SOCIAL SHARING -->
    <meta property="og:title" content="{{ $data['ogMeta']['title'] ?? ($title ?? config('app.name')) }}" />
    <meta property="og:description" content="{{ $data['ogMeta']['description'] ?? ($metaDesc ?? '') }}" />
    <meta property="og:image" content="{{ $data['ogMeta']['image'] ?? url('asset/images/favicon.png') }}" />
    <meta property="og:url" content="{{ $data['ogMeta']['url'] ?? url()->current() }}" />
    <meta property="og:type" content="{{ $data['ogMeta']['type'] ?? 'website' }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $data['ogMeta']['title'] ?? ($title ?? config('app.name')) }}" />
    <meta name="twitter:description" content="{{ $data['ogMeta']['description'] ?? ($metaDesc ?? '') }}" />
    <meta name="twitter:image" content="{{ $data['ogMeta']['image'] ?? url('asset/images/favicon.png') }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('asset/images/favicon.png') }}" />

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://hm.baidu.com">

    <!-- CRITICAL CSS Inline (above-the-fold) -->
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.6;
        }
        .home-slider {
            min-height: 100vh;
            position: relative;
            background: transparent;
        }
        .kawasan-slider {
            position: relative;
        }
        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        .carousel-item {
            position: relative;
            display: none;
            width: 100%;
        }
        .carousel-item.active {
            display: block;
        }
        img, video {
            max-width: 100%;
            height: auto;
            display: block;
        }
    </style>

    <!-- ======================================================= -->
    <!-- CRITICAL CSS - Load synchronously (blocking)            -->
    <!-- Semua yang mempengaruhi tampilan awal/layout utama      -->
    <!-- ======================================================= -->
    <link rel="stylesheet" href="{{ asset('asset/js/bootstrap-4.0.0/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/backend/css/style.default.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/media.styles.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/creative/creative.css') }}?ver=1.0.32">
    <link rel="stylesheet" href="{{ asset('asset/css/creative/creativeresponsive.css') }}?ver=1.0.25">

    <!-- ======================================================= -->
    <!-- NON-CRITICAL CSS - Defer (tidak mempengaruhi layout awal) -->
    <!-- ======================================================= -->

    <!-- Google Fonts -->
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;700&display=swap"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;700&display=swap">
    </noscript>

    <!-- Font Awesome -->
    <link rel="preload" as="style"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </noscript>

    <!-- Animate.css (hanya untuk animasi, bukan layout) -->
    <link rel="preload" as="style" href="{{ asset('asset/css/animate.css') }}"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('asset/css/animate.css') }}">
    </noscript>

    <!-- Owl Carousel CSS (hanya aktif saat slider digunakan) -->
    <link rel="preload" as="style"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    </noscript>

    <!-- Swiper CSS -->
    <link rel="preload" as="style" href="{{ asset('asset/css/cdn/swiper.css') }}"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('asset/css/cdn/swiper.css') }}">
    </noscript>

    @stack('css')

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M3XXNCV');
    </script>

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
        gtag('config', 'G-9JZLPMYER5');
    </script>

    {!! $google_tools_webmaster ?? '' !!}
    {!! $google_tools_analytic ?? '' !!}

    @if (!empty($purechat_status) && $purechat_status == '1')
        {!! $purechat_code ?? '' !!}
    @endif
</head>

<body>
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3XXNCV"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>

    @include('layouts.client.partials.header')
    @yield('content')
    @include('layouts.client.partials.footerv2')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @vite('resources/js/app.js')

    @stack('js')
</body>

</html>