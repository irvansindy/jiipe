<section class="blog-sec-1 insides_page">
    <div class="prelative container">
        <div class="row utama">
            {{-- Sidebar Navigation --}}
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <h2 class="info">
                    {{ __('Articles & News About the Industrial Zone JIIPE in Gresik') }}
                </h2>
                <div class="side pt-3">
                    <div class="leftsn_menu">
                        {{-- Mobile Select --}}
                        <div id="mytoSelect"></div>

                        {{-- Desktop Navigation --}}
                        <ul id="lists_leftmenuKawasan" class="list-unstyled d-none d-sm-block">
                            <li class="{{ $data['activeFilter'] === 'all' ? 'active' : '' }}">
                                <a href="{{ route('blog.index') }}">{{ __('All') }}</a>
                            </li>
                            @foreach ($data['categories'] as $category)
                                <li class="{{ $data['activeFilter'] === $category['slug'] ? 'active' : '' }}">
                                    <a href="{{ route('blog.category', $category['slug']) }}">
                                        {{ $category['name'] }}
                                    </a>
                                </li>
                            @endforeach
                            <li class="{{ $data['activeFilter'] === 'gallery' ? 'active' : '' }}">
                                <a href="{{ route('gallery.index') }}">{{ __('Gallery') }}</a>
                            </li>
                        </ul>
                        <div class="py-3"></div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-45">
                {{-- Latest News Section --}}
                @if ($data['latestPost'])
                    <div class="berita-terbaru">
                        <p>{{ __('Latest news') }}</p>
                    </div>
                    <hr class="artikel-berita">

                    <div class="row artikel-atas">
                        <div class="col-md-30">
                            <a href="{{ route('blog.detail', $data['latestPost']['id']) }}">
                                <img src="{{ $data['latestPost']['thumbnail'] }}" decoding="async" loading="lazy"
                                    alt="{{ $data['latestPost']['title'] }}" class="img-fluid">
                            </a>
                        </div>
                        <div class="col-md-30">
                            <div class="artikel-berita-atas">
                                <div class="tanggal-blog">
                                    <p>{{ $data['latestPost']['date'] }}</p>
                                </div>
                                <div class="judul-blog">
                                    <a href="{{ route('blog.detail', $data['latestPost']['id']) }}">
                                        <h2>{{ $data['latestPost']['title'] }}</h2>
                                    </a>
                                </div>
                                <div class="content-blog">
                                    <p>{{ $data['latestPost']['excerpt'] }}</p>
                                </div>
                                <div class="lebih">
                                    <a href="{{ route('blog.detail', $data['latestPost']['id']) }}">
                                        <p>{{ __('Read More') }}
                                            <span>
                                                <img src="{{ asset('asset/images/arrow.png') }}"
                                                    alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                                            </span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- News List --}}
                <div class="row artikel lists_news_blog">
                    @forelse($data['posts'] as $index => $post)
                        @if ($index % 3 === 0)
                            <div class="col-md-60">
                                <hr class="artikel-brosur">
                            </div>
                        @endif

                        <div class="col-md-20">
                            <div class="items">
                                <div class="tanggal">
                                    <p>{{ $post['date'] }}</p>
                                </div>
                                <div class="gambar">
                                    <a href="{{ route('blog.detail', $post['id']) }}">
                                        <img src="{{ $post['thumbnail'] }}" alt="{{ $post['title'] }}"
                                            class="img-fluid">
                                    </a>
                                </div>
                                <div class="judul">
                                    <a href="{{ route('blog.detail', $post['id']) }}">
                                        <h2>{{ $post['title'] }}</h2>
                                    </a>
                                </div>
                                <div class="content">
                                    <p>{{ $post['excerpt'] }}</p>
                                </div>
                                <div class="lebih">
                                    <a href="{{ route('blog.detail', $post['id']) }}">
                                        <p>{{ __('Read More') }}
                                            <span>
                                                <img src="{{ asset('asset/images/arrow.png') }}"
                                                    alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                                            </span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-60">
                            <div class="alert alert-info">
                                {{ __('No posts found.') }}
                            </div>
                        </div>
                    @endforelse

                    <div class="col-md-60">
                        <hr class="artikel-brosur">
                    </div>
                </div>

                {{-- Pagination --}}
                @if (method_exists($data['posts'], 'hasPages') && $data['posts']->hasPages())
                    <nav aria-label="Page navigation">
                        {{ $data['posts']->links('vendor.pagination.custom') }}
                    </nav>
                @endif

                {{-- Latest Articles Section --}}
                @if (!empty($data['latestArticles']) && count($data['latestArticles']) > 0)
                    <div class="py-5"></div>
                    <div class="berita-terbaru">
                        <h1 style="font-weight: 700; font-size: inherit;">
                            {{ __('Latest article') }}
                        </h1>
                    </div>

                    <div class="row artikel lists_news_blog">
                        @foreach ($data['latestArticles'] as $index => $article)
                            @if ($index % 3 === 0)
                                <div class="col-md-60">
                                    <hr class="artikel-brosur">
                                </div>
                            @endif

                            <div class="col-md-20">
                                <div class="items">
                                    <div class="tanggal">
                                        <p>{{ $article['date'] }}</p>
                                    </div>
                                    <div class="gambar">
                                        <a href="{{ route('blog.detail', $article['id']) }}">
                                            <img src="{{ $article['thumbnail'] }}" alt="{{ $article['title'] }}"
                                                class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="judul">
                                        <a href="{{ route('blog.detail', $article['id']) }}">
                                            <h2>{{ $article['title'] }}</h2>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <p>{{ $article['excerpt'] }}</p>
                                    </div>
                                    <div class="lebih">
                                        <a href="{{ route('blog.detail', $article['id']) }}">
                                            <p>{{ __('Read More') }}
                                                <span>
                                                    <img src="{{ asset('asset/images/arrow.png') }}"
                                                        alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                                                </span>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-md-60">
                            <hr class="artikel-brosur">
                        </div>
                    </div>

                    {{-- Articles Pagination --}}
                    @if (!empty($data['articlesPagination']))
                        <nav aria-label="Articles pagination">
                            {{ $data['articlesPagination']->links('vendor.pagination.custom') }}
                        </nav>
                    @endif
                @endif
            </div>
        </div>
    </div>
</section>

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Add Bootstrap pagination classes
            $('.pagination li').addClass('page-item');
            $('.pagination li a').addClass('page-link');
            $('.pagination li.selected, .pagination li.active').addClass('active');

            // Mobile select menu
            if ($(window).width() < 767) {
                var myform = document.getElementById('mytoSelect'),
                    items = document.getElementById('lists_leftmenuKawasan').getElementsByTagName('li'),
                    select = document.createElement('select'),
                    len = items.length;

                for (var i = 0; i < len; i++) {
                    var option = document.createElement('option');
                    var label = items[i].textContent.replace(/\s\s+/g, " ").trim(),
                        link = items[i].getElementsByTagName('a')[0].href,
                        isActive = items[i].classList.contains('active');

                    option.textContent = label;
                    option.value = link;
                    if (isActive) option.selected = true;

                    select.appendChild(option);
                }

                myform.appendChild(select);

                $(select).addClass('form-control');
                $(select).change(function(e) {
                    var selectedLink = $(this).val();
                    window.location.href = selectedLink;
                    e.preventDefault();
                });
            }
        });
    </script>
@endpush
