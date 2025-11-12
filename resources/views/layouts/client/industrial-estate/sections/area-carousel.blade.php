<div class="block-sliders-coverKawasan prelatife prelative mb-4">
    <div id="carouselKawasan" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
        <div class="carousel-inner">
            {{-- @php
                dd($zones)
            @endphp --}}
            @foreach ($zones ?? [] as $index => $zone)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" ns_image="{{ $zone['image'] ?? '' }}">
                    <img src="{{ asset('storage/zone/'.$zone['image'] ?? '') }}" class="d-block w-100" alt="{{ __('JIIPE Industrial Estate Gresik') }}" decoding="async" loading="lazy">
                </div>
            @endforeach
        </div>
    </div>

    {{-- Bottom Info Blocks --}}
    <div class="blocks_inner_bottominfo">
        <div class="row">
            {{-- @php
                dd($zones)
            @endphp --}}
            @foreach ($zones ?? [] as $index => $zone)
                <div class="col-md-20">
                    <div class="in_block bind_data_{{ $index }} {{ $index === 0 ? 'active' : '' }}" data-attr="{{ $index }}">
                        <span class="lefts_nm">{{ $zone->translations[0]['name'] ?? '' }}</span>
                        @if (!empty($zone->translations[0]['area_size']))
                            <span class="luas" style="font-size: 26px !important;">{{ $zone->translations[0]['area_size'] ?? '' }}</span>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="clear"></div>
</div>

@push('js')
    <script>
        $(function() {
            $('#carouselKawasan').bind('slid.bs.carousel', function(e) {
                var currentIndex = $('div.active').index();

                $('.blocks_inner_bottominfo .in_block.active').removeClass('active');
                $('.blocks_inner_bottominfo .in_block.bind_data_' + currentIndex).addClass('active');
            });

            $('.blocks_inner_bottominfo .in_block').on('click', function() {
                var sactiven = parseInt($(this).attr('data-attr'));
                $('.blocks_inner_bottominfo .in_block.active').removeClass('active');
                $(this).addClass('active');
                $('#carouselKawasan').carousel(sactiven);
            });
        });
    </script>
@endpush
