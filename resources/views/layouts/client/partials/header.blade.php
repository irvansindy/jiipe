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
                                <img src="{{ asset('asset/images/logo/JIIPE_SEZ_Logo.png') }}" alt="kawasan industri gresik jiipe" class="img-fluid img">
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
                                        <li><a href="{{ route('profile') }}">Profil</a></li>
                                        <li><a href="#">News</a></li>
                                        <li><a href="#">Articles</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item"><a href="{{ route('industrial-jiipe') }}">Industrial Estate</a></li>
                                <li class="menu-item"><a href="#">Special Economic Zone</a></li>
                                <li class="menu-item"><a href="#">News &amp; Articles</a></li>
                                <li class="menu-item"><a href="#">International Desk</a></li>
                                <li class="menu-item"><a href="#">Career</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<style>

</style>
<script>
    // ============================================
// MOBILE MENU TOGGLE - VANILLA JAVASCRIPT
// Paste this code before </body> tag
// ============================================

(function() {
    'use strict';

    // Wait for DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileMenu);
    } else {
        initMobileMenu();
    }

    function initMobileMenu() {
        console.log('Mobile Menu Script Loaded');

        // Get elements
        const toggleBtn = document.querySelector('.navbar-toggle-btn');
        const navMenu = document.querySelector('.nav-menu');
        const closeBtn = document.querySelector('.navbar-close');
        const menuItems = document.querySelectorAll('.main-menu .has-children > a.dd-trigger');
        const body = document.body;

        // Debug - check if elements exist
        console.log('Toggle Button:', toggleBtn);
        console.log('Nav Menu:', navMenu);
        console.log('Close Button:', closeBtn);

        if (!toggleBtn || !navMenu) {
            console.error('Required elements not found!');
            return;
        }

        // Create overlay if not exists
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
            console.log('Opening menu...');
            const overlay = createOverlay();

            navMenu.classList.add('active');
            body.classList.add('menu-open');

            // Add toggler animation
            const toggler = toggleBtn.querySelector('.navbar-toggler');
            if (toggler) {
                toggler.classList.add('active');
            }

            // Show overlay
            setTimeout(function() {
                overlay.classList.add('active');
            }, 10);
        }

        // Close menu
        function closeMenu() {
            console.log('Closing menu...');
            const overlay = document.querySelector('.nav-menu-overlay');

            navMenu.classList.remove('active');
            body.classList.remove('menu-open');

            // Remove toggler animation
            const toggler = toggleBtn.querySelector('.navbar-toggler');
            if (toggler) {
                toggler.classList.remove('active');
            }

            // Hide overlay
            if (overlay) {
                overlay.classList.remove('active');
                setTimeout(function() {
                    if (overlay.parentNode) {
                        overlay.parentNode.removeChild(overlay);
                    }
                }, 300);
            }
        }

        // Toggle menu
        function toggleMenu(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Menu toggled');

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
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                closeMenu();
            });
        }

        // Event: Overlay click
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('nav-menu-overlay')) {
                closeMenu();
            }
        });

        // Event: Dropdown toggle (mobile only)
        menuItems.forEach(function(item) {
            item.addEventListener('click', function(e) {
                // Only for mobile
                if (window.innerWidth <= 768) {
                    e.preventDefault();

                    const parent = this.parentElement;
                    const isActive = parent.classList.contains('active');

                    // Close all other dropdowns
                    document.querySelectorAll('.main-menu .has-children').forEach(function(el) {
                        el.classList.remove('active');
                    });

                    // Toggle current dropdown
                    if (!isActive) {
                        parent.classList.add('active');
                    }
                }
            });
        });

        // Event: Close menu on window resize to desktop
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth > 768) {
                    closeMenu();
                    // Remove all active dropdown classes
                    document.querySelectorAll('.main-menu .has-children').forEach(function(el) {
                        el.classList.remove('active');
                    });
                }
            }, 250);
        });

        // Event: Prevent menu close when clicking inside
        navMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Event: Close menu with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navMenu.classList.contains('active')) {
                closeMenu();
            }
        });

        console.log('Mobile Menu Initialized Successfully');
    }

})();
</script>