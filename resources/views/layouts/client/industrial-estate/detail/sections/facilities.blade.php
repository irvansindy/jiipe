<section class="industri_jippe1-sec-3">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/menufooterlogo.png') }}"
                    alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <p class="info">
                    {{ __('Energy Sources and Advanced Processing Facilities in JIIPE Industrial Estates') }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row">
                    @foreach ($area['facilities'] ?? [] as $facility)
                        <div class="col-md-20">
                            <div class="logo">
                                <img src="{{ $facility['icon'] ?? '' }}" alt="{{ $facility['title'] ?? '' }}"
                                    class="img-fluid">
                            </div>
                            <div class="title">
                                <p>{{ $facility['title'] ?? '' }}</p>
                            </div>
                            <div class="content">
                                {!! $facility['description'] ?? '' !!}
                                <div class="clear"></div>
                            </div>
                            <div class="category"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Empty Section (if needed for spacing) --}}
<section class="industri_jippe1-sec-4">
    <img src="{{ asset('storage/zone/cover/industry_jiipe.jpg' ?? '') }}" decoding="async" loading="lazy" alt="Cover Industri" class="cover-image" />
    <div class="prelative container">
        <div class="row"></div>
    </div>
</section>
