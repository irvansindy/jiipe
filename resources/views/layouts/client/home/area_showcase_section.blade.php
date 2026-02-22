{{-- filepath: resources/views/layouts/client/home/area_showcase_section.blade.php --}}
<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}" media="print" onload="this.media='all'">

<section class="kawasan-slider">
    <div id="kawasan_wrapper_one" class="kawasan-slider-one carousel slide" data-ride="carousel" data-interval="6000">
        <div class="carousel-inner">
            @foreach ($showcases as $i => $showcase)
                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                    {{-- ⚡ First image eager, rest lazy loaded --}}
                    @if($i === 0)
                        <img src="{{ asset('uploads/showcase/'.$showcase['image']) }}"
                             class="d-block w-100"
                             alt="{{ $showcase['title'] }}"
                             fetchpriority="high">
                    @else
                        <img data-src="{{ asset('uploads/showcase/'.$showcase['image']) }}"
                             class="d-block w-100 lazy"
                             alt="{{ $showcase['title'] }}"
                             loading="lazy">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <ol class="carousel-indicators">
        @foreach ($showcases as $i => $showcase)
            <li data-target="#kawasan_wrapper_one"
                data-slide-to="{{ $i }}"
                data-attr="{{ $i }}"
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
                    {{-- ⚡ Lazy load dengan proper encoding --}}
                    <img data-src="{{ asset('uploads/blog/' . rawurlencode('ab135-JIIPE INVESTOR UPDATE (website).jpg')) }}"
                        class="img-fluid lazy"
                        alt="JIIPE Profile"
                        loading="lazy"
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
        {{-- ⚡ Video dengan lazy loading dan autoplay attributes --}}
        <video class="embed-responsive-item"
                id="jiipeVideo"
                loop
                playsinline
                controls
                preload="auto"
                poster="{{ asset('asset/images/video-placeholder.jpg') }}">
            @if (app()->getLocale() == 'zh')
                <source src="https://jiipe.com//Video_jiipe/Company%20Profile%20JIIPE%20CINA%20-%20SUB%20English.mp4" type="video/mp4">
            @else
                <source src="{{ asset('asset/video/62e1d25a28720.mp4') }}" type="video/mp4">
            @endif
        </video>
    </div>
</section>

@push('js')
<script>
// ⚡ Lazy load images
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
        }, {
            rootMargin: '50px 0px', // Start loading 50px before entering viewport
            threshold: 0.01
        });

        // Observe all lazy images
        document.querySelectorAll('img.lazy').forEach(img => {
            imageObserver.observe(img);
        });

        // ⚡ Lazy load carousel images on slide change
        $('#kawasan_wrapper_one').on('slide.bs.carousel', function(e) {
            const $nextSlide = $(e.relatedTarget);
            const $img = $nextSlide.find('img.lazy');

            if ($img.length && $img.data('src')) {
                $img.attr('src', $img.data('src'));
                $img.removeAttr('data-src');
                $img.removeClass('lazy');
            }
        });
    } else {
        // Fallback for browsers without IntersectionObserver
        document.querySelectorAll('img.lazy').forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
        });
    }
})();
</script>
@endpush

@push('js')
<script>
$(document).ready(function() {
    // ⚡ Video Autoplay Handler - FIXED VERSION
    var isVideoPlaying = false;
    var playAttempted = false;

    // Function play video dengan aman dan proper error handling
    function playVideo(video) {
        if (!video || playAttempted) return;

        // Pastikan video dalam kondisi siap
        video.muted = true;
        video.currentTime = 0;

        playAttempted = true;

        // Play dengan promise handling yang proper
        var playPromise = video.play();

        if (playPromise !== undefined) {
            playPromise
                .then(function() {
                    isVideoPlaying = true;
                    console.log('✅ Video autoplay berhasil');
                })
                .catch(function(err) {
                    console.log('⚠️ Autoplay diblokir browser:', err.name);

                    // Tampilkan controls sebagai fallback
                    video.controls = true;

                    // Reset flag untuk retry
                    playAttempted = false;
                });
        }
    }

    // Function untuk pause video
    function pauseVideo(video) {
        if (!video || !isVideoPlaying) return;

        video.pause();
        isVideoPlaying = false;
    }

    // ⚡ Inisialisasi video dengan IntersectionObserver
    if ('IntersectionObserver' in window) {
        var videoObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                var video = entry.target.querySelector('video');

                if (entry.isIntersecting) {
                    // Section masuk viewport - play video
                    if (video && !isVideoPlaying) {
                        setTimeout(function() {
                            playVideo(video);
                        }, 300); // Delay untuk memastikan section sudah visible
                    }
                } else {
                    // Section keluar viewport - pause video
                    if (video && isVideoPlaying) {
                        pauseVideo(video);
                        playAttempted = false; // Reset untuk bisa play lagi nanti
                    }
                }
            });
        }, {
            threshold: 0.25, // Play saat 25% section terlihat
            rootMargin: '0px'
        });

        var videoSection = document.querySelector('#videojiipe');
        if (videoSection) {
            videoObserver.observe(videoSection);
        }
    } else {
        // Fallback untuk browser tanpa IntersectionObserver
        setTimeout(function() {
            var video = document.querySelector('#jiipeVideo');
            if (video) {
                playVideo(video);
            }
        }, 800);
    }

    // ⚡ Handle visibility change (tab switching)
    document.addEventListener('visibilitychange', function() {
        var video = document.querySelector('#jiipeVideo');
        if (!video) return;

        if (document.hidden) {
            pauseVideo(video);
        } else {
            // Check jika video section visible
            var videoSection = document.querySelector('#videojiipe');
            if (videoSection) {
                var rect = videoSection.getBoundingClientRect();
                var isVisible = rect.top < window.innerHeight && rect.bottom > 0;

                if (isVisible && !isVideoPlaying) {
                    playAttempted = false; // Reset flag
                    setTimeout(function() {
                        playVideo(video);
                    }, 300);
                }
            }
        }
    });

    // ⚡ User interaction fallback - play saat user klik/touch di section
    $('#videojiipe').one('click touchstart', function() {
        var video = document.querySelector('#jiipeVideo');
        if (video && !isVideoPlaying) {
            playAttempted = false;
            playVideo(video);
        }
    });
});
</script>
@endpush