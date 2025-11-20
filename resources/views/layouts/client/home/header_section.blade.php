<section class="home-slider creative">
    <div class="homewrapper">
        {{-- @if($setting['section1_home_creative_slider_show'] == 0)
            @include('partials._slider_video_new')
        @else
            @include('partials._slider_images_new')
        @endif --}}
    </div>

    <div class="navigasi-box navigasi-box-shadow navigasi-box-border-bottom">
        <ul>
            <li class="hover">
                <a href="#contact">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-calendar-alt"></i></div>
                        <div class="text">
                            <p>@lang('system.quick appointment')</p>
                            <h6 class="title">@lang('system.proposal request')</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#videotour">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-map-marked-alt"></i></div>
                        <div class="text">
                            <p>@lang('system.watch')</p>
                        <h6 class="title">@lang('system.video tour')</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" target="_blank" class="hashmb d-none">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>@lang('system.download')</p>
                            <h6>@lang('system.jiipe e-brochure')</h6>
                        </div>
                    </div>
                </a>
                <a href="#" target="_blank" class="hashds">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>@lang('system.download')</p>
                            <h6>@lang('system.jiipe e-brochure')</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#faq">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-comment-alt"></i></div>
                        <div class="text">
                            <p>@lang('system.frequently')</p>
                        <h6>@lang('system.ask questions')</h6>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</section>

{{-- Kawasan Slider --}}
<section class="kawasan-slider">
    <div id="kawasan_wrapper_one" class="kawasan-slider-one carousel slide" data-ride="carousel" data-interval="6000">
        <div class="carousel-inner">
            {{-- @foreach($models_kawasan as $key => $value)
                <div class="carousel-item @if($key==0) active @endif">
                    <img src="{{ asset('asset/masterplant-picture/'.$value->image) }}" class="d-block w-100" alt="JIIPE Kawasan Industri Gresik">
                </div>
            @endforeach --}}
        </div>
    </div>

    <ol class="carousel-indicators">
        {{-- @foreach($models_kawasan as $key => $value)
            <li data-target="#kawasan_wrapper_one" data-slide-to="{{ $key }}" class="data_{{ $key }} @if($key==0) active @endif">
                <div class="wrapper-box">
                    <h4 class="title">{{ $value->description->title }}</h4>
                    <span class="area">{{ $value->luas }}<small>{{ $value->description->satuan }}</small></span>
                </div>
            </li>
        @endforeach --}}
    </ol>
</section>

{{-- Profile Section --}}
<section class="profile-jiipe">
    <div class="prelative container py-5">
        <div class="row">
            <div class="col-lg-30 col-sm-60">
                <div class="jiipe-images">

                </div>
            </div>
            <div class="col-lg-30 col-sm-60">
                <div class="jiipe-content px-lg-5 px-sm-0">
                    <div class="jiipe-top">
                        {{-- <h1 class="jiipe-top-red">{{ $setting['section2_home_creative_toptitle'] }}</h1> --}}
                        {{-- {!! $setting['section2_home_creative_subcontent'] !!} --}}
                        <h2>section2_home_creative_subcontent</h2>

                        @if(!empty($setting['section2_home_creative_text_button1']) || !empty($setting['section2_home_creative_text_button2']))
                            <ul class="button">
                                @if(!empty($setting['section2_home_creative_text_button1']))
                                    <li>
                                        <a href="{{ $setting['section2_home_creative_link_button1'] }}">
                                            @if(!empty($setting['section2_home_creative_icon_button1']) && $setting['section2_home_creative_location_button1']==1)
                                                <i class="{{ $setting['section2_home_creative_icon_button1'] }}"></i>&nbsp;
                                            @endif
                                            {{ $setting['section2_home_creative_text_button1'] }}
                                            @if(!empty($setting['section2_home_creative_icon_button1']) && $setting['section2_home_creative_location_button1']==0)
                                                <i class="{{ $setting['section2_home_creative_icon_button1'] }}"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                                @if(!empty($setting['section2_home_creative_text_button2']))
                                    <li>
                                        <a href="{{ $setting['section2_home_creative_link_button2'] }}">
                                            @if(!empty($setting['section2_home_creative_icon_button2']) && $setting['section2_home_creative_location_button2']==1)
                                                <i class="{{ $setting['section2_home_creative_icon_button2'] }}"></i>&nbsp;
                                            @endif
                                            {{ $setting['section2_home_creative_text_button2'] }}
                                            @if(!empty($setting['section2_home_creative_icon_button2']) && $setting['section2_home_creative_location_button2']==0)
                                                <i class="{{ $setting['section2_home_creative_icon_button2'] }}"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- …LANJUTKAN BAGIAN LAIN DENGAN POLA YANG SAMA… --}}

{{-- Contoh video-jiipe --}}
<section class="video-jiipe" id="videojiipe">
    <div class="embed-responsive embed-responsive-21by9">
        @if(app()->getLocale() == 'cn')
            <video class="embed-responsive-item" controls>
                <source src="{{ asset('Video_jiipe/Company Profile JIIPE CINA - SUB English.mp4') }}" type="video/mp4">
            </video>
        @else
            <video class="embed-responsive-item" controls>
                <source src="{{ asset('Video_jiipe/section2_home_creative_video_profile') }}" type="video/mp4">
            </video>
        @endif
    </div>
</section>

{{-- Tambahkan section tenants, video-slider, testimonial, faq, blog sesuai pola di atas --}}

{{-- Google Ads tag --}}
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-447682676"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-447682676');
</script>