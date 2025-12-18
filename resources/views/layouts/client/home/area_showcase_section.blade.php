{{-- ============================================
     area_showcase_section.blade.php (OPTIMIZED)
     ============================================ --}}
<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">

<section class="kawasan-slider">
    <div id="kawasan_wrapper_one" class="kawasan-slider-one carousel slide" data-ride="carousel" data-interval="6000">
        <div class="carousel-inner">
            @foreach ($showcases as $i => $showcase)
                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                    {{-- ⚡ LAZY LOADING: First image eager, rest lazy --}}
                    <img src="{{ $i === 0 ? asset('uploads/showcase/'.$showcase['image']) : '' }}"
                         {{ $i === 0 ? '' : 'loading=lazy data-src=' . asset('uploads/showcase/'.$showcase['image']) }}
                         class="d-block w-100"
                         alt="{{ $showcase['title'] }}">
                </div>
            @endforeach
        </div>
    </div>
    <ol class="carousel-indicators">
        @foreach ($showcases as $i => $showcase)
            <li data-target="#kawasan_wrapper_one" data-slide-to="{{ $i }}" data-attr="{{ $i }}"
                class="data_{{ $i }} {{ $i == 0 ? 'active' : '' }}">
                <div class="wrapper-box">
                    <h4 class="title">{{ $showcase['title'] }}</h4>
                    <span class="area">{{ $showcase['description'] }}</span>
                </div>
            </li>
        @endforeach
    </ol>
</section>

<section class="profile-jiipe">
    <div class="prelative container py-5">
        <div class="row">
            <div class="col-lg-30 col-sm-60">
                <div class="jiipe-images">
                    {{-- Encode URL dengan benar untuk handle spasi --}}
                    <img src="{{ asset('uploads/blog/' . rawurlencode('ab135-JIIPE INVESTOR UPDATE (website).jpg')) }}"
                        class="img-fluid"
                        alt="JIIPE Profile"
                        loading="lazy"
                        onerror="this.onerror=null; this.src='{{ asset('uploads/blog/ab135-JIIPE INVESTOR UPDATE (website).jpg') }}';">
                </div>
            </div>
            <div class="col-lg-30 col-sm-60">
                <div class="jiipe-content px-lg-5 px-sm-0">
                    <div class="jiipe-top">
                        <h1 class="jiipe-top-red">@lang('system.why jiipe')?</h1>
                        <p>
                            Discover the industrial hub redefining investment in Southeast Asia! Located in Gresik, East
                            Java, JIIPE is not just another Special Economic Zone (SEZ); it's Indonesia's "Best
                            Industrial SEZ", hosting global giants like Hailiang Group, Sichuan Hebang, Xinyi Glass,
                            Xinyi Solar, and Freeport Indonesia.
                        </p>
                        <p><strong>What's the secret behind JIIPE's success?</strong></p>
                        <p>
                            A fully integrated ecosystem that boosts efficiency, slashes logistics costs, and delivers
                            unmatched connectivity via its deep-sea port. Add to this the fiscal perks and seamless
                            one-stop licensing backed by the Indonesian government, and you've got a formula for
                            investment gold.
                        </p>
                        <p>
                            Find out how JIIPE attracts leading industries in copper, chemicals, glass, and renewable
                            energy? Click to uncover the future of industrial synergy and find out why global investors
                            are flocking to JIIPE.
                        </p>
                        <ul class="button">
                            <li><a href="{{ route('blog.detail', ['id' => 403]) }}">了解更多信息</a></li>
                            <li><a href="{{ route('blog.detail', ['id' => 403]) }}">Find More info</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.client.home.partials.navigation_box')
    <div class="clear"></div>
</section>

<section class="video-jiipe" id="videojiipe">
    <div class="embed-responsive embed-responsive-21by9">
        <video class="embed-responsive-item" controls preload="metadata">
            @if (app()->getLocale() == 'zh')
                <source src="https://jiipe.com//Video_jiipe/Company%20Profile%20JIIPE%20CINA%20-%20SUB%20English.mp4" type="video/mp4">
            @else
                <source src="{{ asset('asset/video/62e1d25a28720.mp4') }}" type="video/mp4">
            @endif
        </video>
    </div>
</section>

@include('layouts.client.home.partials.navigation_box')