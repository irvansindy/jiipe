<header class="theme-header theme-header-one">
    <div class="header-top-logo">
        <div class="prelative container">
            <div class="primary-main">
                <div class="branding">
                    <div class="logo">
                        <a href="{{ route('home') }}" class="brand-new">
                            @php
                                $logoPath = public_path('asset/images/logo/JIIPE_SEZ_Logo.png');
                            @endphp
                            <img src="{{ file_exists($logoPath) ? asset('asset/images/logo/JIIPE_SEZ_Logo.png') : asset('logo/default.png') }}"
                                alt="kawasan industri gresik jiipe" class="img-fluid img">
                        </a>
                    </div>
                </div>
                <div class="branding2">
                    <div class="language d-inline-flex">
                        <label>Choose Language : </label>
                        <ul class="bahasa">
                            @foreach (Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                    @if (! $loop->last) | @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="appointment-btn float-md-right">
                        <div class="appointment d-inline-flex float-md-right">
                            <div class="button-icon">
                                <i class="fa fa-calendar-alt"></i>
                            </div>
                            <a class="text-appointment"
                                href="{{ $settings['section2_home_header_link_button'] ?? '#' }}"
                                title="{{ $settings['section2_home_header_button_text'] ?? '' }}">
                                {{ $settings['section2_home_header_button_text'] ?? '' }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="branding3 d-none">
                    <label class="float-md-right">Choose Language : </label>
                    <ul class="language-mobile float-md-right">
                        <li class="has-children">
                            <ul class="sub-menu">
                                @foreach (Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                        @if (! $loop->last) | @endif
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
                            <a href="{{ route('home') }}" class="sticky-brand-new">
                                <img src="{{ public_path('asset/images/logo/JIIPE_SEZ_Logo.png') }}" alt="kawasan industri gresik jiipe" class="img-fluid img">
                            </a>
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
                        <!-- Main Menu -->
                        <nav class="main-menu main-menu-red">
                            <ul>
                                <li class="menu-item has-children"><a href="#" class="dd-trigger">About Us</a> 
                                    <ul class="sub-menu">
                                        <li><a href="/en/home/profil">Profil</a></li>
                                        <li><a href="/en/home/blog/type/news">News</a></li>
                                        <li><a href="/en/home/blog/type/article">Articles</a></li>
                                        <li><a href="/en/home/contact">Contact</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item"><a href="/en/home/industri_jiipe">Industrial Estate</a></li>
                                <li class="menu-item"><a href="/en/home/kawasanekonomi">Special Economic Zone</a></li>
                                <li class="menu-item"><a href="/en/home/blog">News &amp; Articles</a></li>
                                <li class="menu-item"><a href="/en/home/desk_international">International Desk</a></li>
                                <li class="menu-item"><a href="/en/home/karir">Career</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
