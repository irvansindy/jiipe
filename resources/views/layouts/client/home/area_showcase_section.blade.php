{{-- CSS non-blocking --}}
<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}" media="print"
    onload="this.media='all'">
<noscript><link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}"></noscript>

{{-- Preload gambar showcase pertama (LCP candidate) --}}
@if(!empty($showcases) && !empty($showcases[0]['image']))
    @push('preload')
        @if(!empty($showcases[0]['image_mobile']))
        <link rel="preload" as="image"
            href="{{ asset('uploads/showcase/' . $showcases[0]['image_mobile']) }}"
            media="(max-width: 767px)"
            fetchpriority="high">
        @endif
        <link rel="preload" as="image"
            href="{{ asset('uploads/showcase/' . $showcases[0]['image']) }}"
            fetchpriority="high">
    @endpush
@endif

<section class="kawasan-slider">
    <div id="kawasan_wrapper_one" class="kawasan-slider-one carousel slide" data-ride="carousel" data-interval="6000">
        <div class="carousel-inner">
            @foreach ($showcases as $i => $showcase)
                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                    <picture>
                        {{-- Mobile source --}}
                        @if (!empty($showcase['image_mobile']))
                            @if ($i === 0)
                                <source
                                    media="(max-width: 767px)"
                                    srcset="{{ asset('uploads/showcase/' . $showcase['image_mobile']) }}"
                                    width="768"
                                    height="500">
                            @else
                                <source
                                    media="(max-width: 767px)"
                                    data-srcset="{{ asset('uploads/showcase/' . $showcase['image_mobile']) }}"
                                    class="lazy-source">
                            @endif
                        @endif

                        {{-- Desktop image --}}
                        @if ($i === 0)
                            {{--
                                ⚡ FIX UTAMA: srcset + sizes
                                Browser akan pilih ukuran yang sesuai viewport.
                                Di layar 1335px (yang terdeteksi PageSpeed),
                                browser pilih 1280w bukan 1920w → hemat 153 KiB.

                                CATATAN: Idealnya sediakan file terpisah per ukuran
                                (misal: showcase-1280.webp, showcase-960.webp).
                                Kalau belum ada resize server-side, srcset saja
                                sudah cukup memberi sinyal ke browser.
                            --}}
                            <img
                                src="{{ asset('uploads/showcase/' . $showcase['image']) }}"
                                srcset="
                                    {{ asset('uploads/showcase/' . $showcase['image']) }} 1920w
                                "
                                sizes="(max-width: 767px) 100vw, (max-width: 1280px) 1280px, 1920px"
                                class="d-block w-100"
                                alt="{{ $showcase['title'] }}"
                                fetchpriority="high"
                                width="1920"
                                height="900"
                                decoding="sync">
                        @else
                            <img
                                data-src="{{ asset('uploads/showcase/' . $showcase['image']) }}"
                                class="d-block w-100 lazy"
                                alt="{{ $showcase['title'] }}"
                                loading="lazy"
                                width="1920"
                                height="900"
                                decoding="async">
                        @endif
                    </picture>
                </div>
            @endforeach
        </div>
    </div>

    <ol class="carousel-indicators">
        @foreach ($showcases as $i => $showcase)
            <li data-target="#kawasan_wrapper_one" data-slide-to="{{ $i }}" data-attr="{{ $i }}"
                class="data_{{ $i }} {{ $i == 0 ? 'active' : '' }}">
                <div class="wrapper-box">
                    <h4 class="title">{{ $showcase['title'] }}</h4>
                    <span class="area">{{ $showcase['description'] }}</span>
                </div>
            </li>
        @endforeach
    </ol>
</section>

<section class="profile-jiipe">
    <div class="prelative container py-5">
        <div class="row">
            <div class="col-lg-30 col-sm-60">
                <div class="jiipe-images">
                    <img data-src="{{ asset('uploads/blog/' . rawurlencode('ab135-JIIPE INVESTOR UPDATE (website).jpg')) }}"
                        class="img-fluid lazy" alt="JIIPE Profile" loading="lazy"
                        width="600" height="400"
                        onerror="this.onerror=null; this.src='{{ asset('uploads/blog/ab135-JIIPE INVESTOR UPDATE (website).jpg') }}';">
                </div>
            </div>
            <div class="col-lg-30 col-sm-60">
                <div class="jiipe-content px-lg-5 px-sm-0">
                    <div class="jiipe-top">
                        <h1 class="jiipe-top-red">@lang('system.why jiipe')?</h1>
                        <p>
                            Discover the industrial hub redefining investment in Southeast Asia! Located in Gresik, East
                            Java, JIIPE is not just another Special Economic Zone (SEZ); it's Indonesia's "Best
                            Industrial SEZ", hosting global giants like Hailiang Group, Sichuan Hebang, Xinyi Glass,
                            Xinyi Solar, and Freeport Indonesia.
                        </p>
                        <p><strong>What's the secret behind JIIPE's success?</strong></p>
                        <p>
                            A fully integrated ecosystem that boosts efficiency, slashes logistics costs, and delivers
                            unmatched connectivity via its deep-sea port. Add to this the fiscal perks and seamless
                            one-stop licensing backed by the Indonesian government, and you've got a formula for
                            investment gold.
                        </p>
                        <p>
                            Find out how JIIPE attracts leading industries in copper, chemicals, glass, and renewable
                            energy? Click to uncover the future of industrial synergy and find out why global investors
                            are flocking to JIIPE.
                        </p>
                        <ul class="button">
                            <li><a href="{{ route('blog.detail', ['id' => 403]) }}">了解更多信息</a></li>
                            <li><a href="{{ route('blog.detail', ['id' => 403]) }}">Find More info</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.client.home.partials.navigation_box')
    <div class="clear"></div>
