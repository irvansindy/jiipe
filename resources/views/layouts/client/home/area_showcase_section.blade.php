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
    <div id="kawasan_wrapper_one" class="kawasan-slider-one swiper">
        <div class="swiper-wrapper">
            @foreach ($showcases as $i => $showcase)
                    <div class="swiper-slide card_kawasan">
                        <div class="embed-responsive embed-responsive-21by9">
                            <picture>
                                {{-- Optimized Mobile Source --}}
                                @if ($showcase['webp_mobile'])
                                    <source
                                        media="(max-width: 767px)"
                                        srcset="{{ asset($showcase['webp_mobile']) }}"
                                        type="image/webp">
                                @endif
                                <source
                                    media="(max-width: 767px)"
                                    srcset="{{ asset($showcase['optimized_mobile']) }}"
                                    type="image/jpeg">

                                {{-- Optimized Desktop Source --}}
                                @if ($showcase['webp_image'])
                                    <source
                                        media="(min-width: 768px)"
                                        srcset="{{ asset($showcase['webp_image']) }}"
                                        type="image/webp">
                                @endif

                                <img
                                    src="{{ asset($showcase['optimized_image']) }}"
                                    alt="{{ $showcase['title'] }}"
                                    class="embed-responsive-item {{ $i === 0 ? '' : 'lazy' }}"
                                    {{ $i === 0 ? 'fetchpriority=high' : 'loading=lazy' }}
                                    width="1920"
                                    height="900"
                                    decoding="{{ $i === 0 ? 'sync' : 'async' }}">
                            </picture>
                        </div>
                    </div>
            @endforeach
        </div>
        {{-- A11y Navigation Buttons --}}
        <div class="swiper-button-next" aria-label="Next Slide"></div>
        <div class="swiper-button-prev" aria-label="Previous Slide"></div>
    </div>

    {{-- Indicators (Thumbnails/Boxes) --}}
    <div class="kawasan-indicators-container container">
        <div class="kawasan-indicators-swiper swiper">
            <div class="swiper-wrapper">
                @foreach ($showcases as $i => $showcase)
                    <div class="swiper-slide indicator-item" role="button" aria-label="Go to slide {{ $i + 1 }}">
                        <div class="wrapper-box">
                            <h4 class="title">{{ $showcase['title'] }}</h4>
                            <span class="area">{{ $showcase['description'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
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
            poster="{{ asset('asset/images/slider-poster-0.webp') }}">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Thumbs Swiper
            const indicatorSwiper = new Swiper('.kawasan-indicators-swiper', {
                slidesPerView: 2,
                spaceBetween: 10,
                watchSlidesProgress: true,
                breakpoints: {
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    }
                }
            });

            // Initialize Main Swiper
            const mainSwiper = new Swiper('.kawasan-slider-one', {
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false,
                },
                thumbs: {
                    swiper: indicatorSwiper,
                },
                on: {
                    slideChangeTransitionStart: function() {
                        const activeSlide = this.slides[this.activeIndex];
                        const lazyImg = activeSlide.querySelector('img.lazy');
                        if (lazyImg && lazyImg.dataset.src) {
                            lazyImg.src = lazyImg.dataset.src;
                            lazyImg.removeAttribute('data-src');
                            lazyImg.classList.remove('lazy');
                        }
                    }
                }
            });

            // Lazy Load Implementation
            if ('IntersectionObserver' in window) {
                const lazyObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const target = entry.target;
                            if (target.tagName === 'IMG' && target.dataset.src) {
                                target.src = target.dataset.src;
                                target.removeAttribute('data-src');
                                target.classList.remove('lazy');
                            }
                            observer.unobserve(target);
                        }
                    });
                }, { rootMargin: '100px' });

                document.querySelectorAll('img.lazy').forEach(img => lazyObserver.observe(img));
            }

            // Video Auto-play on Viewport
            const video = document.querySelector('#jiipeVideo');
            if (video && 'IntersectionObserver' in window) {
                const videoObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            if (video.querySelector('source[data-src]')) {
                                video.querySelectorAll('source').forEach(src => {
                                    if (src.dataset.src) {
                                        src.src = src.dataset.src;
                                        src.removeAttribute('data-src');
                                    }
                                });
                                video.load();
                            }
                            video.play().catch(() => {});
                        } else {
                            video.pause();
                        }
                    });
                }, { threshold: 0.5 });
                videoObserver.observe(document.querySelector('#videojiipe'));
            }
        });
    </script>
@endpush