<header class="theme-header theme-header-one">
    <div class="header-top-logo">
        <div class="prelative container">
            <div class="primary-main">
                <div class="branding">
                    <div class="logo">
                        <a href="{{ route('home') }}" class="brand-new">
                            @php
                                $logo1x = public_path('asset/images/logo/JIIPE_SEZ_Logo-390.webp');
                                $logo2x = public_path('asset/images/logo/JIIPE_SEZ_Logo-780.webp');

                                $logo1xUrl = file_exists($logo1x)
                                    ? asset('asset/images/logo/JIIPE_SEZ_Logo-390.webp')
                                    : asset('logo/default.png');

                                $logo2xUrl = file_exists($logo2x)
                                    ? asset('asset/images/logo/JIIPE_SEZ_Logo-780.webp')
                                    : $logo1xUrl;
                            @endphp

                            <img
                                src="{{ $logo1xUrl }}"
                                srcset="{{ $logo1xUrl }} 1x, {{ $logo2xUrl }} 2x"
                                width="390"
                                height="90"
                                alt="Official Logo of JIIPE Gresik - Java Integrated Industrial and Ports Estate"
                                class="img-fluid img"
                                loading="lazy"
                                decoding="async">
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
                            <a class="text-appointment mx-1 my-1" href="{{ $settings['contact2'] ?? '#contact2' }}"
                                title="{{ $settings['section2_home_header_button_text'] ?? '' }}">
                                @lang('system.quick appointment')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="branding3 d-none">
                    <div class="language-dropdown-wrapper">
                        <label for="language-select">@lang('system.choose language') : </label>
                        <div class="custom-select-wrapper">
                            <button type="button" class="custom-select-trigger" id="languageSelectTrigger" 
                                aria-label="Change Language" aria-haspopup="listbox" aria-expanded="false">
                                <span class="selected-language">
                                    @php
                                        $currentLocale = Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
                                        $currentLocaleData = Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales()[$currentLocale] ?? null;
                                    @endphp
                                    {{ strtoupper($currentLocale) }}
                                </span>
                                <i class="fa fa-chevron-down dropdown-icon" aria-hidden="true"></i>
                            </button>
                            <div class="custom-select-dropdown" id="languageDropdown">
                                <ul class="language-options">
                                    @foreach (Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a href="{{ Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                               class="language-option {{ $localeCode === $currentLocale ? 'active' : '' }}"
                                               data-locale="{{ $localeCode }}">
                                                <span class="locale-code">{{ strtoupper($localeCode) }}</span>
                                                {{-- <span class="locale-name">{{ $properties['native'] }}</span> --}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-navigation header-navigation-noshadow" style="padding-bottom: 6px !important;">
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
                                    alt="JIIPE Gresik Sticky Logo" class="img-fluid img" loading="lazy" decoding="async">
                            </a>
                        </div>
                    </div>
                    <div class="header-right-nav">
                        <ul>
                            <li class="navbar-toggle-btn">
                                <button class="navbar-toggler" aria-label="Toggle Navigation Menu" aria-controls="nav-menu" aria-expanded="false">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-menu" id="nav-menu">
                        <button class="navbar-close" aria-label="Close Menu"><i class="fa fa-times" aria-hidden="true"></i></button>
                        <!-- Main Menu -->
                        <nav class="main-menu main-menu-red">
                            <ul>
                                <li class="menu-item has-children"><a href="#"
                                        class="dd-trigger">@lang('system.about us')</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ route('profil') }}">@lang('system.profile')</a>
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
                                <li class="menu-item"><a href="{{ route('industri_jiipe') }}">@lang('system.industrial estate')</a>
                                </li>
                                <li class="menu-item"><a href="{{ route('kawasanekonomi') }}">@lang('system.special economic zone')</a>
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
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Header Normal State */
    .header-navigation {
        position: relative;
        background-color: #ffffff;
        width: 100%;
        transition: none;
    }

    /* Header Sticky State */
    body.has-scrolled .header-navigation.sticky {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 9999;
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-100%);
        transition: transform 0.3s ease-in-out;
    }

    body.has-scrolled .header-navigation.sticky.show {
        transform: translateY(0);
    }

    body.has-scrolled .header-navigation.sticky.show .sticky-logo-branding .sticky-main {
        display: inline-block !important;
    }

    .sticky-logo-branding .sticky-main {
        display: none !important;
    }

    /* ========================================
       CUSTOM LANGUAGE DROPDOWN - STYLED
    ======================================== */
    .branding3 .language-dropdown-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 5px 0;
    }

    .branding3 .language-dropdown-wrapper label {
        margin: 0;
        font-size: 14px;
        color: #333;
        white-space: nowrap;
        font-weight: 500;
    }

    /* Custom Select Wrapper */
    .custom-select-wrapper {
        position: relative;
        min-width: 70px;
    }

    /* Select Trigger Button */
    .custom-select-trigger {
        width: 100%;
        padding: 8px 35px 8px 12px;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
         /* reset default browser style */
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;

        background-color: transparent;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        color: #333;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
        text-align: left;
        outline: none;
    }

    .custom-select-trigger:hover {
        border-color: #999;
        background: #fafafa;
    }

    .custom-select-trigger:focus,
    .custom-select-trigger.active {
        border-color: #d32f2f;
        box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.1);
    }

    .custom-select-trigger .dropdown-icon {
        position: absolute;
        right: 12px;
        font-size: 12px;
        color: #666;
        transition: transform 0.2s ease;
        pointer-events: none;
    }

    .custom-select-trigger.active .dropdown-icon {
        transform: rotate(180deg);
    }

    /* Dropdown Menu */
    .custom-select-dropdown {
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1px solid #d0d0d0;
        border-radius: 4px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
        max-height: 280px;
        overflow-y: auto;
    }

    .custom-select-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .custom-select-dropdown ul {
        list-style: none;
        margin: 0;
        padding: 4px 0;
    }

    .custom-select-dropdown ul li {
        margin: 0;
        padding: 0;
    }

    /* Language Option Item */
    .language-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        color: #333;
        text-decoration: none;
        transition: all 0.15s ease;
        cursor: pointer;
        border-left: 3px solid transparent;
    }

    .language-option:hover {
        background: #f5f5f5;
        border-left-color: #d32f2f;
    }

    .language-option.active {
        background: #fff5f5;
        border-left-color: #d32f2f;
        font-weight: 600;
    }

    .language-option .locale-code {
        font-size: 13px;
        font-weight: 600;
        color: #d32f2f;
        min-width: 32px;
        text-align: center;
    }

    .language-option .locale-name {
        font-size: 13px;
        color: #555;
        flex: 1;
    }

    .language-option.active .locale-name {
        color: #d32f2f;
        font-weight: 500;
    }

    /* Scrollbar Styling */
    .custom-select-dropdown::-webkit-scrollbar {
        width: 6px;
    }

    .custom-select-dropdown::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .custom-select-dropdown::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }

    .custom-select-dropdown::-webkit-scrollbar-thumb:hover {
        background: #999;
    }

    /* Mobile Specific Styles */
    @media screen and (max-width: 1024px) {
        .branding3 {
            display: block !important;
        }

        .branding3 .language-dropdown-wrapper {
            justify-content: flex-end;
            padding: 8px 0;
        }

        .custom-select-wrapper {
            min-width: 90px;
        }

        .custom-select-trigger {
            padding: 10px 35px 10px 14px;
            font-size: 15px;
        }

        .language-option {
            padding: 12px 16px;
        }

        .language-option .locale-code {
            font-size: 14px;
            min-width: 36px;
        }

        .language-option .locale-name {
            font-size: 14px;
        }
    }

    @media screen and (min-width: 1025px) {
        .branding3 {
            display: none !important;
        }
    }

    /* Mobile Menu Styles */
    @media screen and (max-width: 1024px) {
        .navbar-toggle-btn {
            z-index: 100001;
            cursor: pointer;
        }

        .nav-menu {
            position: fixed !important;
            top: 0 !important;
            right: -100% !important;
            width: 85% !important;
            max-width: 360px !important;
            height: 100vh !important;
            background-color: #c7332a !important;
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
            position: static !important;
            width: 100% !important;
            padding-left: 12px !important;
            background: rgba(255, 255, 255, 0.03) !important;
            box-shadow: none !important;
            margin: 0 !important;
        }

        .nav-menu .main-menu .has-children.active .sub-menu {
            display: block !important;
        }

        .nav-menu .main-menu .sub-menu li a {
            display: block !important;
            width: 100% !important;
            padding: 12px 10px !important;
            color: #fff !important;
            background: transparent !important;
        }

        .nav-menu .main-menu .sub-menu li+li a {
            border-top: 1px solid rgba(255, 255, 255, 0.06) !important;
        }

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

        /* .nav-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        } */

        body.menu-open {
            overflow: hidden !important;
        }
    }
