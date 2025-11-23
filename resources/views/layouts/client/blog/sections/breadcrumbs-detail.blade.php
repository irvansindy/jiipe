<section class="block-breadcrumbs">
    <div class="prelative container">
        <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">@lang('system.home')</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('blog.index') }}">@lang('system.news & articles')</a>
                </li>
                @if(!empty($data['categoryName']) && isset($data['news']->category_id))
                <li class="breadcrumb-item">
                    {{-- ✅ GANTI JADI TYPE --}}
                    @php
                        $categoryType = $data['news']->category_id == 1 ? 'news' : 'article';
                    @endphp
                    <a href="{{ route('blog.type', ['type' => $categoryType]) }}">
                        {{ $data['categoryName'] }}
                    </a>
                </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">
                    {{ Str::limit($data['translation']->title ?? $data['pageTitle'], 50) }}
                </li>
            </ol>
        </nav>
        <div class="clear"></div>
    </div>
</section>