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
                        <label>@lang('system.choose language') : </label>
                        <ul class="bahasa">
                            @foreach (Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="{{ $localeCode === Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ? 'active' : '' }}"
                                        rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                    @if (!$loop->last)
                                        |
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="appointment-btn float-md-right">
                        <div class="appointment d-inline-flex float-md-right">
                            <div class="button-icon my-1">
                                <i class="fa fa-calendar-alt"></i>
                            </div>
                            <a class="text-appointment mx-1 my-1"
                                href="{{ $settings['contact2'] ?? '#contact2' }}"
                                title="{{ $settings['section2_home_header_button_text'] ?? '' }}">
                                @lang('system.quick appointment')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="branding3 d-none">
                    <div class="language-dropdown-wrapper">
                        <label for="language-select">Choose Language : </label>
                        <select id="language-select" class="language-select-dropdown"
                            onchange="window.location.href = this.value">
                            @foreach (Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <option
                                    value="{{ Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                    {{ $localeCode === Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ? 'selected' : '' }}>
                                    {{ strtoupper($localeCode) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
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
                                <img src="{{ asset('asset/images/logo/JIIPE_SEZ_Logo.png') }}"
                                    alt="kawasan industri gresik jiipe" class="img-fluid img">
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
                                <li class="menu-item has-children"><a href="#"
                                        class="dd-trigger">@lang('system.about us')</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ route('profile') }}">@lang('system.profile')</a>
                                        </li>
                                        <li><a
                                                href="{{ route('blog.type', ['type' => 'news']) }}">{{ __('system.news') }}</a>
                                        </li>
                                        <li><a
                                                href="{{ route('blog.type', ['type' => 'article']) }}">{{ __('system.articles') }}</a>
                                        </li>
                                        <li><a href="{{ route('contact') }}">@lang('system.contacts')</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item"><a href="{{ route('industrial-estate') }}">@lang('system.industrial estate')</a>
                                </li>
                                <li class="menu-item"><a href="{{ route('economic-zone') }}">@lang('system.special economic zone')</a>
                                </li>
                                <li class="menu-item"><a href="{{ route('blog.index') }}">@lang('system.news') &amp;
                                        @lang('system.articles')</a></li>
                                <li class="menu-item"><a href="{{ route('international-desk') }}">@lang('system.international desk')</a>
                                </li>
                                <li class="menu-item"><a href="{{ route('career') }}">@lang('system.career')</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    /* Language Dropdown Styles */
    .branding3 .language-dropdown-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
    }

    .branding3 .language-dropdown-wrapper label {
        margin: 0;
        font-size: 14px;
        color: #333;
        white-space: nowrap;
    }

    .branding3 .language-select-dropdown {
        padding: 6px 30px 6px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        font-size: 14px;
        color: #333;
        cursor: pointer;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 16px;
        min-width: 100px;
    }

    .branding3 .language-select-dropdown:hover {
        border-color: #999;
    }

    .branding3 .language-select-dropdown:focus {
        border-color: #d32f2f;
        box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.1);
    }

    /* Responsive - Show on mobile/tablet */
    @media screen and (max-width: 1024px) {
        .branding3 {
            display: block !important;
        }

        .branding3 .language-dropdown-wrapper {
            justify-content: flex-end;
            padding: 15px 20px;
        }
    }

    @media screen and (min-width: 1025px) {
        .branding3 {
            display: none !important;
        }
    }
</style>

<!-- Mobile nav overrides to match expected design -->
<style>
    @media screen and (max-width: 1024px) {

        /* Ensure toggle is on top and clickable */
        .navbar-toggle-btn {
            z-index: 100001;
            cursor: pointer;
        }

        /* Base nav-menu for mobile */
        .nav-menu {
            position: fixed !important;
            top: 0 !important;
            right: -100% !important;
            width: 85% !important;
            max-width: 360px !important;
            height: 100vh !important;
            background-color: #c7332a !important;
            /* JIIPE red */
            color: #ffffff !important;
            z-index: 100000 !important;
            transition: right 0.36s ease !important;
            overflow-y: auto !important;
            box-shadow: -6px 0 24px rgba(0, 0, 0, 0.25) !important;
            padding: 60px 20px 30px 20px !important;
        }

        .nav-menu.active {
            right: 0 !important;
        }

        .nav-menu .main-menu ul {
            display: flex !important;
            flex-direction: column !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .nav-menu .main-menu ul li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
        }

        .nav-menu .main-menu ul li a {
            display: block !important;
            padding: 16px 10px !important;
            color: #fff !important;
            font-weight: 500 !important;
        }

        .nav-menu .main-menu .sub-menu {
            display: none !important;
            /* Force mobile submenu to behave as stacked items (not absolute) */
            position: static !important;
            width: 100% !important;
            left: auto !important;
            top: auto !important;
            padding-left: 12px !important;
            background: rgba(255, 255, 255, 0.03) !important;
            box-shadow: none !important;
            margin: 0 !important;
        }

        .nav-menu .main-menu .has-children.active .sub-menu {
            display: block !important;
        }

        /* Make submenu items full-width and readable on mobile */
        .nav-menu .main-menu .sub-menu li a {
            display: block !important;
            width: 100% !important;
            padding: 12px 10px !important;
            color: #fff !important;
            background: transparent !important;
        }

        /* Slight separator for nested levels */
        .nav-menu .main-menu .sub-menu li+li a {
            border-top: 1px solid rgba(255, 255, 255, 0.06) !important;
        }

        /* Close button: small translucent square with white X */
        .nav-menu .navbar-close {
            position: absolute !important;
            top: 14px !important;
            right: 14px !important;
            width: 34px !important;
            height: 34px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: rgba(255, 255, 255, 0.12) !important;
            color: #fff !important;
            border-radius: 4px !important;
            font-size: 16px !important;
            cursor: pointer !important;
        }

        .nav-menu-overlay {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100vh !important;
            background: rgba(0, 0, 0, 0.45) !important;
            z-index: 99999 !important;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.28s ease, visibility 0.28s ease;
        }

        .nav-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Prevent body scroll when menu open */
        body.menu-open {
            overflow: hidden !important;
        }
    }
