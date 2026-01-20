@extends('layouts.client.main', ['title' => $data['title']])

@section('content')
    <section class="block-breadcrumbs">
        <div class="prelative container">
            <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Gallery') }}
                    </li>
                </ol>
            </nav>
            <div class="clear"></div>
        </div>
    </section>

    <section class="gallery-sec-1">
        <div class="prelative container">
            <div class="row">
                {{-- Sidebar Navigation --}}
                <div class="col-md-15">
                    <img src="{{ asset('asset/images/beijing-red.png') }}" alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                    <p class="info">
                        {{ __('GALLERY') }}
                    </p>
                    <div class="side">
                        <div class="leftsn_menu">
                            <div id="mytoSelect"></div>
                            <ul id="lists_leftmenuKawasan" class="list-unstyled d-none d-sm-block">
                                <li>
                                    <a href="{{ route('blog.index') }}">{{ __('All') }}</a>
                                </li>
                                @if (!empty($data['categories']))
                                    @foreach ($data['categories'] as $category)
                                        <li>
                                            <a href="{{ route('blog.detail', $category['id']) }}">
                                                {{ $category['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                                <li class="active">
                                    <a href="{{ route('gallery.index') }}">{{ __('Gallery') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear clearfix"></div>
                </div>

                {{-- Main Content --}}
                <div class="col-md-45">
                    <div class="berita-terbaru">
                        <p>{{ __('Latest videos') }}</p>
                    </div>
                    <hr class="artikel-berita">

                    <div class="blocks_listgallery">
                        <div class="row" id="videoContainer">
                            @forelse($data['videos'] as $video)
                                <div class="col-md-20">
                                    <div class="items">
                                        <div class="tanggal">
                                            <p>{{ $video['date'] }}</p>
                                        </div>
                                        <div class="gambar">
                                            <a href="{{ $video['url_video'] }}?autoplay=1" title="{{ $video['title'] }}"
                                                class="views_youtube">
                                                <img src="{{ $video['image'] }}" alt="{{ $video['title'] }}"
                                                    class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="judul">
                                            <p>{{ $video['title'] }}</p>
                                        </div>
                                        <div class="lebih">
                                            <a href="{{ $video['url_video'] }}?autoplay=1" title="{{ $video['title'] }}"
                                                class="views_youtube">
                                                <p>{{ __('Watch Video') }}
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
                                        {{ __('No videos found.') }}
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>


                    <div class="lihat-semua-foto mt-3">
                        <a id="viewAllBtn" class="text danger px-4 py-2">
                            {{ __('See All Videos') }}
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </section>

    @include('components.appointment-form')
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
    <style>
        section.gallery-sec-1 .berita-terbaru p {
            color: #d22c12;
            font-weight: 700;
            font-size: 24px;
            margin: 0;
        }

        section.gallery-sec-1 .artikel-berita {
            border-top: 2px solid #d22c12;
            margin-bottom: 20px;
        }

        section.gallery-sec-1 .gallery-sec-1 {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        section.gallery-sec-1 .items {
            margin-bottom: 30px;
        }

        section.gallery-sec-1 .items .tanggal p {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        section.gallery-sec-1 .items .judul p {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin: 10px 0;
            min-height: 48px;
        }

        section.gallery-sec-1 .items .gambar {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
        }

        section.gallery-sec-1 .items .gambar img {
            transition: transform 0.3s ease;
        }

        section.gallery-sec-1 .items .gambar:hover img {
            transform: scale(1.05);
        }

        section.gallery-sec-1 .items .lebih a {
            color: #d22c12;
            font-weight: 600;
        }

        section.gallery-sec-1 .items .lebih a:hover {
            text-decoration: underline;
        }

        section.gallery-sec-1 .lihat-semua-foto {
            text-align: center;
            padding: 20px 0;
        }

        section.gallery-sec-1 .lihat-semua-foto button {
            border: none;
            background-color: #d22c12;
            color: #fff;
            font-weight: 600;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        section.gallery-sec-1 .lihat-semua-foto button:hover {
            background-color: #a02310;
        }

        section.gallery-sec-1 .lihat-semua-foto button:disabled {
            background-color: #999;
            cursor: not-allowed;
        }

        section.gallery-sec-1 .lihat-semua-foto a {
            display: inline-block;
            padding: 12px 30px;
            color: #d22c12;
            font-weight: 400;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 16px;
            text-decoration: none; /* hilangkan underline default */
        }

        section.gallery-sec-1 .lihat-semua-foto a:hover {
            text-decoration: underline;
            text-decoration-thickness: 2px;
            text-underline-offset: 6px;
            color: #a02310;
        }

        section.gallery-sec-1 .leftsn_menu ul li.active a {
            color: #d22c12;
            font-weight: 700;
        }
    </style>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Fancybox versi 3
            $('[data-fancybox="gallery"]').fancybox({
                buttons: [
                    "zoom",
                    "slideShow",
                    "thumbs",
                    "close"
                ],
                youtube: {
                    controls: 1,
                    showinfo: 0
                },
                vimeo: {
                    color: 'f00'
                }
            });

            // Jika AJAX load video baru:
            $('#viewAllBtn').on('click', function() {
                var $btn = $(this);
                $btn.prop('disabled', true).text('{{ __('Loading...') }}');

                $.ajax({
                    url: '{{ route('gallery.index') }}',
                    type: 'GET',
                    data: {
                        ajax: 1,
                        type: 'video'
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }, // 👈 tambahkan ini
                    success: function(response) {
                        $('#videoContainer').html(response);
                        $('[data-fancybox="gallery"]').fancybox();
                        $('#viewAllBtn').hide();
                    },
                    error: function() {
                        alert('{{ __('Failed to load videos.') }}');
                        $('#viewAllBtn').prop('disabled', false).text(
                            '{{ __('See All Videos') }}');
                    }
                });

            });

        });
    </script>
@endpush
