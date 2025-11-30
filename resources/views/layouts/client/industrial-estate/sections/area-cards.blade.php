<div class="row artikel">
    @foreach ($zones ?? [] as $index => $zone)
        <div class="col-md-20">
            <img src="{{ asset('uploads/zones/detail/'.$zone['image_detail'] ?? '') }}" alt="{{ $zone->translations[0]['name'] ?? '' }}" class="img-fluid" decoding="async" loading="lazy">

            <p class="judul">{{ $zone->translations[0]['name'] ?? '' }}</p>
            <p class="sub-judul">{{ $zone->translations[0]['subtitle'] ?? '' }}</p>
            <p class="content">{{ Str::limit($zone->translations[0]['description'] ?? '', 200) }}</p>
            <div class="lebih">
                <a href="{{ route('area.detail', $zone['id']) }}">
                    <p>
                        @lang('system.read more')
                        <span>
                            <img src="{{ asset('asset/images/arrow-red.png') }}"
                                alt="@lang('system.Jiipe industrial estate gresik')">
                        </span>
                    </p>
                </a>
            </div>
        </div>
    @endforeach
</div>