</style>

<script>
    (function() {
        'use strict';

        // Initialize mobile menu when DOM is ready
        function initMobileMenu() {
            const toggleBtn = document.querySelector('.navbar-toggle-btn');
            const navMenu = document.querySelector('.nav-menu');
            const closeBtn = document.querySelector('.navbar-close');
            const dropdownTriggers = document.querySelectorAll('.main-menu .has-children > a.dd-trigger');

            if (!toggleBtn || !navMenu) return;

            // Create overlay element
            function createOverlay() {
                let overlay = document.querySelector('.nav-menu-overlay');
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.className = 'nav-menu-overlay';
                    document.body.appendChild(overlay);
                }
                return overlay;
            }

            // Open menu
            function openMenu() {
                const overlay = createOverlay();
                navMenu.classList.add('active');
                document.body.classList.add('menu-open');

                const toggler = toggleBtn.querySelector('.navbar-toggler');
                if (toggler) {
                    toggler.classList.add('active');
                }

                setTimeout(() => {
                    overlay.classList.add('active');
                }, 10);
            }

            // Close menu
            function closeMenu() {
                const overlay = document.querySelector('.nav-menu-overlay');
                navMenu.classList.remove('active');
                document.body.classList.remove('menu-open');

                const toggler = toggleBtn.querySelector('.navbar-toggler');
                if (toggler) {
                    toggler.classList.remove('active');
                }

                if (overlay) {
                    overlay.classList.remove('active');
                    setTimeout(() => {
                        if (overlay.parentNode) {
                            overlay.parentNode.removeChild(overlay);
                        }
                    }, 300);
                }

                // Close all open dropdowns when menu closes
                document.querySelectorAll('.main-menu .has-children').forEach(el => {
                    el.classList.remove('active');
                });
            }

            // Toggle menu
            function toggleMenu(e) {
                e.preventDefault();
                e.stopPropagation();

                if (navMenu.classList.contains('active')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            }

            // Event: Toggle button click
            toggleBtn.addEventListener('click', toggleMenu);

            // Event: Close button click
            if (closeBtn) {
                closeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    closeMenu();
                });
            }

            // Event: Overlay click to close menu
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('nav-menu-overlay')) {
                    closeMenu();
                }
            });

            // Event: Dropdown toggle for submenu items
            dropdownTriggers.forEach(trigger => {
                trigger.addEventListener('click', (e) => {
                    // Only for mobile/tablet
                    if (window.innerWidth <= 1024) {
                        e.preventDefault();
                        e.stopPropagation();

                        const parentLi = trigger.parentElement;
                        const isActive = parentLi.classList.contains('active');

                        // Close all other dropdowns
                        document.querySelectorAll('.main-menu .has-children').forEach(el => {
                            if (el !== parentLi) {
                                el.classList.remove('active');
                            }
                        });

                        // Toggle current dropdown
                        parentLi.classList.toggle('active');
                    }
                });
            });

            // Event: Close menu when clicking on a regular link (non-dropdown)
            document.querySelectorAll('.main-menu .menu-item:not(.has-children) > a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 1024) {
                        closeMenu();
                    }
                });
            });

            // Event: Handle submenu item clicks
            document.querySelectorAll('.main-menu .sub-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 1024) {
                        // Optionally close menu when clicking submenu items
                        // Uncomment below if you want to close on submenu click:
                        // closeMenu();
                    }
                });
            });

            // Event: Close menu when window resizes to desktop
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (window.innerWidth > 1024) {
                        closeMenu();
                        document.querySelectorAll('.main-menu .has-children').forEach(el => {
                            el.classList.remove('active');
                        });
                    }
                }, 250);
            });

            // Event: Close menu with ESC key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && navMenu.classList.contains('active')) {
                    closeMenu();
                }
            });
        }

        // Run when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMobileMenu);
        } else {
            initMobileMenu();
        }
    })();
</script>
