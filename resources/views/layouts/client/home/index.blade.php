@extends('layouts.client.main')

@section('content')
    {{-- ⚡ OPTIMIZED: Data sudah di-pass dari controller, tidak perlu fetch lagi --}}
    @include('layouts.client.home.slider_section', ['sliders' => $sliders])
    @include('layouts.client.home.area_showcase_section', ['showcases' => $showcases])
    @include('layouts.client.home.tenant_section', ['tenants' => $tenants])
    @include('layouts.client.home.video_tour', ['videoTours' => $videoTours])
    @include('layouts.client.home.review_user', ['reviews' => $reviews])
    @include('layouts.client.home.faq', ['faqs' => $faqs])
    @include('layouts.client.home.news_blog', ['news' => $news])
    @include('components.appointment-form')
@endsection

@push('js')
<script>
    // ⚡ Preload critical resources
    document.addEventListener('DOMContentLoaded', function() {
        // Lazy load images below fold
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.dataset.src;
            });
        }
    });
</script>
@endpush