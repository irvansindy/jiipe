<section class="video-jiipe" id="tenants">
    <div class="prelative container my-5">
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-3">
                <h2 class="jiipe-main-header jiipe-main-red">{{ __('Our Tenants') }}</h2>
            </div>
        </div>
    </div>

    <div class="prelative container">
        <div class="patner-slider">
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @forelse($tenants as $index => $tenant)
                        <div class="swiper-slide">
                            @php
                                $loading = $index < 3 ? 'eager' : 'lazy';
                                $fetchpriority = $index < 3 ? 'high' : 'auto';
                            @endphp

                            @if ($tenant['is_webp'])
                                <img class="img-thumbnail" src="{{ asset($tenant['optimized_logo']) }}"
                                    alt="{{ $tenant['name'] }}" loading="{{ $loading }}"
                                    fetchpriority="{{ $fetchpriority }}" width="200" height="150">
                            @else
                                <picture>
                                    @if ($tenant['webp_path'])
                                        <source srcset="{{ asset($tenant['webp_path']) }}" type="image/webp">
                                    @endif
                                    <img class="img-thumbnail" src="{{ asset($tenant['optimized_logo']) }}"
                                        alt="{{ $tenant['name'] }}" loading="{{ $loading }}"
                                        fetchpriority="{{ $fetchpriority }}" width="200" height="150">
                                </picture>
                            @endif
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <p class="text-center">No tenant logo found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Navigation Buttons -->
                <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
                <!-- <div class="swiper-pagination"></div> -->
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>

<style>
    #tenants {
        padding: 10px 0;
        background: #fff;
    }

    #tenants .patner-slider {
        width: 100%;
        padding: 20px 0;
    }

    #tenants .mySwiper {
        width: 100%;
        padding: 20px 0;
    }

    #tenants .swiper-wrapper {
        display: flex;
        align-items: center;
    }

    #tenants .swiper-slide {
        display: flex !important;
        justify-content: center;
        align-items: center;
        height: auto;
        min-height: 100px;
    }

    /* ⚡ HAPUS box/border, biarkan logo natural */
    #tenants .swiper-slide img {
        height: 100px;
        width: auto;
        max-width: 190px;
        object-fit: contain;
        transition: all 0.3s ease;

        /* HAPUS semua ini yang bikin kotak */
        background: transparent;
        border: none !important;
        border-radius: 0;
        padding: 0;
        box-shadow: none;

        /* Hapus aspect-ratio agar ukuran natural */
        aspect-ratio: unset;

        /* Grayscale default, warna saat hover (opsional - mirip foto 1) */
        filter: grayscale(20%);
        opacity: 0.85;
    }

    #tenants .swiper-slide img:hover {
        transform: scale(1.08);
        filter: grayscale(0%);
        opacity: 1;
        box-shadow: none;
    }

    /* Hapus shimmer animation karena tidak pakai background */
    #tenants .swiper-slide img[loading="lazy"] {
        background: transparent;
        animation: none;
    }

    @media (max-width: 768px) {
        #tenants .swiper-slide img {
            height: 50px;
            max-width: 120px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initTenantSwiper() {
            if (typeof Swiper === 'undefined') {
                setTimeout(initTenantSwiper, 100);
                return;
            }

            // ⚡ Swiper 12: Harus register modules dulu
            if (Swiper.use) {
                // Swiper < 9 style
                Swiper.use([window.SwiperAutoplay].filter(Boolean));
            }

            var swiper = new Swiper("#tenants .mySwiper", {
                modules: window.SwiperAutoplay ? [window.SwiperAutoplay] : [],
                slidesPerView: 6,
                spaceBetween: 30,
                loop: true,
                speed: 5000,
                grabCursor: true,

                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },

                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 15
                    },
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 5,
                        spaceBetween: 25
                    },
                    1200: {
                        slidesPerView: 6,
                        spaceBetween: 30
                    },
                }
            });
        }

        initTenantSwiper();
    });
</script>
