<header class="theme-header theme-header-one">
    <div class="header-top-logo">
        <div class="prelative container">
            <div class="primary-main">
                <div class="branding">
                    <div class="logo">
                        {{-- <a href="{{ route('home', ['lang' => $currentLang]) }}" class="brand-new">
                            @php
                                $logoPath = public_path('logo/JIIPE_SEZ_Logo.png');
                            @endphp
                            <img src="{{ file_exists($logoPath) ? asset('logo/JIIPE_SEZ_Logo.png') : asset('logo/default.png') }}" alt="kawasan industri gresik jiipe" class="img-fluid img">
                        </a> --}}
                    </div>
                </div>
                <div class="branding2">
                    <div class="language d-inline-flex">
                        <label>Choose Language : </label>
                        <ul class="bahasa">
                            {{-- @dd($languages['id']) --}}
                            @if (count($languages) > 1)
                                @foreach ($languages as $key => $lang)
                                    <li>
                                        <a href="{{ request()->fullUrlWithQuery(['lang' => $lang['locale']]) }}">{{ $lang['name'] }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="appointment-btn float-md-right">
                        <div class="appointment d-inline-flex float-md-right">
                            <div class="button-icon">
                                <i class="fa fa-calendar-alt"></i>
                            </div>
                            <a class="text-appointment" href="{{ $settings['section2_home_header_link_button'] ?? '#' }}" title="{{ $settings['section2_home_header_button_text'] ?? '' }}">
                                {{ $settings['section2_home_header_button_text'] ?? '' }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="branding3 d-none">
                    <label class="float-md-right">Choose Language : </label>
                    <ul class="language-mobile float-md-right">
                        <li class="has-children">
                            <span>
                                {{-- {{ $languages->firstWhere('code', $currentLang)->title ?? '' }} --}}
                            </span>
                            <ul class="sub-menu">
                                @foreach ($languages as $lang)
                                    <li>
                                        <a href="{{ request()->fullUrlWithQuery(['lang' => $lang['locale']]) }}" title="{{ $lang['name'] }}">{{ $lang['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="header-navigation header-navigation-noshadow">
        <div class="prelative container">
            <div class="header-utama">
                <div class="second-main">
                    <div class="slogan">
                        <h4>Java Integrated Industrial and Ports Estate</h4>
                        <p>Kawasan Ekonomi Khusus, Gresik, East-Java - Indonesia</p>
                    </div>
                    <div class="sticky-logo-branding d-inline-flex">
                        <div class="sticky-main d-none">
                            {{-- <a href="{{ route('home', ['lang' => $languages->first()->locale ?? '']) }}" class="sticky-brand-new">
                                <img src="{{ asset('logo/JIIPE_SEZ_Logo.png') }}" alt="kawasan industri gresik jiipe" class="img-fluid img">
                            </a> --}}
                        </div>
                    </div>
                    <div class="header-right-nav">
                        <ul>
                            <li class="navbar-toggle-btn">
                                <div class="navbar-toggler">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-menu">
                        <div class="navbar-close"><i class="fa fa-times"></i></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>