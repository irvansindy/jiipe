{{-- <section class="block-breadcrumbs">
    <div class="prelative container">
        <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('kawasanekonomi') }}">{{ __('SEZ') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $page['title'] ?? 'PP No.71 th 2021 tentang KEK Gresik-JIIPE' }}
                </li>
            </ol>
        </nav>
        <div class="clear"></div>
    </div>
</section> --}}

<section class="block-breadcrumbs">
    <div class="prelative container">
        <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('kawasanekonomi') }}">{{ __('SEZ') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" id="dynamic-breadcrumb">
                    {{ $data['sezPages'][0]['title'] ?? 'PP No.71 th 2021 tentang KEK Gresik-JIIPE' }}
                </li>
            </ol>
        </nav>
        <div class="clear"></div>
    </div>
</section>