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
    <style>
        @media screen and (max-width: 1024px) {

            /* Semua CSS yang sama, hanya ubah breakpoint-nya */
            .branding2 {
                display: none !important;
            }

            .slogan {
                display: none !important;
            }

            .navbar-toggle-btn {
                display: block !important;
                cursor: pointer !important;
                padding: 10px !important;
            }

            .navbar-toggler {
                width: 30px !important;
                height: 25px !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
            }

            .navbar-toggler span {
                display: block !important;
                width: 100% !important;
                height: 3px !important;
                background-color: #e31e24 !important;
                border-radius: 2px !important;
            }

            .navbar-toggler.active span:nth-child(1) {
                transform: rotate(45deg) translate(8px, 8px) !important;
            }

            .navbar-toggler.active span:nth-child(2) {
                opacity: 0 !important;
            }

            .navbar-toggler.active span:nth-child(3) {
                transform: rotate(-45deg) translate(8px, -8px) !important;
            }

            .nav-menu {
                position: fixed !important;
                top: 0 !important;
                right: -100% !important;
                width: 85% !important;
                max-width: 350px !important;
                height: 100vh !important;
                background-color: #fff !important;
                z-index: 99999 !important;
                transition: right 0.4s ease !important;
                overflow-y: auto !important;
                box-shadow: -5px 0 25px rgba(0, 0, 0, 0.5) !important;
                padding-top: 60px !important;
            }

            .nav-menu.active {
                right: 0 !important;
            }

            .navbar-close {
                display: block !important;
                position: absolute !important;
                right: 20px !important;
                top: 15px !important;
                font-size: 35px !important;
                cursor: pointer !important;
                color: #333 !important;
            }

            .main-menu ul {
                display: flex !important;
                flex-direction: column !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .main-menu ul li {
                border-bottom: 1px solid #eee !important;
            }

            .main-menu ul li a {
                display: block !important;
                padding: 15px 25px !important;
                color: #333 !important;
            }

            .main-menu .sub-menu {
                display: none !important;
                background: #f5f5f5 !important;
            }

            .main-menu .has-children.active .sub-menu {
                display: block !important;
            }

            .nav-menu-overlay {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100vh !important;
                background: rgba(0, 0, 0, 0.6) !important;
                z-index: 99998 !important;
                display: none !important;
            }

            .nav-menu-overlay.active {
                display: block !important;
            }

            body.menu-open {
                overflow: hidden !important;
            }
        }
    </style>

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
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    {{-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3XXNCV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> --}}
    <!-- End Google Tag Manager (noscript) -->
    @include('layouts.client.partials.header')
    @yield('content')
    @include('layouts.client.partials.footerv2')
    @stack('js')

    {{-- MOBILE MENU SCRIPT --}}
    <script>
        (function() {
            'use strict';

            function initMobileMenu() {
                const toggleBtn = document.querySelector('.navbar-toggle-btn');
                const navMenu = document.querySelector('.nav-menu');
                const closeBtn = document.querySelector('.navbar-close');

                if (!toggleBtn || !navMenu) return;

                function createOverlay() {
                    let overlay = document.querySelector('.nav-menu-overlay');
                    if (!overlay) {
                        overlay = document.createElement('div');
                        overlay.className = 'nav-menu-overlay';
                        document.body.appendChild(overlay);
                    }
                    return overlay;
                }

                function openMenu() {
                    const overlay = createOverlay();
                    navMenu.classList.add('active');
                    document.body.classList.add('menu-open');
                    toggleBtn.querySelector('.navbar-toggler')?.classList.add('active');
                    setTimeout(() => overlay.classList.add('active'), 10);
                }

                function closeMenu() {
                    const overlay = document.querySelector('.nav-menu-overlay');
                    navMenu.classList.remove('active');
                    document.body.classList.remove('menu-open');
                    toggleBtn.querySelector('.navbar-toggler')?.classList.remove('active');
                    if (overlay) {
                        overlay.classList.remove('active');
                        setTimeout(() => overlay.remove(), 300);
                    }
                }

                toggleBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    navMenu.classList.contains('active') ? closeMenu() : openMenu();
                });

                closeBtn?.addEventListener('click', closeMenu);
                document.addEventListener('click', (e) => {
                    if (e.target.classList.contains('nav-menu-overlay')) closeMenu();
                });

                document.querySelectorAll('.main-menu .has-children > a.dd-trigger').forEach(item => {
                    item.addEventListener('click', function(e) {
                        if (window.innerWidth <= 1024) {
                            e.preventDefault();
                            const parent = this.parentElement;
                            document.querySelectorAll('.main-menu .has-children').forEach(el => el
                                .classList.remove('active'));
                            parent.classList.toggle('active');
                        }
                    });
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initMobileMenu);
            } else {
                initMobileMenu();
            }
        })();
    </script>
</body>

</html>
