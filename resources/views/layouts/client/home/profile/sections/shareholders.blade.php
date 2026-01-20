<section class="profil-sec-4">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="">
                <p class="info">
                    {{ $shareholders[0]['category']['translations'][0]['name'] ?? '' }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row sec-4 industry lists_profil_industry">
                    @foreach ($shareholders ?? [] as $index => $shareholder)
                        <div class="col-md-30">
                            <div class="items">
                                <img style="height:77px;"
                                    src="{{ asset('uploads/about-us/content_detail/' . $shareholder['icon'] ?? '') }}"
                                    alt="{{ $shareholder['translations'][0]['title'] ?? '' }}" decoding="async"
                                    loading="lazy">
                                <div class="judul">
                                    <p>{{ $shareholder['translations'][0]['title'] ?? '' }}</p>
                                </div>

                                <div class="content">
                                    <p>{!! $shareholder['translations'][0]['description'] ?? '' !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr class="artikel-profil-sec-4">
            </div>
        </div>
    </div>
</section>
