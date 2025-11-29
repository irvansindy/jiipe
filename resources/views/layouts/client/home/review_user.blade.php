<section class="comment-jiipe">
    <div class="prelative container">
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-3">
                <h2 class="jiipe-main-header jiipe-main-red">{{ __('What People Say About Us') }}</h2>
            </div>
        </div>
        <div class="clear"></div>

        <div class="testimonial-list owl-carousel owl-theme">
            @php
                $reviews = app(\App\Http\Controllers\Client\HomeController::class)->getReviews();
            @endphp
            @forelse($reviews as $review)
                <div class="card text-center">
                    <div class="card-body shadow-effect">
                        <span class="icon"><i class="fa fa-quote-right" aria-hidden="true"></i></span>
                        <p class="description">{{ $review['description'] }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="profile-card__img">
                            <img src="{{ asset('uploads/review/'.$review['photo']) }}" alt="{{ $review['name'] }}">
                        </div>
                        <div class="profile-card__info">
                            <h6>{{ $review['name'] }}</h6>
                            <p>{{ $review['position'] }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card text-center">
                    <div class="card-body">
                        <p>No reviews available.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="clear"></div>
    </div>
</section>

<script src="{{ asset('asset/js/owlslider/owl.carousel.min.js') }}"></script>
<script>
    $('.testimonial-list').owlCarousel({
        loop: true,
        margin: 60,
        nav: true,
        dots: true,
        center: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        navText: [
            '<i class="fa fa-chevron-left"></i>',
            '<i class="fa fa-chevron-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });
</script>