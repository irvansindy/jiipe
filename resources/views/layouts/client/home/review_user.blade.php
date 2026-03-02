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

        <div class="testimonial-list owl-carousel owl-theme">
            @forelse($reviews as $index => $review)
                <div class="card text-center">
                    <div class="card-body shadow-effect">
                        <span class="icon"><i class="fa fa-quote-right" aria-hidden="true"></i></span>
                        <p class="description">{{ $review['description'] }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="profile-card__img">
                            {{-- ⚡ HANYA TAMBAH LAZY LOADING - TAMPILAN TETAP SAMA --}}
                            <img src="{{ asset('uploads/review/' . $review['photo']) }}" alt="{{ $review['name'] }}"
                                loading="{{ $index < 3 ? 'eager' : 'lazy' }}">
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

{{-- <style>
    /* ⚡ KEEP ORIGINAL STYLING - NO BLUR ON MOBILE */
    @media (max-width: 991px) {
        .comment-jiipe .testimonial-list .owl-item {
            opacity: 1 !important;
            filter: none !important;
            transform: none !important;
            display: flex !important;
            flex-direction: column !important;
        }

        .comment-jiipe .testimonial-list .owl-item .card {
            background: transparent !important;
            opacity: 1 !important;
            filter: none !important;
            display: flex !important;
            flex-direction: column !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        .comment-jiipe .testimonial-list .owl-item .card-body {
            background: #53565a !important;
            color: #ffffff !important;
            opacity: 1 !important;
            filter: none !important;
            border-radius: 12px !important;
            padding: 24px 20px !important;
            box-sizing: border-box !important;
            width: 100% !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;
        }

        .comment-jiipe .testimonial-list .owl-item .card-body * {
            opacity: 1 !important;
            color: #ffffff !important;
        }

        .comment-jiipe .testimonial-list .owl-item .card-body .description {
            color: #ffffff !important;
            opacity: 1 !important;
            font-size: 14px !important;
            line-height: 1.6 !important;
            margin-bottom: 0 !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;
        }

        .comment-jiipe .testimonial-list .owl-item .card-footer {
            background: #ffffff !important;
            opacity: 1 !important;
        }

        .comment-jiipe .testimonial-list .owl-item.cloned {
            opacity: 1 !important;
            filter: none !important;
        }

        .comment-jiipe .testimonial-list .owl-item.cloned .card-body {
            opacity: 1 !important;
            filter: none !important;
        }

        /* Fix owl stage agar tidak clip */
        .comment-jiipe .testimonial-list .owl-stage {
            display: flex !important;
            align-items: stretch !important;
        }
    }

    /* Desktop - CENTER MODE ACTIVE */
    @media (min-width: 992px) {
        .comment-jiipe .testimonial-list .owl-item.active.center .card-body {
            background: #53565a !important;
        }
    }
</style> --}}

<script>
    // ⚡ Wait for jQuery and OwlCarousel to load
    (function initReviewCarousel() {
        if (typeof $ === 'undefined' || typeof $.fn.owlCarousel === 'undefined') {
            setTimeout(initReviewCarousel, 100);
            return;
        }

        $(document).ready(function() {
            console.log('Initializing testimonial carousel...');

            var $carousel = $('.testimonial-list');

            // Destroy existing instance if any
            if ($carousel.hasClass('owl-loaded')) {
                $carousel.trigger('destroy.owl.carousel');
                $carousel.removeClass('owl-loaded owl-drag');
            }

            // ⚡ Initialize dengan CENTER MODE untuk desktop
            $carousel.owlCarousel({
                loop: true,
                margin: 60,
                nav: true,
                dots: true,
                center: true, // ✅ CENTER MODE AKTIF untuk desktop
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                navText: [
                    '<i class="fa fa-chevron-left"></i>',
                    '<i class="fa fa-chevron-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 1,
                        center: false, // ❌ Center OFF untuk mobile (agar tidak blur)
                        margin: 20
                    },
                    768: {
                        items: 2,
                        center: false, // ❌ Center OFF untuk tablet
                        margin: 40
                    },
                    992: {
                        items: 3,
                        center: true, // ✅ Center ON untuk desktop (sesuai foto 3)
                        margin: 60
                    }
                },
                onInitialized: function(event) {
                    console.log('Owl Carousel initialized successfully!');
                    console.log('Active items:', event.item.count);
                },
                onTranslated: function(event) {}
            });
        });
    })();
</script>
