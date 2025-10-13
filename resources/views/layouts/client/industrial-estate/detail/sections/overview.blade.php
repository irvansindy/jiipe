<section class="industri_jippe1-sec-1">
    <div class="prelative container">
        <div class="row">
            {{-- Sidebar Navigation --}}
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <p class="info">
                    {{ __('JIIPE Industrial Estate') }}
                </p>

                <div class="side">
                    <div id="mytoSelect"></div>

                    <div class="leftsn_menu">
                        <ul id="lists_leftmenuKawasan" class="list-unstyled d-none d-sm-block">
                            <li class="d-none">
                                <a href="#">{{ __('-- Select Region --') }}</a>
                            </li>
                            @foreach ($allAreas ?? [] as $areaItem)
                                <li class="{{ $areaItem['id'] == $area['id'] ? 'active' : '' }}">
                                    <a href="{{ route('area.detail', $areaItem['id']) }}">
                                        {{ $areaItem['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-45">
                <div class="judul">
                    <p>
                        {{ $area['name'] ?? '' }}
                        <span>|</span>
                        <span>{{ $area['size'] ?? '' }} ha {{ __('land area') }}</span>
                    </p>
                </div>

                <div class="sub-judul">
                    <p>{{ $area['subtitle'] ?? '' }}</p>
                </div>

                <div class="content">
                    <p>{!! $area['description'] ?? '' !!}</p>
                </div>

                <div class="industry">
                    <p>{{ $area['name'] ?? '' }} {{ __('Clustering') }}:</p>
                </div>

                {{-- Clustering Selector --}}
                <div class="choose-industry selector_slides">
                    <p>
                        @foreach ($area['clusterings'] ?? [] as $index => $clustering)
                            <a data-id="{{ $index }}"
                                class="itms_c{{ $index }} {{ $index === 0 ? 'active' : '' }}" href="#">
                                {{ $clustering['name'] }}
                            </a>
                            @if (!$loop->last)
                                <span>|</span>
                            @endif
                        @endforeach
                    </p>
                </div>

                {{-- Clustering Carousel --}}
                <div class="block-sliders-coverKawasan prelatife prelative mb-5">
                    <div id="carouselKawasan" class="carousel carousel-fade" data-ride="carousel" data-interval="3500">
                        <div class="carousel-inner">
                            @foreach ($area['clusterings'] ?? [] as $index => $clustering)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $clustering['image'] ?? '' }}" class="d-block w-100"
                                        alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
</section>

@push('js')
    <script>
        $(function() {
            // Mobile select menu
            if ($(window).width() < 767) {
                var myform = document.getElementById('mytoSelect'),
                    items = document.getElementById('lists_leftmenuKawasan').getElementsByTagName('li'),
                    select = document.createElement('select'),
                    len = items.length;

                for (var i = 0; i < len; i++) {
                    var option = document.createElement('option');
                    var label = items[i].textContent.replace(/\s\s+/g, " ").trim(),
                        link = items[i].getElementsByTagName('a')[0].href;

                    option.textContent = label;
                    option.value = link;
                    select.appendChild(option);
                }

                myform.appendChild(select);
                $('#mytoSelect select').addClass('form-control');
                $('#mytoSelect select').change(function(e) {
                    location.href = $(this).val();
                });
            }

            // Carousel sync with selector
            $('#carouselKawasan').bind('slid.bs.carousel', function(e) {
                var currentIndex = $('div.active').index();
                $('.selector_slides a').removeClass('active');
                $('.selector_slides a.itms_c' + currentIndex).addClass('active');
            });

            // Click selector to change carousel
            $('.selector_slides a').on('click', function(e) {
                e.preventDefault();
                var sactiven = parseInt($(this).attr('data-id'));
                $('.selector_slides a').removeClass('active');
                $(this).addClass('active');
                $('#carouselKawasan').carousel(sactiven);
            });
        });
    </script>
@endpush
