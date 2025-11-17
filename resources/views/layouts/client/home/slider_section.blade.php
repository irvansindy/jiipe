<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">
<section class="home-slider creative">
    <div class="homewrapper">
        <div class="home-box owl-carousel owl-theme owl-loaded">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    @php
                        $sliders = app(\App\Http\Controllers\Client\HomeController::class)->getSliders();
                    @endphp
                    @foreach ($sliders as $slider)
                        <div class="owl-item" style="width: 1580.83px; margin-right: 15px;">
                            <div class="embed-responsive embed-responsive-21by9">
                                <video class="embed-responsive-item" muted="">
                                    <source src="/{{ $slider['file'] }}" type="video/mp4">
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
                                                    class="btn_slider btn-light btn-blue">Video Profile</a></li>
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

    <div class="navigasi-box navigasi-box-shadow navigasi-box-border-bottom justify-center"
        style="display: block; width: 100%;">
        <ul>
            <li class="hover">
                <a href="#contact">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-calendar-alt"></i></div>
                        <div class="text">
                            <p>Quick Appointment</p>
                            <h6 class="title">PROPOSAL REQUEST</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#videotour">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-map-marked-alt"></i></div>
                        <div class="text">
                            <p>Watch</p>
                            <h6 class="title">VIDEO TOUR</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="/asset/brochure/61a6ed0108(Comp) eBrochure - JIIPE Brochure English.pdf" target="_blank"
                    class="hashmb d-none">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>Download</p>
                            <h6>JIIPE E-BROCHURE</h6>
                        </div>
                    </div>
                </a>
                <a href="/asset/brochure/323829b435(Comp) eBrochure - JIIPE Brochure English.pdf" target="_blank"
                    class="hashds">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>Download</p>
                            <h6>JIIPE E-BROCHURE</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#faq">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-comment-alt"></i></div>
                        <div class="text">
                            <p>Frequently</p>
                            <h6>ASKED QUESTIONS</h6>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
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
