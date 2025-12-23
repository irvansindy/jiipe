<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">
<section class="home-slider creative">
    <div class="homewrapper">
        <div class="home-box owl-carousel owl-theme owl-loaded">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    {{-- @php
                        $sliders = app(\App\Http\Controllers\Client\HomeController::class)->getSliders();
                    @endphp --}}
                    @foreach ($sliders as $slider)
                        <div class="owl-item" style="width: 1580.83px; margin-right: 15px;">
                            <div class="embed-responsive embed-responsive-21by9">
                                <video class="embed-responsive-item" muted="">
                                    <source src="{{ asset('uploads/home-slider/' . $slider['file']) }}"
                                        type="video/mp4">
                                </video>
                                <div class="home-container">
                                    <div class="home-caption">
                                        <h2 class="title">{{ $slider['title'] }}</h2>
                                        <span class="sub-title">
                                            <p>{{ $slider['description'] }}</p>
                                        </span>
                                        <ul class="button">
                                            <li><a href="{{ route('contact') }}"
                                                    class="btn_slider btn-light btn-red">@lang('system.contact us')</a></li>
                                            <li><a href="https://www.jiipe.com/#videojiipe"
                                                    class="btn_slider btn-light btn-blue">@lang('system.video profile')</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="owl-nav disabled">
                <button type="button" role="presentation" class="owl-prev"><span
                        aria-label="Previous">‹</span></button>
                <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
            </div>
            <div class="owl-dots disabled"></div>
        </div>
    </div>
    @include('layouts.client.home.partials.navigation_box')
</section>
<script>
    $(document).ready(function() {
        var homeSlider = $('.home-box').owlCarousel({
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
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1024: {
                    items: 1
                }
            },
            onInitialized: function(event) {
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

        function playCurrentVideo(event) {
            var activeItem = $('.home-box .owl-item.active');
            var video = activeItem.find('video').get(0);
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
            });
        }
        $('.owl-prev').click(function() {
            homeSlider.trigger('prev.owl.carousel');
        });
        $('.owl-next').click(function() {
            homeSlider.trigger('next.owl.carousel');
        });
        $(document).keydown(function(e) {
            if (e.keyCode == 37) {
                homeSlider.trigger('prev.owl.carousel');
            }
            if (e.keyCode == 39) {
                homeSlider.trigger('next.owl.carousel');
            }
        });
        $('.home-box video').each(function() {
            this.muted = true;
            this.setAttribute('playsinline', '');
            this.setAttribute('webkit-playsinline', '');
        });
        $('.home-box video').on('ended', function() {
            homeSlider.trigger('next.owl.carousel');
        });
    });
</script>
