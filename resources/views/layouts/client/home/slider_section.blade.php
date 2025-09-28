{{-- <section class="home-slider creative">
    <div class="homewrapper">
        <div class="home-box owl-carousel owl-theme">
            <div class="embed-responsive embed-responsive-21by9">
                <video class="embed-responsive-item" muted>
                    <source src="#" type="video/mp4">
                </video>
                <div class="home-container">
                    <div class="home-caption">
                        <h2 class="title"></h2>
                        <span class="sub-title"></span>
                        
                        <ul class="button">
                            <li>
                                <a href="{{ '#contact' }}" class="btn_slider btn-light btn-red">
                                    {{ __('Contact Us') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ '#videojiipe' }}" class="btn_slider btn-light btn-blue">
                                    {{ __('Video Profile') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.client.home.navigation-box')
    <div class="clear"></div>
</section> --}}
<section class="home-slider creative">
    <div class="homewrapper">
        <div class="home-box owl-carousel owl-theme">
            @forelse($heroSlides ?? [] as $slide)
            <div class="embed-responsive embed-responsive-21by9">
                @if(!empty($slide['video']))
                <video class="embed-responsive-item" muted autoplay loop>
                    <source src="{{ asset($slide['video']) }}" type="video/mp4">
                </video>
                @else
                <img src="{{ asset($slide['image'] ?? 'asset/images/default-hero.jpg') }}" class="embed-responsive-item" alt="{{ $slide['title'] ?? 'JIIPE' }}">
                @endif
                <div class="home-container">
                    <div class="home-caption">
                        <h2 class="title">{{ $slide['title'] ?? __('Welcome to JIIPE') }}</h2>
                        <span class="sub-title">{!! $slide['subtitle'] ?? __('Java Integrated Industrial and Port Estate') !!}</span>
                        
                        <ul class="button">
                            <li>
                                <a href="{{ $slide['contact_link'] ?? '#contact' }}" class="btn_slider btn-light btn-red">
                                    {{ __('Contact Us') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ $slide['video_link'] ?? '#videojiipe' }}" class="btn_slider btn-light btn-blue">
                                    {{ __('Video Profile') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @empty
            {{-- Default slide jika tidak ada data --}}
            <div class="embed-responsive embed-responsive-21by9">
                <div class="home-container" style="background: linear-gradient(45deg, #1e3c72, #2a5298); min-height: 500px;">
                    <div class="home-caption">
                        <h2 class="title">{{ __('Welcome to JIIPE') }}</h2>
                        <span class="sub-title">
                            <p>{{ __('Java Integrated Industrial and Port Estate - Indonesia\'s Premier Industrial Zone') }}</p>
                        </span>
                        
                        <ul class="button">
                            <li>
                                <a href="#contact" class="btn_slider btn-light btn-red">
                                    {{ __('Contact Us') }}
                                </a>
                            </li>
                            <li>
                                <a href="#videojiipe" class="btn_slider btn-light btn-blue">
                                    {{ __('Learn More') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    @include('layouts.client.home.navigation-box')
    <div class="clear"></div>
</section>