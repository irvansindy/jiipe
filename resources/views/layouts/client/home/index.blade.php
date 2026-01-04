@extends('layouts.client.main')

@section('content')
    {{-- ⚡ OPTIMIZED: Data sudah di-pass dari controller --}}
    @include('layouts.client.home.slider_section', ['sliders' => $sliders])
    @include('layouts.client.home.area_showcase_section', ['showcases' => $showcases])
    @include('layouts.client.home.tenant_section', ['tenants' => $tenants])
    @include('layouts.client.home.video_tour', ['videoTours' => $videoTours])
    @include('layouts.client.home.review_user', ['reviews' => $reviews])
    @include('layouts.client.home.faq', ['faqs' => $faqs])
    @include('layouts.client.home.news_blog', ['news' => $news])
    @include('components.appointment-form')
@endsection

{{-- ⚡ Page-specific optimizations --}}
@push('css')
<style>
    /* Critical CSS for above-the-fold content */
    .home-slider {
        min-height: 100vh;
        position: relative;
    }
    .home-box .embed-responsive {
        background: #000;
    }
    /* Preload hero section to avoid layout shift */
    .home-caption {
        opacity: 0;
        animation: fadeInUp 0.6s ease-out 0.3s forwards;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@push('js')
<script>
// ⚡ Performance optimizations
(function() {
    'use strict';

    // Lazy load images below the fold
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Preload critical resources
    const preloadVideo = () => {
        const firstVideo = document.querySelector('.home-box video');
        if (firstVideo && firstVideo.readyState < 3) {
            firstVideo.load();
        }
    };

    // Run after page load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', preloadVideo);
    } else {
        preloadVideo();
    }

    // Log performance metrics (optional, remove in production)
    window.addEventListener('load', () => {
        if (window.performance && window.performance.timing) {
            const loadTime = window.performance.timing.loadEventEnd - window.performance.timing.navigationStart;
            console.log('Page load time:', (loadTime / 1000).toFixed(2), 'seconds');
        }
    });
})();
</script>
@endpush