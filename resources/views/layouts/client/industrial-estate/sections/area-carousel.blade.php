<div class="block-sliders-coverKawasan relative mb-4">
    <div id="carouselKawasan" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach ($zones ?? [] as $index => $zone)
                @php $trans = $zone->translations->first() @endphp
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('uploads/zones/' . ($zone->image ?? '')) }}" class="d-block w-100"
                        alt="{{ $trans->name ?? 'JIIPE Industrial Estate Gresik' }}" decoding="async"
                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                </div>
            @endforeach
        </div>
    </div>

    <div class="blocks_inner_bottominfo">
        <div class="row">
            @foreach ($zones ?? [] as $index => $zone)
                @php $trans = $zone->translations->first() @endphp
                <div class="col-md-20">
                    <div class="in_block {{ $index === 0 ? 'active' : '' }}" data-attr="{{ $index }}">
                        <span class="lefts_nm">{{ $trans->name ?? '' }}</span>
                        @if (!empty($trans->area_size))
                            <span class="luas" style="font-size: 26px !important;">
                                {{ $trans->area_size }}
                            </span>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="clear"></div>
</div>

@push('css')
<style>
    #carouselKawasan .carousel-item {
        display: block !important;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
        z-index: 1;
        pointer-events: none;
    }

    #carouselKawasan .carousel-item.active {
        opacity: 1;
        z-index: 2;
        position: relative;
        pointer-events: auto;
    }

    /* Tab bottom info transition */
    .blocks_inner_bottominfo .in_block {
        opacity: 0.5;
        transform: translateY(4px);
        transition: opacity 0.4s ease, transform 0.4s ease;
        cursor: pointer;
    }

    .blocks_inner_bottominfo .in_block.active {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function () {
        const $items  = $('#carouselKawasan .carousel-item');
        const $blocks = $('.blocks_inner_bottominfo .in_block');
        let currentIndex = 0;
        let autoSlide;
        let isTransitioning = false;

        function goTo(index) {
            if (isTransitioning || index === currentIndex) return;

            isTransitioning = true;

            const $current = $items.eq(currentIndex);
            const $next    = $items.eq(index);

            // Fade out current, fade in next
            $current.css({ opacity: 0, 'z-index': 1, position: 'absolute' });
            $next.addClass('active').css({ opacity: 0, 'z-index': 2, position: 'relative' });

            // Trigger reflow supaya transition jalan
            $next[0].offsetHeight;

            $next.css('opacity', 1);

            setTimeout(function () {
                $current.removeClass('active');
                isTransitioning = false;
            }, 800); // sama dengan transition duration CSS

            // Update index & tab
            currentIndex = index;

            $blocks.removeClass('active');
            $blocks.filter('[data-attr="' + currentIndex + '"]').addClass('active');
        }

        function next() {
            const nextIndex = (currentIndex + 1) % $items.length;
            goTo(nextIndex);
        }

        function startAuto() {
            stopAuto();
            autoSlide = setInterval(next, 6000);
        }

        function stopAuto() {
            clearInterval(autoSlide);
        }

        // Klik tab
        $blocks.on('click', function () {
            const idx = parseInt($(this).attr('data-attr'), 10);
            stopAuto();
            goTo(idx);
            startAuto();
        });

        // Init — set posisi awal tanpa animasi
        $items.eq(0).addClass('active').css('opacity', 1);
        $blocks.filter('[data-attr="0"]').addClass('active');

        startAuto();
    });
</script>
@endpush