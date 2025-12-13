<section class="industri_jippe1-sec-4">
    <img src="{{ asset('storage/about_us/cover/profil-sec3.jpg' ?? '') }}" decoding="async" loading="lazy"
        alt="Cover Industri" class="cover-image" />
    <div class="prelative container">
        <div class="row"></div>
    </div>
</section>
<section class="profil-sec-4">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="">
                <p class="info">
                    {{ $developers[0]['category']['translations'][0]['name'] ?? '' }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row sec-4 industry lists_profil_industry">
                    @foreach ($developers ?? [] as $index => $developer)
                        <div class="col-md-30">
                            <div class="items">
                                <img style="height:77px;"
                                    src="{{ asset('storage/about_us/content_detail/' . $developer['icon'] ?? '') }}"
                                    alt="{{ $developer['translations'][0]['title'] ?? '' }}" decoding="async"
                                    loading="lazy">

                                <div class="judul">
                                    <p>{{ $developer['translations'][0]['title'] ?? '' }}</p>
                                </div>

                                <div class="content">
                                    <p>{!! $developer['translations'][0]['description'] ?? '' !!}</p>
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
