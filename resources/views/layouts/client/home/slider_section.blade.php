<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">
<section class="home-slider creative">
    <div class="homewrapper">
        {{-- ⚡ FIXED: Hapus class owl-loaded dan markup owl yang sudah di-generate --}}
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
    {{-- ⚡ Preload video slide pertama saja (yang above-the-fold) --}}
    @if(!empty($sliders) && count($sliders) > 0)
        <link rel="preload" as="video" href="{{ asset('uploads/home-slider/' . $sliders[0]['file']) }}" type="video/mp4" fetchpriority="high">
    @endif

    <script>
        $(document).ready(function() {
            var $homeBox = $('.home-box');

            // Destroy existing owl carousel if any
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
                // Pastikan semua video muted & playsinline
                $('.home-box video').each(function() {
                    this.muted = true;
                    this.setAttribute('playsinline', '');
                    this.setAttribute('webkit-playsinline', '');
                });
            }

            function playCurrentVideo(event) {
                var $activeItem = $('.home-box .owl-item.active');
                var video = $activeItem.find('video').get(0);

                // Saat slide aktif, set preload metadata agar cepat play
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

                    // ⚡ Kembalikan ke preload none untuk menghemat bandwidth
                    if (this.closest('.owl-item') && !this.closest('.owl-item').classList.contains('active')) {
                        this.setAttribute('preload', 'none');
                    }
                });
            }

            // Navigation controls
            $('.owl-prev').on('click', function(e) {
                e.preventDefault();
                homeSlider.trigger('prev.owl.carousel');
            });

            $('.owl-next').on('click', function(e) {
                e.preventDefault();
                homeSlider.trigger('next.owl.carousel');
            });

            // Keyboard navigation
            $(document).on('keydown', function(e) {
                if (e.keyCode == 37) homeSlider.trigger('prev.owl.carousel');
                if (e.keyCode == 39) homeSlider.trigger('next.owl.carousel');
            });

            // Auto advance on video end
            $('.home-box video').on('ended', function() {
                homeSlider.trigger('next.owl.carousel');
            });
        });
    </script>
@endpush
