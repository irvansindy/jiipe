<section class="profil-sec-1">
    <div class="prelative container">
        <div class="row utama">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="">
                <p class="info">
                    {{ __('Profile of JIIPE Industrial Estate in Gresik') }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="judul mb-4 pb-4">
                    <h2>{{ $contributionsTitle ?? 'JIIPE Contributions' }}</h2>
                    <h5>
                        <p>{!! $contributionsDescription ?? '' !!}</p>
                    </h5>
                </div>

                <div class="row gambar-content">
                    <div class="col-md-30">
                        <img src="{{ asset('storage/about_us/content/about_us_content.jpg') }}"
                            alt="{{ __('Profile - JIIPE Industrial Estate Gresik') }}" class="img-fluid">
                    </div>
                    <div class="col-md-30">
                        <div class="content">
                            {!! $aboutUsHeader->translations[0]->description ?? '' !!}
                            {{-- {!! $contributionsContent ?? '' !!} --}}
                            {{-- <div class="content">
                                <p>
                                    JIIPE is the first integrated area in Indonesia, with a total area of 3,000
                                    hectares, consisting of industrial estates, multifunctional public ports, and
                                    residential cities. Located in Gresik, East Java province, JIIPE is a pilot area for
                                    industrial development in Indonesia.
                                </p>
                                <p>
                                    JIIPE industrial area covering 1761 ha with sea port facilities in an area of 400
                                    ha, and occupancy with the concept of an independent city in an area of 800 ha is a
                                    joint government private project between Pelabuhan Indonesia III (Pelindo III
                                    through its subsidiary PT Berlian Jasa Terminal Indonesia known as BJTI Port) with
                                    PT Aneka Kimia Raya Corporindo Tbk (AKR Corp through its subsidiary PT Usaha Era
                                    Pratama Nusantara)
                                </p>
                                <p>
                                    JIIPE Port is the deepest in East Java with -16 LWS, 4 multifunction piers with
                                    6,200 meters of berth, which are expected to be able to serve large vessels with
                                    loads of more than 100,000 DWT. International and domestic access is accommodated
                                    with sea, toll and train connectivity.
                                </p>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <hr class="artikel-profil">

                @if (!empty($videoUrl))
                    <div class="lihat-video">
                        <img src="{{ asset('asset/images/youtube.png') }}" alt="">
                        <a data-fancybox href="{{ $videoUrl }}">
                            <span>
                                <p>{{ __('See video profile of JIIPE industrial area') }}</p>
                            </span>
                        </a>
                    </div>
                @endif
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
