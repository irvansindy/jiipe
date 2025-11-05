<section class="video-slider pt-5" id="videotour">
    <div class="prelative container mb-5">
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-3">
                <h2 class="jiipe-main-header jiipe-main-red">Video Tour</h2>
            </div>
        </div>

        <div class="videotour-list owl-carousel owl-theme">
            @php
                $videoTours = app(\App\Http\Controllers\Client\HomeController::class)->getVideoTours();
            @endphp
            @forelse($videoTours as $tour)
                <div class="item">
                    <div class="video-wrapper">
                        {!! $tour['embed_code'] !!}
                        <div class="video-caption">
                            <h4>{{ $tour['title'] }}</h4>
                            <p>{{ $tour['description'] }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="item">
                    <p class="text-center">No video tours available.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="navigasi-box navigasi-box-shadow">
        <ul>
            <li>
                <a href="#contact">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon">
                            <i class="fa fa-calendar-alt"></i>
                        </div>
                        <div class="text">
                            <p>Quick Appointment</p>
                            <h6 class="title">PROPOSAL REQUEST</h6>
                        </div>
                    </div>
                </a>
            </li>
            <!-- Other navigation items remain unchanged -->
        </ul>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</section>

<script>
    $(document).ready(function(){
        $('.videotour-list').owlCarousel({
            loop: true,
            margin: 60,
            nav: true,
            dots: false,
            center: true,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                    stagePadding: 30
                },
                768: {
                    items: 1,
                    stagePadding: 50
                },
                1024: {
                    items: 1,
                    stagePadding: 100
                }
            },
            navText: [
                '<i class="fa fa-chevron-left"></i>',
                '<i class="fa fa-chevron-right"></i>'
            ]
        });

        $('.owl-prev').click(function() {
            $('.videotour-list').trigger('prev.owl.carousel');
        });

        $('.owl-next').click(function() {
            $('.videotour-list').trigger('next.owl.carousel');
        });
    });
</script>
<style>
    .video-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .video-caption {
        padding: 15px;
        background: rgba(255,255,255,0.95);
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .video-caption h4 {
        margin: 0;
        color: #333;
        font-size: 1.2em;
    }
    .video-caption p {
        margin: 8px 0 0;
        color: #666;
        font-size: 0.9em;
    }
</style>