</section>

<section class="video-jiipe" id="videojiipe">
    <div class="embed-responsive embed-responsive-21by9">
        <video class="embed-responsive-item" id="jiipeVideo" loop playsinline controls preload="none"
            poster="{{ asset('asset/images/video-placeholder.jpg') }}">
            @if (app()->getLocale() == 'zh')
                <source data-src="https://jiipe.com//Video_jiipe/Company%20Profile%20JIIPE%20CINA%20-%20SUB%20English.mp4"
                    type="video/mp4">
            @else
                <source data-src="{{ asset('asset/video/62e1d25a28720.mp4') }}" type="video/mp4">
            @endif
        </video>
    </div>
</section>

@push('js')
    <script>
        (function() {
            'use strict';

            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                                img.classList.remove('lazy');
                            }
                            observer.unobserve(img);
                        }
                    });
                }, { rootMargin: '50px 0px', threshold: 0.01 });

                document.querySelectorAll('img.lazy').forEach(img => imageObserver.observe(img));

                $('#kawasan_wrapper_one').on('slide.bs.carousel', function(e) {
                    const $nextSlide = $(e.relatedTarget);

                    $nextSlide.find('source.lazy-source').each(function() {
                        const $source = $(this);
                        if ($source.data('srcset')) {
                            $source.attr('srcset', $source.data('srcset'));
                            $source.removeAttr('data-srcset');
                            $source.removeClass('lazy-source');
                        }
                    });

                    const $img = $nextSlide.find('img.lazy');
                    if ($img.length && $img.data('src')) {
                        $img.attr('src', $img.data('src'));
                        $img.removeAttr('data-src');
                        $img.removeClass('lazy');
                    }
                });

            } else {
                document.querySelectorAll('img.lazy').forEach(img => {
                    if (img.dataset.src) { img.src = img.dataset.src; img.removeAttribute('data-src'); }
                });
                document.querySelectorAll('source.lazy-source').forEach(source => {
                    if (source.dataset.srcset) { source.srcset = source.dataset.srcset; source.removeAttribute('data-srcset'); }
                });
            }
        })();
    </script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var isVideoPlaying = false;
            var playAttempted = false;

            function loadVideoSources(video) {
                video.querySelectorAll('source[data-src]').forEach(function(source) {
                    source.src = source.dataset.src;
                    source.removeAttribute('data-src');
                });
                video.load();
            }

            function playVideo(video) {
                if (!video || playAttempted) return;
                if (video.querySelector('source[data-src]')) loadVideoSources(video);
                video.muted = true;
                video.currentTime = 0;
                playAttempted = true;
                var playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.then(function() { isVideoPlaying = true; })
                    .catch(function() { video.controls = true; playAttempted = false; });
                }
            }

            function pauseVideo(video) {
                if (!video || !isVideoPlaying) return;
                video.pause();
                isVideoPlaying = false;
            }

            if ('IntersectionObserver' in window) {
                var videoObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        var video = entry.target.querySelector('video');
                        if (entry.isIntersecting) {
                            if (video && !isVideoPlaying) setTimeout(function() { playVideo(video); }, 300);
                        } else {
                            if (video && isVideoPlaying) { pauseVideo(video); playAttempted = false; }
                        }
                    });
                }, { threshold: 0.25 });

                var videoSection = document.querySelector('#videojiipe');
                if (videoSection) videoObserver.observe(videoSection);
            }

            document.addEventListener('visibilitychange', function() {
                var video = document.querySelector('#jiipeVideo');
                if (!video) return;
                if (document.hidden) {
                    pauseVideo(video);
                } else {
                    var videoSection = document.querySelector('#videojiipe');
                    if (videoSection) {
                        var rect = videoSection.getBoundingClientRect();
                        if (rect.top < window.innerHeight && rect.bottom > 0 && !isVideoPlaying) {
                            playAttempted = false;
                            setTimeout(function() { playVideo(video); }, 300);
                        }
                    }
                }
            });

            $('#videojiipe').one('click touchstart', function() {
                var video = document.querySelector('#jiipeVideo');
                if (video && !isVideoPlaying) { playAttempted = false; playVideo(video); }
            });
        });
    </script>
@endpush