{{-- filepath: resources/views/layouts/client/home/tenant_section.blade.php --}}
{{-- Tenants Section - FIXED VERSION (No syntax error) --}}
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
                                // ⚡ NO USE STATEMENT - Langsung pakai full namespace
                                $logoPath = 'uploads/tenant-logo/' . $tenant['logo'];
                                $optimizedLogo = \App\Helpers\ImageOptimizer::optimizeTenantLogo($logoPath, 'thumbnail');

                                // Check if WebP version exists
                                $isWebP = pathinfo($optimizedLogo, PATHINFO_EXTENSION) === 'webp';

                                // Loading strategy: eager untuk 3 pertama, lazy sisanya
                                $loading = $index < 3 ? 'eager' : 'lazy';
                                $fetchpriority = $index < 3 ? 'high' : 'auto';
                            @endphp

                            @if($isWebP)
                                {{-- Jika sudah WebP, langsung pakai --}}
                                <img
                                    class="img-thumbnail"
                                    src="{{ asset($optimizedLogo) }}"
                                    alt="{{ $tenant['name'] }}"
                                    loading="{{ $loading }}"
                                    fetchpriority="{{ $fetchpriority }}"
                                    width="200"
                                    height="150"
                                >
                            @else
                                {{-- WebP dengan fallback untuk browser lama --}}
                                <picture>
                                    @php
                                        // Try to get WebP version
                                        $webpPath = \App\Helpers\ImageOptimizer::generateWebP($logoPath);
                                    @endphp

                                    @if($webpPath)
                                        <source srcset="{{ asset($webpPath) }}" type="image/webp">
                                    @endif

                                    <source srcset="{{ asset($optimizedLogo) }}" type="image/{{ pathinfo($optimizedLogo, PATHINFO_EXTENSION) === 'png' ? 'png' : 'jpeg' }}">

                                    <img
                                        class="img-thumbnail"
                                        src="{{ asset($optimizedLogo) }}"
                                        alt="{{ $tenant['name'] }}"
                                        loading="{{ $loading }}"
                                        fetchpriority="{{ $fetchpriority }}"
                                        width="200"
                                        height="150"
                                    >
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
    /* Tenant Section Fixes */
    #tenants {
        padding: 30px 0;
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

    #tenants .swiper-slide img,
    #tenants .swiper-slide picture {
        width: auto;
        max-width: 100%;
    }

    #tenants .swiper-slide img {
        height: 80px;
        object-fit: contain;
        transition: all 0.3s ease;
        /* border: 1px solid #e0e0e0; */
        border-radius: 8px;
        padding: 10px;
        background: #fff;

        /* ⚡ Prevent layout shift */
        aspect-ratio: 4/3;
    }

    #tenants .swiper-slide img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* ⚡ Lazy loading placeholder */
    #tenants .swiper-slide img[loading="lazy"] {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
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

                // ⚡ Lazy loading configuration
                lazy: {
                    loadPrevNext: true,
                    loadPrevNextAmount: 2,
                },

                // ⚡ Preload images only when needed
                preloadImages: false,
                watchSlidesVisibility: true,

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