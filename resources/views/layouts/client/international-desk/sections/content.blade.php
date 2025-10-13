<section class="blog-sec-1">
    <div class="prelative container">
        <div class="row utama">
            {{-- Sidebar --}}
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}"
                     alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <p class="info">{{ __('International Desk') }}</p>
                <div class="clear clearfix"></div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-45">
                <div class="title">
                    <p class="titles_top d-inline-block">
                        {{ __('International Desk') }}
                    </p>
                </div>
                <hr class="artikel-berita">

                <div class="blocks_listgallery download_brochures">
                    <div class="row artikel lists_news_blog pb-0">
                        {{-- English Desk --}}
                        <div class="col-md-15">
                            <div class="items creative_contact_us">
                                <div class="judul pt-0 pb-3" style="padding-top: 0 !important;">
                                    <h2 style="height: auto;">English</h2>
                                </div>
                                <div class="content">
                                    <a style="text-decoration:underline; color:#31b7ea"
                                       href="#contact"
                                       class="font-weight-bold">
                                        {{ __('Contact us') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Chinese Simplified Desk --}}
                        <div class="col-md-15">
                            <div class="items creative_contact_us">
                                <div class="judul pt-0 pb-3" style="padding-top: 0 !important;">
                                    <h2 style="height: auto;">Chinese Simplified （筒体版）</h2>
                                </div>
                                <div class="content">
                                    <a style="text-decoration:underline; color:#31b7ea"
                                       href="#contact"
                                       class="font-weight-bold">
                                        {{ __('Contact us') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Chinese Traditional Desk --}}
                        <div class="col-md-15">
                            <div class="items creative_contact_us">
                                <div class="judul pt-0 pb-3" style="padding-top: 0 !important;">
                                    <h2 style="height: auto;">Chinese Traditional（繁體版）</h2>
                                </div>
                                <div class="content">
                                    <a style="text-decoration:underline; color:#31b7ea"
                                       href="#contact"
                                       class="font-weight-bold">
                                        {{ __('Contact us') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Japanese Desk --}}
                        <div class="col-md-15">
                            <div class="items creative_contact_us">
                                <div class="judul pt-0 pb-3" style="padding-top: 0 !important;">
                                    <h2 style="height: auto;">Japanese （日本語)</h2>
                                </div>
                                <div class="content">
                                    <a style="text-decoration:underline; color:#31b7ea"
                                       href="#contact"
                                       class="font-weight-bold">
                                        {{ __('Contact us') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('css')
<style type="text/css">
    p.titles_top {
        font-size: 35px;
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        color: #d22c12;
        line-height: 0.7;
        margin-bottom: 10px;
    }

    .title img.d-inline-block {
        margin-top: -59px !important;
    }

    .creative_contact_us {
        border: none;
        border-radius: 0;
        padding: 15px;
        height: auto;
        transition: all 0.3s ease;
    }

    .creative_contact_us:hover {
        background-color: #f8f9fa;
    }

    .creative_contact_us .judul h2 {
        font-size: 18px;
        font-weight: 600;
        color: #d22c12;
        min-height: auto;
        display: block;
        margin-bottom: 10px;
    }

    .creative_contact_us .content {
        margin-top: 5px;
    }

    .creative_contact_us .content a {
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .creative_contact_us .content a:hover {
        color: #2196F3 !important;
    }

    .blocks_listgallery.download_brochures .row {
        margin-left: 0;
        margin-right: 0;
    }

    .blocks_listgallery.download_brochures .col-md-15 {
        padding-left: 0;
        padding-right: 15px;
    }

    @media (max-width: 767px) {
        .col-md-15 {
            margin-bottom: 15px;
            padding-right: 0;
        }

        p.titles_top {
            font-size: 28px;
        }

        .creative_contact_us .judul h2 {
            font-size: 16px;
        }
    }
</style>
@endpush