{{-- FIX 1: CSS non-blocking (sama seperti area_showcase_section) --}}
<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}" media="print"
    onload="this.media='all'">
<noscript><link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}"></noscript>

<section class="home-slider creative">
    <div class="homewrapper">
        <div class="home-box swiper">
            <div class="swiper-wrapper">
                @foreach ($sliders as $index => $slider)
                    <div class="swiper-slide item">
                        <div class="embed-responsive embed-responsive-21by9">
                            @if (isset($slider['is_image']) && $slider['is_image'])
                                <picture>
                                    @if (isset($slider['webp_path']) && $slider['webp_path'])
                                        <source srcset="{{ asset($slider['webp_path']) }}" type="image/webp">
                                    @endif
                                    <img src="{{ asset($slider['optimized_file'] ?? ($slider['file'] ?? '')) }}"
                                        alt="{{ $slider['title'] ?? '' }}"
                                        class="embed-responsive-item slider-img"
                                        {{ $index === 0 ? 'fetchpriority=high' : 'loading=lazy' }}
                                        width="1920"
                                        height="1080"
                                        decoding="{{ $index === 0 ? 'sync' : 'async' }}">
                                </picture>
                            @else
                                <video class="embed-responsive-item slider-video" autoplay muted loop playsinline
                                    {{ $index === 0 ? 'fetchpriority=high preload=auto' : 'preload=none' }}
                                    poster="{{ asset('asset/images/slider-poster-0.webp') }}">
                                    <source src="{{ asset('uploads/home-slider/' . ($slider['file'] ?? '')) }}" type="video/mp4">
                                </video>
                            @endif

                            <div class="home-container">
                                <div class="home-caption">
                                    @if(!empty($slider['title']))
                                        <h2 class="title" data-swiper-parallax="-300">{{ $slider['title'] }}</h2>
                                    @endif
                                    <span class="sub-title">
                                        @if(!empty($slider['description']))
                                            <p class="description" data-swiper-parallax="-200">{{ $slider['description'] }}</p>
                                        @endif
                                    </span>

                                    <ul class="button mt-4">
                                        <li>
                                            <a href="{{ route('contact') }}" class="btn_slider btn-red">
                                                @lang('system.contact us')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/{{ app()->getLocale() }}#videojiipe" class="btn_slider btn-blue">
                                                @lang('system.video profile')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Controls --}}
            <div class="swiper-button-next" aria-label="Next Slide"></div>
            <div class="swiper-button-prev" aria-label="Previous Slide"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    @include('layouts.client.home.partials.navigation_box')
</section>

@push('js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const homeSwiper = new Swiper('.home-box', {
                loop: true,
                speed: 1000,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 8000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                on: {
                    init: function () {
                        playVideo(this.slides[this.activeIndex]);
                    },
                    slideChangeTransitionStart: function () {
                        stopAllVideos();
                        playVideo(this.slides[this.activeIndex]);
                    }
                }
            });

            function playVideo(slide) {
                const video = slide.querySelector('video');
                if (video) {
                    video.muted = true;
                    video.currentTime = 0;
                    video.play().catch(error => {
                        console.warn('Autoplay prevented:', error);
                    });
                }
            }

            function stopAllVideos() {
                document.querySelectorAll('.home-box video').forEach(video => {
                    video.pause();
                    video.currentTime = 0;
                });
            }

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') homeSwiper.slidePrev();
                if (e.key === 'ArrowRight') homeSwiper.slideNext();
            });
        });
    </script>
@endpush