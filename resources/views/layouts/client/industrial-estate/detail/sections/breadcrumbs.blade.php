<section class="block-breadcrumbs">
    <div class="prelative container">
        <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">@lang('system.home')</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('industri_jiipe') }}">
                        @lang('system.Jiipe industrial estate')
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $zone->translations[0]['name'] ?? '' }}
                </li>
            </ol>
        </nav>
        <div class="clear"></div>
    </div>
</section>