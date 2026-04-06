<section class="jiipe-blog">
    <div class="prelative container">
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-2">
                <h2 class="jiipe-main-header jiipe-main-red">@lang('system.news update')</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($news as $key => $item)
                <div class="col-lg-{{ $key == 0 ? '30' : '15' }} col-sm-60">
                    <div class="items {{ $key == 0 ? 'active' : '' }} pb-lg-4 pb-sm-1">
                        <div class="gambar">
                            <a href="{{ route('blog.detail', $item['id']) }}">
                                {{-- FIX: Tambah width, height, dan decoding untuk mencegah CLS --}}
                                <img src="{{ asset('uploads/blog/' . $item['thumbnail']) }}"
                                    alt="{{ $item['title'] }}"
                                    class="img-fluid"
                                    loading="lazy"
                                    decoding="async"
                                    width="{{ $key == 0 ? '800' : '400' }}"
                                    height="{{ $key == 0 ? '450' : '225' }}">
                            </a>
                        </div>
                        <div class="judul mt-3">
                            <a href="{{ route('blog.detail', $item['id']) }}">
                                <h5>{{ $item['title'] }}</h5>
                            </a>
                        </div>
                        <div class="lebih">
                            <a href="{{ route('blog.detail', $item['id']) }}">
                                <p>
                                    @lang('system.read more')
                                    <span><i class="fa-solid fa-arrow-right"></i></span>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="clear"></div>
</section>

<style>
    .jiipe-blog .items:not(.active) .gambar {
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
    }

    .jiipe-blog .items:not(.active) .gambar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    {{-- FIX: Mencegah CLS dengan placeholder sebelum gambar load --}}
    .jiipe-blog .gambar {
        background-color: #f0f0f0;
        min-height: 10px;
    }
</style>