<section class="profil-sec-1">
    <div class="prelative container">
        <div class="row utama">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="">
                <p class="info">
                    @lang('system.profile of jiipe industrial estate in gresik')
                </p>
            </div>

            <div class="col-md-45">
                <div class="judul mb-4 pb-4">
                    <h2>{!! $aboutUsContent->translations[0]->title ?? '' !!}</h2>
                    <h5>
                        <p>{!! $aboutUsContent->translations[0]->subtitle ?? '' !!}</p>
                    </h5>
                </div>

                <div class="row gambar-content">
                    <div class="col-md-30">
                        {{-- storage/about_us/content/about_us_content.jpg --}}
                        <img src="{{ asset('uploads/about-us/content/' . $aboutUsContent->image) }}" alt="@lang('system.profile - jiipe industrial estate in gresik')"
                            class="img-fluid">
                    </div>
                    <div class="col-md-30">
                        <div class="content">
                            {!! $aboutUsContent->translations[0]->content ?? '' !!}
                        </div>
                    </div>
                </div>

                <hr class="artikel-profil">

                <div class="lihat-video">
                    <img src="/asset/images/youtube.png" alt="">
                    <a data-fancybox="" href="https://www.youtube.com/watch?v=bPyOISQp_Mw">
                        <span>
                            <p>@lang('system.see video profile of jiipe industrial area')</p>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Fancybox CSS & JS --}}
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
@endpush
