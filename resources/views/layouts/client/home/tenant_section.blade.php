{{-- Tenants Section --}}
<section class="video-jiipe" id="tenants">
    <div class="prelative container my-5">
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-3">
                <h2 class="jiipe-main-header jiipe-main-red">{{ __('Our Tenants') }}</h2>
            </div>
        </div>
    </div>

    <div class="prelative container">
        <div class="patner-slider dtr-slick-slider slick-initialized slick-slider">
            @php
                $tenants = [
                    '0df79-Xinyi Glass.png',
                    '1cac5-Bank Indonesia.png',
                    '3b87a-ambercycle.png',
                    '4bf00-Sari_Roti-Rotinya_Indonesia.png',
                    '4ea03-XYG.png',
                    '4f05b-clariant.png',
                    '5a7de-Sari Roti 2.png',
                    '5d0ed-logo-fullname.PNG',
                    '6d10c-tirta bahagia.png',
                    '7abab-hailiang英文LOGO.png',
                    '9efd6-PT Freeport Indonesia.png',
                    '29f31-hailiang英文LOGO.png',
                    '38d69-hailiang英文LOGO-1.png',
                    '41c8c-Freeport Indonesia.png',
                    '46c37-Logo PCI.png',
                    '46e69-19 - Hebang Biotechnology Indonesia.png',
                    '49eea-hailiang英文LOGO.png',
                    '80ba7-waskita.png',
                    '099f5-Bank Indonesia.png',
                    '333d0-Hailiang.png',
                    '467c2-XINYI Glass logo.png',
                    '682ef-hailiang.png',
                    '0834f-BJTI.png',
                ];
            @endphp
            {{-- <div class="slick-list draggable" style="padding: 0px;">
                <div class="slick-track"
                    style="opacity: 1; width: 100000px; transform: translate(-3024px, 0px, 0px); transition: transform 500ms;">
                    @forelse($tenants as $tenant)
                        <div class="patner-items">
                            <img class="img-thumbnail" src="{{ asset('asset/tenant/' . $tenant) }}" alt="logo">
                        </div>
                    @empty
                        <p>No tenant logo found.</p>
                    @endforelse

                </div>
            </div> --}}
            <div class="">
                <!-- Swiper -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @forelse($tenants as $tenant)
                            <div class="swiper-slide">
                                <img class="img-thumbnail" src="{{ asset('storage/tenant-logo/' . $tenant) }}"
                                    alt="logo">
                            </div>
                        @empty
                            <p>No tenant logo found.</p>
                        @endforelse
                    </div>

                    <!-- Navigasi -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </div>

    </div>
    <div class="clear"></div>
</section>
<style>
    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        width: auto;
        /* biar proporsi asli */
        height: 80px;
        /* semua logo tingginya seragam */
        object-fit: contain;
        /* muat tanpa distorsi */
        /* filter: grayscale(100%); */
        /* opsional: abu-abu */
        transition: all 0.3s ease;
    }

    .swiper-slide img:hover {
        filter: grayscale(0%);
        /* jadi full color kalau hover */
        transform: scale(1.05);
        /* efek zoom halus */
    }
</style>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 6,  // tampilkan 6 logo
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        // pagination: {
        //     el: ".swiper-pagination",
        //     clickable: true,
        // },
        // navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        // },
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
                slidesPerView: 6,
                spaceBetween: 20
            },
        }
    });
</script>
