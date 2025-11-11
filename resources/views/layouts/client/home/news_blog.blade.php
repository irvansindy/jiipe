<section class="jiipe-blog">

    <div class="prelative container">

        <div class="row">

            <div class="col-60 text-center py-lg-4 py-sm-2">

                <h2 class="jiipe-main-header jiipe-main-red">News Update</h2>

            </div>

        </div>

        <div class="row">
            @php
                $news = app(\App\Http\Controllers\Client\HomeController::class)->getNews();
            @endphp
            @foreach($news as $key => $item)
                <div class="col-lg-{{ $key == 0 ? '30' : '15' }} col-sm-60">
                    <div class="items {{ $key == 0 ? 'active' : '' }} pb-lg-4 pb-sm-1">
                        <div class="gambar">
                            <a href="{{ route('blog.detail', $item['id']) }}">
                                <img src="{{ $item['thumbnail'] }}"
                                    alt="{{ $item['title'] }}"
                                    class="img-fluid">
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
                                    Read More
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
