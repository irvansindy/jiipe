<div class="row artikel">
    @foreach ($areas ?? [] as $area)
        <div class="col-md-20">
            <img src="{{ asset($area['thumbnail'] ?? '') }}" alt="{{ $area['name'] ?? '' }}" class="img-fluid">

            <p class="judul">{{ $area['name'] ?? '' }}</p>
            <p class="sub-judul">{{ $area['subtitle'] ?? '' }}</p>
            <p class="content">{{ Str::limit($area['description'] ?? '', 200) }}</p>

            <div class="lebih">
                <a href="#">
                    <p>
                        {{ __('Read More') }}
                        <span>
                            <img src="{{ asset('asset/images/arrow-red.png') }}"
                                alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                        </span>
                    </p>
                </a>
            </div>
        </div>
    @endforeach
</div>
