<section class="industri_jippe1-sec-3">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/menufooterlogo.png') }}"
                    alt="@lang('system.Jiipe industrial estate gresik')">
                <p class="info">
                    @lang('system.energy sources and advanced processing facilities in jiipe industrial estates')
                </p>
            </div>

            <div class="col-md-45">
                <div class="row">
                    @foreach ($energies ?? [] as $index => $facility)
                        <div class="col-md-20">
                            <div class="logo">
                                <img src="{{ asset('storage/zone/facilities/' . $facility['icon'] ?? '') }}"
                                    alt="{{ $facility->translations[0]['title'] ?? '' }}" class="img-fluid"
                                    decoding="async" loading="lazy">
                            </div>
                            <div class="title">
                                <p>{{ $facility->translations[0]['subtitle'] ?? '' }}</p>
                            </div>
                            <div class="content text-white">
                                {!! $facility->translations[0]['description'] ?? '' !!}
                                {!! $facility->translations[0]['specifications'] ?? '' !!}
                                <div class="clear"></div>
                            </div>
                            <div class="category">
                            </div>
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
