<div class="block-sliders-coverKawasan prelatife prelative mb-4">
    <div id="carouselKawasan" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
        <div class="carousel-inner">
            @foreach ($areas ?? [] as $index => $area)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" ns_image="{{ $area['image'] ?? '' }}">
                    {{-- @dd($area['image_thumb']) --}}
                    <img src="{{ asset($area['image_thumb'] ?? '') }}" class="d-block w-100"
                        alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                </div>
            @endforeach
        </div>
    </div>

    {{-- Bottom Info Blocks --}}
    <div class="blocks_inner_bottominfo">
        <div class="row">
            @foreach ($areas ?? [] as $index => $area)
                <div class="col-md-20">
                    <div class="in_block bind_data_{{ $index }} {{ $index === 0 ? 'active' : '' }}"
                        data-attr="{{ $index }}">
                        <span class="lefts_nm">{{ $area['name'] ?? '' }}</span>
                        @if (!empty($area['size']))
                            <span class="luas">{{ $area['size'] }}<small>ha</small></span>
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
