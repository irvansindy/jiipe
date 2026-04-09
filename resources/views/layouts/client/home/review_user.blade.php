{{-- filepath: resources/views/layouts/client/home/review_user.blade.php --}}
{{-- Review Section - TAMPILAN TETAP SEPERTI ASLI (Center Mode), HANYA TAMBAH LAZY LOADING --}}
<section class="comment-jiipe">
    <div class="prelative container">
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-3">
                <h2 class="jiipe-main-header jiipe-main-red">{{ __('What People Say About Us') }}</h2>
            </div>
        </div>
        <div class="clear"></div>

        <div class="testimonial-list swiper">
            <div class="swiper-wrapper">
                @forelse($reviews as $index => $review)
                    <div class="swiper-slide card text-center">
                        <div class="card-body shadow-effect">
                            <span class="icon"><i class="fa fa-quote-right" aria-hidden="true"></i></span>
                            <p class="description">{{ $review['description'] }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="profile-card__img">
                                <img src="{{ asset('uploads/review/' . $review['photo']) }}" alt="{{ $review['name'] }}"
                                    loading="lazy" width="80" height="80">
                            </div>
                            <div class="profile-card__info">
                                <h6>{{ $review['name'] }}</h6>
                                <p>{{ $review['position'] }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide card text-center">
                        <div class="card-body">
                            <p>No reviews available.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            {{-- Navigation --}}
            <div class="swiper-button-next" aria-label="Next slide"></div>
            <div class="swiper-button-prev" aria-label="Previous slide"></div>
            {{-- Pagination --}}
            <div class="swiper-pagination"></div>
        </div>


        <div class="clear"></div>
    </div>
</section>

<style>
    /* Swiper custom styling for testimonials */
    .testimonial-list {
        padding: 40px 0 60px;
    }

    .testimonial-list .swiper-slide {
        height: auto;
        opacity: 0.4;
        transition: transform 0.3s, opacity 0.3s;
    }

    .testimonial-list .swiper-slide-active,
    .testimonial-list .swiper-slide-next,
    .testimonial-list .swiper-slide-prev {
        opacity: 1;
    }

    @media (min-width: 992px) {
        .testimonial-list .swiper-slide-active {
            transform: scale(1.1);
            z-index: 2;
        }
        .testimonial-list .swiper-slide-active .card-body {
            background: #53565a !important;
            color: #fff !important;
        }
    }

    @media (max-width: 991px) {
        .comment-jiipe .testimonial-list .swiper-slide {
            opacity: 1 !important;
            display: flex !important;
            flex-direction: column !important;
        }

        .comment-jiipe .testimonial-list .card-body {
            background: #53565a !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            padding: 24px 20px !important;
        }

        .comment-jiipe .testimonial-list .card-body .description {
            color: #ffffff !important;
            font-weight: 500 !important;
            font-size: 12px !important;
            line-height: 26px !important;
            text-align: center !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const testimonialSwiper = new Swiper('.testimonial-list', {
            loop: true,
            speed: 800,
            centeredSlides: true,
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                    centeredSlides: false,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 60,
                    centeredSlides: true,
                }
            }
        });
    });
</script>

