@extends('layouts.client.main', ['title' => $data['title']])

@section('content')
    <section class="block-breadcrumbs">
        <div class="prelative container">
            <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('gallery.index') }}">{{ __('Gallery') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Videos') }}
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
                                            <a href="{{ route('blog.category', $category['slug']) }}">
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
                        <p>{{ __('All Videos') }}</p>
                    </div>
                    <hr class="artikel-berita">

                    <div class="blocks_listgallery">
                        <div class="row">
                            @forelse($data['videos'] as $video)
                                <div class="col-md-20">
                                    <div class="items">
                                        <div class="tanggal">
                                            <p>{{ $video['date'] }}</p>
                                        </div>
                                        <div class="gambar">
                                            <a href="{{ $video['url_video'] }}?autoplay=1"
                                               title="{{ $video['title'] }}"
                                               class="views_youtube">
                                                <img src="{{ $video['image'] }}"
                                                     alt="{{ $video['title'] }}"
                                                     class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="judul">
                                            <p>{{ $video['title'] }}</p>
                                        </div>
                                        <div class="lebih">
                                            <a href="{{ $video['url_video'] }}?autoplay=1"
                                               title="{{ $video['title'] }}"
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

                    {{-- Pagination --}}
                    @if(method_exists($data['videos'], 'hasPages') && $data['videos']->hasPages())
                        <div class="text-center bgs_paginations">
                            {{ $data['videos']->links('vendor.pagination.custom') }}
                        </div>
                    @endif

                    <hr class="gallery-sec-1">
                    <div class="lihat-semua-foto">
                        <a href="{{ route('gallery.index') }}">
                            <p>{{ __('Back to Gallery') }}</p>
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
    section.gallery-sec-1 .lihat-semua-foto a {
        display: inline-block;
        padding: 12px 30px;
        background-color: #d22c12;
        color: #fff;
        font-weight: 600;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    section.gallery-sec-1 .lihat-semua-foto a:hover {
        background-color: #a02310;
        text-decoration: none;
    }
    section.gallery-sec-1 .leftsn_menu ul li.active a {
        color: #d22c12;
        font-weight: 700;
    }
</style>
@endpush

@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Fancybox for YouTube videos
        $('.views_youtube').fancybox({
            type: 'iframe',
            iframe: {
                css: {
                    width: '80%',
                    height: '80%'
                }
            }
        });

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
                window.location.href = $(this).val();
                e.preventDefault();
            });
        }
    });
</script>
@endpush