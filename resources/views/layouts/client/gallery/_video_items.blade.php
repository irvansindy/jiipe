@foreach ($videos as $video)
    <div class="col-md-20">
        <div class="items">
            <div class="tanggal">
                <p>{{ $video['date'] }}</p>
            </div>
            <div class="gambar">
                <a href="{{ $video['url_video'] }}?autoplay=1" title="{{ $video['title'] }}" class="views_youtube">
                    <img src="{{ $video['image'] }}" alt="{{ $video['title'] }}" class="img-fluid">
                </a>
            </div>
            <div class="judul">
                <p>{{ $video['title'] }}</p>
            </div>
            <div class="lebih">
                <a href="{{ $video['url_video'] }}?autoplay=1" title="{{ $video['title'] }}" class="views_youtube">
                    <p>{{ __('Watch Video') }}
                        <span><img src="{{ asset('asset/images/arrow.png') }}" alt="arrow"></span>
                    </p>
                </a>
            </div>
        </div>
    </div>
@endforeach
