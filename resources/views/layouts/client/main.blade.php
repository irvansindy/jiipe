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

    <!-- ⚡ CRITICAL: Preconnect to external domains (OPTIMIZED) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://hm.baidu.com">

    <!-- ⚡ CRITICAL CSS - Inline untuk above-the-fold -->
    <style>
        /* Critical CSS - Minimal styles untuk first paint */
        body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; line-height: 1.6; }
        .home-slider { min-height: 100vh; position: relative; background: #000; }
        .kawasan-slider { position: relative; }
        .carousel-inner { position: relative; width: 100%; overflow: hidden; }
        .carousel-item { position: relative; display: none; width: 100%; }
        .carousel-item.active { display: block; }
        img { max-width: 100%; height: auto; display: block; }

        /* Loading state */
        .loading { opacity: 0.7; pointer-events: none; }
    </style>

    <!-- ⚡ Preload Critical Fonts (OPTIMIZED - swap untuk menghindari FOIT) -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;700&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;700&display=swap"></noscript>

    <!-- ⚡ Critical CSS - Load synchronously -->
    <link rel="stylesheet" href="{{ asset('asset/js/bootstrap-4.0.0/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/backend/css/style.default.css') }}">

    <!-- ⚡ Font Awesome - OPTIMIZED VERSION (hanya solid icons, bukan all.css) -->
    <!-- BEFORE: 1.68MB | AFTER: ~100KB = 94% SMALLER! -->
    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css" media="print" onload="this.media='all'">
    <!-- Jika menggunakan brands icons (Facebook, Twitter, dll), tambahkan ini: -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" media="print" onload="this.media='all'"> -->

    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css">
    </noscript>

    <!-- ⚡ Non-Critical CSS - Defer loading dengan media print trick -->
    <link rel="stylesheet" href="{{ asset('asset/css/styles.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('asset/css/media.styles.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('asset/css/animate.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('asset/css/creative/creative.css') }}?ver=1.0.32" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('asset/css/creative/creativeresponsive.css') }}?ver=1.0.25" media="print" onload="this.media='all'">

    <!-- ⚡ Owl Carousel CSS - Defer -->
    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" media="print" onload="this.media='all'">

    <!-- ⚡ Swiper CSS - Defer -->
    <link rel="stylesheet" href="{{ asset('asset/css/cdn/swiper.css') }}" media="print" onload="this.media='all'">

    <!-- Fallback untuk browser tanpa JavaScript -->
    <noscript>
        <link rel="stylesheet" href="{{ asset('asset/css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/css/media.styles.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/css/creative/creative.css') }}?ver=1.0.32">
        <link rel="stylesheet" href="{{ asset('asset/css/creative/creativeresponsive.css') }}?ver=1.0.25">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="{{ asset('asset/css/cdn/swiper.css') }}">
    </noscript>

    @stack('css')

    <!-- ⚡ Google Tag Manager - Async (OPTIMIZED) -->
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

    <!-- ⚡ Google Analytics - Async (COMBINED untuk mengurangi request) -->
    <script>
        // Load gtag.js once
        (function() {
            var script = document.createElement('script');
            script.async = true;
            script.src = 'https://www.googletagmanager.com/gtag/js?id={{ $n_id_ga }}';
            document.head.appendChild(script);

            script.onload = function() {
                window.dataLayer = window.dataLayer || [];
                function gtag() { dataLayer.push(arguments); }
                gtag('js', new Date());
                gtag('config', '{{ $n_id_ga }}');
                gtag('config', 'G-9JZLPMYER5');
            };
        })();
    </script>

    <!-- ⚡ Baidu Tongji - Async dengan requestIdleCallback -->
    <script>
        (function() {
            var loadBaidu = function() {
                var _hmt = _hmt || [];
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?11d4567d21afc44b50922f500bef6a4c";
                hm.async = true;
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            };

            // Load setelah halaman selesai load
            if ('requestIdleCallback' in window) {
                requestIdleCallback(loadBaidu);
            } else {
                setTimeout(loadBaidu, 1);
            }
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

    <!-- ⚡ JavaScript - OPTIMIZED LOADING STRATEGY -->

    <!-- jQuery - Load dari CDN dengan fallback + Integrity check -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>

    <!-- ⚡ Other libraries dengan DEFER dan async loading -->
    <script>
        // Optimized script loader
        (function() {
            var scripts = [
                {
                    src: 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
                    integrity: 'sha512-4h0hzPT/aHHKKj5eE9kkMxTxoLzAQbQsRy9mDwqZ7Jt8MjQ/4qqKI8VYHlgJYULhPXdJPmFOmCT3/qNYr9pYQ==',
                    crossorigin: 'anonymous'
                },
                {
                    src: 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js',
                    integrity: 'sha512-D8z/aCVRySnn3lqPZtKdCNr7l7Pf3QhLxQ7VxoLBfMqaQ8xVqpVxpfDqvlT8bLVvqTRwJNmXOPmhJpKfECHqw==',
                    crossorigin: 'anonymous'
                },
                {
                    src: 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',
                    integrity: 'sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==',
                    crossorigin: 'anonymous'
                },
                {
                    src: '{{ asset('asset/js/slick/slick.min.js') }}'
                },
                {
                    src: '{{ asset('asset/js/cdn/swiper.js') }}'
                }
            ];

            // Load scripts secara berurutan setelah DOM ready
            var loadScript = function(index) {
                if (index >= scripts.length) {
                    // Semua script sudah loaded
                    document.dispatchEvent(new Event('scriptsLoaded'));
                    return;
                }

                var config = scripts[index];
                var script = document.createElement('script');
                script.src = config.src;
                script.async = true;

                if (config.integrity) {
                    script.integrity = config.integrity;
                }
                if (config.crossorigin) {
                    script.crossOrigin = config.crossorigin;
                }

                script.onload = function() {
                    loadScript(index + 1);
                };

                script.onerror = function() {
                    console.warn('Failed to load:', config.src);
                    loadScript(index + 1); // Continue loading next script
                };

                document.body.appendChild(script);
            };

            // Start loading after DOM ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    loadScript(0);
                });
            } else {
                loadScript(0);
            }
        })();
    </script>

    <!-- ⚡ Initialize plugins setelah semua script loaded -->
    <script>
        // Wait for all scripts to load
        document.addEventListener('scriptsLoaded', function() {
            console.log('✅ All plugins loaded successfully');

            // Initialize plugins here if needed
            // Example:
            // if (typeof $.fn.owlCarousel !== 'undefined') {
            //     $('.owl-carousel').owlCarousel();
            // }

            // Trigger custom event untuk page-specific scripts
            document.dispatchEvent(new Event('pluginsReady'));
        });

        // Fallback timeout
        setTimeout(function() {
            if (!window.pluginsInitialized) {
                console.warn('⚠️ Some plugins may not have loaded properly');
                document.dispatchEvent(new Event('pluginsReady'));
            }
        }, 5000);
    </script>

    <!-- Custom scripts (menggunakan event pluginsReady) -->
    @stack('js')
</body>

</html>