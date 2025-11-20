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
                @if(!empty($data['categoryName']))
                <li class="breadcrumb-item">
                    <a href="{{ route('blog.category', Str::slug($data['categoryName'])) }}">
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