<section class="profil-sec-4">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="">
                <p class="info">
                    {{ __('About JIIPE Integrated Zone Shareholders') }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row sec-4 industry lists_profil_industry">
                    @foreach ($shareholders ?? [] as $shareholder)
                        <div class="col-md-30">
                            <div class="items">
                                <img style="height:77px;" src="{{ $shareholder['logo'] ?? '' }}"
                                    alt="{{ $shareholder['name'] ?? '' }}">

                                <div class="judul">
                                    <p>{{ $shareholder['name'] ?? '' }}</p>
                                </div>

                                <div class="content">
                                    <p>{!! $shareholder['description'] ?? '' !!}</p>
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