</style>

<script>
    (function() {
        'use strict';

        // Sticky Header
        function initStickyHeader() {
            const headerNavigation = document.querySelector('.header-navigation');
            const headerTopLogo = document.querySelector('.header-top-logo');

            if (!headerNavigation || !headerTopLogo) return;

            const getThreshold = () => {
                return headerTopLogo.offsetHeight;
            };

            let threshold = getThreshold();
            let ticking = false;
            let lastScrollY = 0;

            function updateStickyState() {
                const scrollY = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollY > threshold) {
                    document.body.classList.add('has-scrolled');

                    if (!headerNavigation.classList.contains('sticky')) {
                        headerNavigation.classList.add('sticky');
                        void headerNavigation.offsetWidth;
                        requestAnimationFrame(() => {
                            headerNavigation.classList.add('show');
                        });
                    }
                } else {
                    if (headerNavigation.classList.contains('sticky')) {
                        headerNavigation.classList.remove('show');

                        setTimeout(() => {
                            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
                            if (currentScroll <= threshold) {
                                headerNavigation.classList.remove('sticky');
                                document.body.classList.remove('has-scrolled');
                            }
                        }, 300);
                    }
                }

                lastScrollY = scrollY;
                ticking = false;
            }

            function onScroll() {
                if (!ticking) {
                    requestAnimationFrame(updateStickyState);
                    ticking = true;
                }
            }

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    threshold = getThreshold();
                    updateStickyState();
                }, 250);
            });

            window.addEventListener('scroll', onScroll, {
                passive: true
            });

            updateStickyState();
        }

        // ========================================
        // CUSTOM LANGUAGE DROPDOWN FUNCTIONALITY
        // ========================================
        function initLanguageDropdown() {
            const trigger = document.getElementById('languageSelectTrigger');
            const dropdown = document.getElementById('languageDropdown');

            if (!trigger || !dropdown) return;

            // Toggle dropdown
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = dropdown.classList.contains('show');

                if (isOpen) {
                    closeDropdown();
                } else {
                    openDropdown();
                }
            });

            function openDropdown() {
                dropdown.classList.add('show');
                trigger.classList.add('active');
                trigger.setAttribute('aria-expanded', 'true');
            }
 
            function closeDropdown() {
                dropdown.classList.remove('show');
                trigger.classList.remove('active');
                trigger.setAttribute('aria-expanded', 'false');
            }

            // Close when clicking outside
            document.addEventListener('click', function(e) {
                if (!trigger.contains(e.target) && !dropdown.contains(e.target)) {
                    closeDropdown();
                }
            });

            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && dropdown.classList.contains('show')) {
                    closeDropdown();
                }
            });

            // Prevent dropdown from closing when clicking inside
            dropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // Mobile menu
        function initMobileMenu() {
            const toggleBtn = document.querySelector('.navbar-toggle-btn');
            const navMenu = document.querySelector('.nav-menu');
            const closeBtn = document.querySelector('.navbar-close');
            const dropdownTriggers = document.querySelectorAll('.main-menu .has-children > a.dd-trigger');

            if (!toggleBtn || !navMenu) return;

            function createOverlay() {
                let overlay = document.querySelector('.nav-menu-overlay');
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.className = 'nav-menu-overlay';
                    document.body.appendChild(overlay);
                }
                return overlay;
            }

            function openMenu() {
                const overlay = createOverlay();
                navMenu.classList.add('active');
                document.body.classList.add('menu-open');
 
                const toggler = toggleBtn.querySelector('.navbar-toggler');
                if (toggler) {
                    toggler.classList.add('active');
                    toggler.setAttribute('aria-expanded', 'true');
                }
 
                setTimeout(() => overlay.classList.add('active'), 10);
            }
 
            function closeMenu() {
                const overlay = document.querySelector('.nav-menu-overlay');
                navMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
 
                const toggler = toggleBtn.querySelector('.navbar-toggler');
                if (toggler) {
                    toggler.classList.remove('active');
                    toggler.setAttribute('aria-expanded', 'false');
                }

                if (overlay) {
                    overlay.classList.remove('active');
                    setTimeout(() => {
                        if (overlay.parentNode) overlay.parentNode.removeChild(overlay);
                    }, 300);
                }

                document.querySelectorAll('.main-menu .has-children').forEach(el => {
                    el.classList.remove('active');
                });
            }

            toggleBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                navMenu.classList.contains('active') ? closeMenu() : openMenu();
            });

            if (closeBtn) {
                closeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    closeMenu();
                });
            }

            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('nav-menu-overlay')) closeMenu();
            });

            dropdownTriggers.forEach(trigger => {
                trigger.addEventListener('click', (e) => {
                    if (window.innerWidth <= 1024) {
                        e.preventDefault();
                        e.stopPropagation();

                        const parentLi = trigger.parentElement;

                        document.querySelectorAll('.main-menu .has-children').forEach(el => {
                            if (el !== parentLi) el.classList.remove('active');
                        });

                        parentLi.classList.toggle('active');
                    }
                });
            });

            document.querySelectorAll('.main-menu .menu-item:not(.has-children) > a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 1024) closeMenu();
                });
            });

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

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && navMenu.classList.contains('active')) {
                    closeMenu();
                }
            });
        }

        // Initialize all functions
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                initStickyHeader();
                initLanguageDropdown();
                initMobileMenu();
            });
        } else {
            initStickyHeader();
            initLanguageDropdown();
            initMobileMenu();
        }
    })();
</script>