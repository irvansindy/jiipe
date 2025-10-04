<section class="profil-sec-4">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="">
                <p class="info">
                    {{ __('JIIPE Industrial Estate Developer in Gresik') }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row sec-4 industry lists_profil_industry">
                    @foreach ($developers ?? [] as $developer)
                        <div class="col-md-30">
                            <div class="items">
                                <img style="height:77px;" src="{{ $developer['logo'] ?? '' }}"
                                    alt="{{ $developer['name'] ?? '' }}">

                                <div class="judul">
                                    <p>{{ $developer['name'] ?? '' }}</p>
                                </div>

                                <div class="content">
                                    <p>{!! $developer['description'] ?? '' !!}</p>
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
