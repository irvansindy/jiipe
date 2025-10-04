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
                        <img src="{{ $contributionsImage ?? '' }}"
                            alt="{{ __('Profile - JIIPE Industrial Estate Gresik') }}" class="img-fluid">
                    </div>
                    <div class="col-md-30">
                        <div class="content">
                            {!! $contributionsContent ?? '' !!}
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