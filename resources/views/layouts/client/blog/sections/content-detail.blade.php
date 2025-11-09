<section class="artikel-sec-1">
    <div class="prelative container">
        <div class="row">
            {{-- Sidebar Navigation --}}
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <p class="info">
                    {{ __('Articles & News About the Industrial Zone JIIPE in Gresik') }}
                    {{-- @php
                        dd($data['news']->category->translations[0]['name'])
                    @endphp --}}
                </p>
                <div class="side pt-3">
                    <div class="leftsn_menu">
                        {{-- Mobile Select --}}
                        <div id="mytoSelect"></div>

                        {{-- Desktop Navigation --}}
                        <ul id="lists_leftmenuKawasan" class="list-unstyled d-none d-sm-block">
                            <li class="{{ ($data['activeFilter'] ?? '') === 'all' ? 'active' : '' }}">
                                <a href="{{ route('blog.index') }}">{{ __('All') }}</a>
                            </li>
                            @if(!empty($data['categories']))
                                @foreach($data['categories'] as $category)
                                {{-- @php
                                dd($category);
                                @endphp --}}
                                    <li class="{{ ($category['name'] ?? '') == $data['news']->category->translations[0]['name'] ? 'active' : '' }}">
                                        <a href="{{ route('blog.category', $category['slug']) }}">
                                            {{ $category['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            <li class="{{ ($data['activeFilter'] ?? '') === 'gallery' ? 'active' : '' }}">
                                <a href="{{ route('gallery.index') }}">{{ __('Gallery') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-45 Rights_artikels_pagedetails">
                {{-- Date and Back Button Row --}}
                <div class="row tanggal">
                    <div class="col-md-20">
                        <div class="tanggal">
                            <p>{{ $data['news']->created_at ? $data['news']->created_at->format('M d, Y') : '' }}</p>
                        </div>
                    </div>
                    <div class="col-md-20">
                        {{-- Empty space --}}
                    </div>
                    <div class="col-md-20">
                        <div class="back">
                            <p>
                                <span>
                                    <img class="back-img" src="{{ asset('asset/images/arrow-back.png') }}"
                                         alt="{{ __('JIIPE Industrial Estate Gresik') }}">&nbsp;
                                </span>&nbsp;
                                <a href="{{ route('blog.index') }}">{{ __('Return to Index') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Title --}}
                <div class="judul">
                    <h1>{{ $data['translation']->title ?? $data['pageTitle'] }}</h1>
                </div>

                {{-- Featured Image --}}
                <div style="max-width: 865px; margin-bottom: 1.2rem;">
                    <img class="artikel img img-fluid"
                         src="{{ $data['news']->thumbnail ? (filter_var($data['news']->thumbnail, FILTER_VALIDATE_URL) ? $data['news']->thumbnail : asset('storage/' . $data['news']->thumbnail)) : asset('asset/images/default-blog.jpg') }}"
                         alt="{{ $data['translation']->title ?? '' }}">
                </div>

                {{-- Content --}}
                <div class="content">
                    {!! $data['translation']->content ?? '' !!}
                </div>

                {{-- Link to Other Articles --}}
                <div class="lihat-artikel">
                    <a href="{{ route('blog.index') }}">
                        <p>{{ __('Other Articles & News About JIIPE Industrial Estate in Gresik') }}</p>
                    </a>
                </div>

                {{-- Related Articles --}}
                @php
                    $locale = app()->getLocale();
                    $relatedNews = \App\Models\News::with([
                        'translations' => function($query) use ($locale) {
                            $query->where('locale', $locale);
                        },
                        'category.translations' => function($query) use ($locale) {
                            $query->where('locale', $locale);
                        }
                    ])
                    ->where('category_id', $data['news']->category_id)
                    ->where('id', '!=', $data['news']->id)
                    ->where('is_published', 1)
                    ->orderBy('created_at', 'desc')
                    ->take(2)
                    ->get()
                    ->map(function($news) use ($locale) {
                        $translation = $news->translations->firstWhere('locale', $locale);
                        if (!$translation) return null;

                        return [
                            'id' => $news->id,
                            'title' => $translation->title,
                            'excerpt' => Str::limit(strip_tags($translation->content), 150),
                            'thumbnail' => $news->thumbnail
                                ? (filter_var($news->thumbnail, FILTER_VALIDATE_URL)
                                    ? $news->thumbnail
                                    : asset('storage/' . $news->thumbnail))
                                : asset('asset/images/default-blog.jpg'),
                            'date' => $news->created_at ? $news->created_at->format('M d, Y') : '',
                        ];
                    })
                    ->filter();
                @endphp

                @if($relatedNews->count() > 0)
                    <div class="row artikel-bawah lists_news_blog">
                        <div class="col-md-60"><hr class="artikel-brosur"></div>

                        @foreach($relatedNews as $related)
                            <div class="col-md-20">
                                <div class="items">
                                    <div class="tanggal">
                                        <p>{{ $related['date'] }}</p>
                                    </div>
                                    <div class="gambar">
                                        <a href="{{ route('blog.detail', $related['id']) }}">
                                            <img src="{{ $related['thumbnail'] }}"
                                                 alt="{{ $related['title'] }}"
                                                 class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="judul">
                                        <p>{{ $related['title'] }}</p>
                                    </div>
                                    <div class="content">
                                        <p>{{ $related['excerpt'] }}</p>
                                    </div>
                                    <div class="lebih">
                                        <a href="{{ route('blog.detail', $related['id']) }}">
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

                        <div class="col-md-60"><hr class="artikel-brosur"></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('css')
<style>
    section.artikel-sec-1 .prelative.container .row .content {
        padding-top: 5px;
    }
    section.artikel-sec-1 .prelative.container .row .content p {
        margin-bottom: 15px;
        line-height: 1.6;
    }
    section.artikel-sec-1 .prelative.container .row .judul h1 {
        color: #d22c12;
        font-size: 35px;
        font-family: Montserrat, sans-serif;
        font-weight: 700;
        margin-bottom: 20px;
    }
    .lists_news_blog .col-md-20 .items {
        padding-bottom: 0;
    }
    section.artikel-sec-1 .back {
        text-align: right;
    }
    section.artikel-sec-1 .back a {
        color: #d22c12;
        font-weight: 600;
    }
    section.artikel-sec-1 .back a:hover {
        text-decoration: underline;
    }
    section.artikel-sec-1 .lihat-artikel {
        margin: 30px 0;
        padding: 20px;
        background-color: #f5f5f5;
        border-left: 4px solid #d22c12;
    }
    section.artikel-sec-1 .lihat-artikel a {
        color: #d22c12;
        font-weight: 600;
        font-size: 16px;
    }
    section.artikel-sec-1 .lihat-artikel a:hover {
        text-decoration: underline;
    }
    section.artikel-sec-1 .leftsn_menu ul li a {
        color: #333;
    }
    section.artikel-sec-1 .leftsn_menu ul li.active a {
        color: #d22c12;
        font-weight: 700;
    }
</style>
@endpush

@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        // Mobile select menu
        if ($(window).width() < 767) {
            var myform = document.getElementById('mytoSelect'),
                items = document.getElementById('lists_leftmenuKawasan').getElementsByTagName('li'),
                select = document.createElement('select'),
                len = items.length;

            for(var i = 0; i < len; i++) {
                var option = document.createElement('option');
                var label = items[i].textContent.replace(/\s\s+/g, " ").trim(),
                    link = items[i].getElementsByTagName('a')[0].href,
                    isActive = items[i].classList.contains('active');

                option.textContent = label;
                option.value = link;
                if(isActive) option.selected = true;

                select.appendChild(option);
            }

            myform.appendChild(select);

            $(select).addClass('form-control');
            $(select).change(function(e){
                var selectedLink = $(this).val();
                window.location.href = selectedLink;
                e.preventDefault();
            });
        }
    });
</script>
@endpush