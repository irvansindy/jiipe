{{-- FIX 1: CSS non-blocking (sama seperti area_showcase_section) --}}
<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}" media="print"
    onload="this.media='all'">
<noscript><link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}"></noscript>

<section class="home-slider creative">
    <div class="homewrapper">
        <div class="home-box owl-carousel owl-theme">
            @foreach ($sliders as $slider)
                <div class="item">
                    <div class="embed-responsive embed-responsive-21by9">
                        <video
                            class="embed-responsive-item"
                            muted
                            playsinline
                            webkit-playsinline
                            preload="{{ $loop->first ? 'metadata' : 'none' }}"
                            {{-- FIX 2: WAJIB ada poster — mencegah layar hitam & bantu LCP --}}
                            poster="{{ asset('asset/images/slider-poster-' . $loop->index . '.jpg') }}"
                        >
                            <source
                                src="{{ asset('uploads/home-slider/' . $slider['file']) }}"
                                type="video/mp4"
                                @if($loop->first) fetchpriority="high" @else fetchpriority="low" @endif
                            >
                        </video>
                        <div class="home-container">
                            <div class="home-caption">
                                <h2 class="title">{{ $slider['title'] }}</h2>
                                <span class="sub-title">
                                    <p>{{ $slider['description'] }}</p>
                                </span>
                                <ul class="button">
                                    <li>
                                        <a href="{{ route('contact') }}" class="btn_slider btn-light btn-red">
                                            @lang('system.contact us')
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.jiipe.com/#videojiipe"
                                            class="btn_slider btn-light btn-blue">
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
    </div>
    @include('layouts.client.home.partials.navigation_box')
</section>

@push('js')
    {{-- FIX 3: Preload video pertama SAJA (bukan semua) --}}
    @if(!empty($sliders) && count($sliders) > 0)
        <link rel="preload" as="video" href="{{ asset('uploads/home-slider/' . $sliders[0]['file']) }}" type="video/mp4" fetchpriority="high">
    @endif

    <script>
        $(document).ready(function() {
            var $homeBox = $('.home-box');

            if ($homeBox.hasClass('owl-loaded')) {
                $homeBox.trigger('destroy.owl.carousel');
                $homeBox.removeClass('owl-loaded owl-drag');
            }

            var homeSlider = $homeBox.owlCarousel({
                items: 1,
                loop: true,
                margin: 15,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 8000,
                autoplayHoverPause: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 1000,
                lazyLoad: false,
                responsive: {
                    0: { items: 1 },
                    768: { items: 1 },
                    1024: { items: 1 }
                },
                onInitialized: function(event) {
                    prepareVideos();
                    playCurrentVideo(event);
                },
                onTranslated: function(event) {
                    stopAllVideos();
                    playCurrentVideo(event);
                },
                onChanged: function(event) {
                    stopAllVideos();
                }
            });

            function prepareVideos() {
                $('.home-box video').each(function() {
                    this.muted = true;
                    this.setAttribute('playsinline', '');
                    this.setAttribute('webkit-playsinline', '');
                });
            }

            function playCurrentVideo(event) {
                var $activeItem = $('.home-box .owl-item.active');
                var video = $activeItem.find('video').get(0);

                if (video && video.getAttribute('preload') === 'none') {
                    video.setAttribute('preload', 'metadata');
                }

                if (video) {
                    video.currentTime = 0;
                    video.play().catch(function(error) {
                        console.log('Video autoplay prevented:', error);
                    });
                }
            }

            function stopAllVideos() {
                $('.home-box video').each(function() {
                    this.pause();
                    this.currentTime = 0;
                    if (this.closest('.owl-item') && !this.closest('.owl-item').classList.contains('active')) {
                        this.setAttribute('preload', 'none');
                    }
                });
            }

            $('.owl-prev').on('click', function(e) {
                e.preventDefault();
                homeSlider.trigger('prev.owl.carousel');
            });

            $('.owl-next').on('click', function(e) {
                e.preventDefault();
                homeSlider.trigger('next.owl.carousel');
            });

            $(document).on('keydown', function(e) {
                if (e.keyCode == 37) homeSlider.trigger('prev.owl.carousel');
                if (e.keyCode == 39) homeSlider.trigger('next.owl.carousel');
            });

            $('.home-box video').on('ended', function() {
                homeSlider.trigger('next.owl.carousel');
            });
        });
    </script>
@endpush