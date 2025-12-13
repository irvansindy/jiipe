<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">

<section class="home-slider creative">
    <div class="homewrapper">
        <div class="home-box owl-carousel owl-theme">

            @php
                $sliders = app(\App\Http\Controllers\Client\HomeController::class)->getSliders();
            @endphp

            @foreach ($sliders as $slider)
                <div class="item">
                    <div class="embed-responsive embed-responsive-21by9">
                        <div class="video-wrapper">

                            <video class="embed-responsive-item home-video" muted preload="none">
                                <source data-src="{{ asset('uploads/home-slider/' . $slider['file']) }}"
                                    type="video/mp4">
                            </video>

                            <!-- Skeleton Loader -->
                            <div class="video-skeleton">
                                <div class="skeleton shimmer"></div>
                            </div>

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
                </div>
            @endforeach

        </div>
    </div>

    {{-- Navigasi Box --}}
    <div class="navigasi-box navigasi-box-shadow navigasi-box-border-bottom justify-center" style="width:100%;">
        <ul>
            <li class="hover">
                <a href="#contact">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-calendar-alt"></i></div>
                        <div class="text">
                            <p>@lang('system.quick appointment')</p>
                            <h6 class="title">@lang('system.proposal request')</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#videotour">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-map-marked-alt"></i></div>
                        <div class="text">
                            <p>@lang('system.watch')</p>
                            <h6 class="title">@lang('system.video tour')</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="/asset/brochure/323829b435(Comp) eBrochure - JIIPE Brochure English.pdf" target="_blank">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>@lang('system.download')</p>
                            <h6>@lang('system.jiipe e-brochure')</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#faq">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-comment-alt"></i></div>
                        <div class="text">
                            <p>@lang('system.frequently')</p>
                            <h6>@lang('system.ask questions')</h6>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</section>
<style>
    .video-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        background: #000;
    }

    .video-wrapper video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-skeleton {
        position: absolute;
        inset: 0;
        z-index: 5;
    }

    .skeleton {
        width: 100%;
        height: 100%;
        background: linear-gradient(100deg,
                #f7f7f7 35%,
                #e0e0e0 50%,
                #f7f7f7 65%);
        background-size: 200% 100%;
    }


    .shimmer {
        animation: shimmer 1.3s infinite linear;
    }

    @keyframes shimmer {
        to {
            background-position: -200% 0;
        }
    }
</style>
<script>
    $(document).ready(function() {

        var homeSlider = $('.home-box').owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 8000,
            smartSpeed: 1000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            onInitialized: loadAndPlayVideo,
            onTranslated: loadAndPlayVideo
        });

        function loadAndPlayVideo() {
            stopAllVideos();

            var $active = $('.home-box .owl-item.active');
            var video = $active.find('video').get(0);
            var source = $active.find('source');
            var skeleton = $active.find('.video-skeleton');

            if (!video || !source.length) return;

            if (!source.attr('src')) {
                source.attr('src', source.data('src'));
                video.load();
            }

            skeleton.show();

            video.oncanplay = function() {
                skeleton.fadeOut(400);
                video.currentTime = 0;
                video.play().catch(() => {});
            };
        }

        function stopAllVideos() {
            $('.home-box video').each(function() {
                this.pause();
                this.currentTime = 0;
            });
        }

        $('.home-box video').prop('muted', true).attr({
            playsinline: '',
            'webkit-playsinline': ''
        });

        $('.home-box video').on('ended', function() {
            homeSlider.trigger('next.owl.carousel');
        });

    });
</script>
