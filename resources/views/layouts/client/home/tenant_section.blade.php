{{-- filepath: resources/views/layouts/client/home/tenant_section.blade.php --}}
{{-- Tenants Section - TAMPILAN TETAP SEPERTI ASLI, HANYA TAMBAH LAZY LOADING --}}
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
            @php
                $tenants = app(\App\Http\Controllers\Client\HomeController::class)->getTenants();
            @endphp
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @forelse($tenants as $index => $tenant)
                        <div class="swiper-slide">
                            {{-- ⚡ HANYA TAMBAH LAZY LOADING - TAMPILAN TETAP SAMA --}}
                            @if ($index < 6)
                                {{-- First 6 logos load immediately --}}
                                <img class="img-thumbnail" src="{{ asset('uploads/tenant-logo/' . $tenant['logo']) }}"
                                    alt="{{ $tenant['name'] }}" loading="{{ $index < 3 ? 'eager' : 'lazy' }}">
                            @else
                                {{-- Rest lazy load --}}
                                <img class="img-thumbnail" src="{{ asset('uploads/tenant-logo/' . $tenant['logo']) }}"
                                    alt="{{ $tenant['name'] }}" loading="lazy">
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
    /* Tenant Section Fixes */
    #tenants {
        padding: 40px 0;
        background: #f8f9fa;
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
        min-height: 120px;
    }

    #tenants .swiper-slide img {
        width: auto;
        max-width: 100%;
        height: 80px;
        object-fit: contain;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px;
        background: #fff;
    }

    #tenants .swiper-slide img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Navigation Buttons (if enabled) */
    #tenants .swiper-button-next,
    #tenants .swiper-button-prev {
        color: #e31e24;
        background: rgba(255, 255, 255, 0.9);
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    #tenants .swiper-button-next:after,
    #tenants .swiper-button-prev:after {
        font-size: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #tenants .swiper-slide img {
            height: 60px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ⚡ Wait for Swiper to load
        function initTenantSwiper() {
            if (typeof Swiper === 'undefined') {
                setTimeout(initTenantSwiper, 100);
                return;
            }

            var swiper = new Swiper("#tenants .mySwiper", {
                slidesPerView: 6,
                spaceBetween: 20,
                loop: true,
                centeredSlides: false,
                speed: 800,
                watchSlidesProgress: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 15
                    },
                    1024: {
                        slidesPerView: 5,
                        spaceBetween: 20
                    },
                    1200: {
                        slidesPerView: 6,
                        spaceBetween: 20
                    }
                }
            });
        }

        initTenantSwiper();
    });
</script>
