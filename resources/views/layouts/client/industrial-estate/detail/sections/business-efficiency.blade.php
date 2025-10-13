<section class="industri_jippe1-sec-5">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <p class="info">
                    {{ __('Efficiency of Business Opening in JIIPE Gresik Industrial Area') }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row">
                    @foreach ($area['business_efficiency'] ?? [] as $efficiency)
                        <div class="col-md-20">
                            <img src="{{ $efficiency['icon'] ?? '' }}" alt="{{ $efficiency['title'] ?? '' }}"
                                style="margin-top:40px">
                            <div class="judul">
                                <p>{{ $efficiency['title'] ?? '' }}</p>
                            </div>
                            <div class="content">
                                {!! $efficiency['description'] ?? '' !!}
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr class="artikel-berita">
            </div>
        </div>
    </div>
</section>
