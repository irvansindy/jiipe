<section class="industri-jiipe-sec-1">
    <div class="prelative container">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="@lang('system.Jiipe industrial estate gresik')">
                <p class="info">
                    @lang('system.Jiipe industrial estate')
                </p>

                {{-- Mobile Select Menu --}}
                <div class="side">
                    <div id="mytoSelect"></div>

                    {{-- Desktop Menu --}}
                    <div class="leftsn_menu">
                        <ul id="lists_leftmenuKawasan" class="list-unstyled d-none d-sm-block">
                            <li class="d-none">
                                <a href="#">@lang('system.select region')</a>
                            </li>
                            @foreach ($zones ?? [] as $zone)
                                <li class="">
                                    <a href="{{ route('area.detail', $zone['id']) }}">
                                        {{ $zone->translations[0]['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-45">
                <div class="title">
                    <p>
                        @lang('system.independent integrated industrial estate in gresik, indonesia - strategic and profitable')
                    </p>
                </div>

                <div class="content">
                    {{-- {!! $pageDescription ?? '' !!} --}}
                    @lang('system.industrial_jiipe_desc')
                </div>

                {{-- Area Carousel Component --}}
                @include('layouts.client.industrial-estate.sections.area-carousel')

                {{-- Area Cards Component --}}
                @include('layouts.client.industrial-estate.sections.area-cards')

                <hr class="artikel-brosur">
            </div>
        </div>
    </div>
</section>
@push('js')
    <script>
        $(function() {
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
                select.addEventListener('change', function(evt) {
                    location.href = this.options[this.selectedIndex].value;
                });

                $('#mytoSelect select').addClass('form-control');
            }
        });
    </script>
@endpush
