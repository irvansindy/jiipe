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

    <link rel="Shortcut Icon" href="{{ asset('asset/images/favicon.png') }}" />
    <link rel="icon" type="image/ico" href="{{ asset('asset/images/favicon.png') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('asset/backend/css/style.default.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('asset/js/bootstrap-4.0.0/bootstrap.min.css') }}">
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Google Tag Manager -->
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
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M3XXNCV');
    </script>
    <!-- End Google Tag Manager -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous">
    </script>

    <!-- jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
        integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

    <!-- STYLE -->
    <link rel="stylesheet" href="{{ asset('asset/css/styles.css') }}">

    <!-- RESPONSIVE DEVICE -->
    <link rel="stylesheet" href="{{ asset('asset/css/media.styles.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('asset/css/creative/creative.css') }}?ver=1.0.32">
    <link rel="stylesheet" href="{{ asset('asset/css/creative/creativeresponsive.css') }}?ver=1.0.25">
    <link rel="stylesheet" href="{{ asset('asset/js/slick/slick.min.js') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/cdn/swiper.css') }}">

    @stack('css')
    {{-- Google Webmaster & Analytics --}}
    {!! $google_tools_webmaster ?? '' !!}
    {!! $google_tools_analytic ?? '' !!}
    @if (!empty($purechat_status) && $purechat_status == '1')
        {!! $purechat_code ?? '' !!}
    @endif

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
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $n_id_ga }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ $n_id_ga }}');
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9JZLPMYER5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-9JZLPMYER5');
    </script>
    <script src="{{ asset('asset/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/swiper.js') }}"></script>
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
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    {{-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3XXNCV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> --}}
    <!-- End Google Tag Manager (noscript) -->
    @include('layouts.client.partials.header')
    @yield('content')
    @include('layouts.client.partials.footerv2')
    @stack('js')
</body>

</html>
