<section class="industri-jiipe-sec-1">
    <div class="prelative container">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <p class="info">
                    {{ __('JIIPE Industrial Estate') }}
                </p>

                {{-- Mobile Select Menu --}}
                <div class="side">
                    <div id="mytoSelect"></div>

                    {{-- Desktop Menu --}}
                    <div class="leftsn_menu">
                        <ul id="lists_leftmenuKawasan" class="list-unstyled d-none d-sm-block">
                            <li class="d-none">
                                <a href="#">{{ __('-- Select Region --') }}</a>
                            </li>
                            @foreach ($areas ?? [] as $area)
                                <li>
                                    <a href="{{ route('area.detail', $area['id']) }}">
                                        {{ $area['name'] }}
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
                    <p>{{ $pageTitle ?? __('Independent Integrated Industrial Estate in Gresik, Indonesia - Strategic and Profitable') }}
                    </p>
                </div>

                <div class="content">
                    {!! $pageDescription ?? '' !!}
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
$(function(){
    if ($(window).width() < 767) {
        var myform = document.getElementById('mytoSelect'),
            items = document.getElementById('lists_leftmenuKawasan').getElementsByTagName('li'),
            select = document.createElement('select'),
            len = items.length;

        for(var i = 0; i < len; i++) {
            var option = document.createElement('option');
            var label = items[i].textContent.replace(/\s\s+/g," ").trim(),
                link = items[i].getElementsByTagName('a')[0].href;

            option.textContent = label;
            option.value = link;
            select.appendChild(option);
        }

        myform.appendChild(select);
        select.addEventListener('change', function(evt){
            location.href = this.options[this.selectedIndex].value;
        });

        $('#mytoSelect select').addClass('form-control');
    }
});
</script>
@endpush