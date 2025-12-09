@extends('layouts.admin.main', ['title' => 'Gallery Management'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Gallery</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Gallery</li>
                                <li class="breadcrumb-item" aria-current="page">Gallery Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary d-flex align-items-center justify-content-between">
                            <h4 class="text-white m-0">List Gallery</h4>
                            <button class="btn btn-outline-light" id="create_gallery" type="button" title="Create Gallery"
                                data-bs-toggle="modal" data-bs-target="#modalGallery">
                                <i class="ti ti-pencil"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($galleries as $gallery)
                                    <div class="col-md-3 mb-4">
                                        <div class="card text-bg-dark">
                                            <img src="{{ optional($gallery)->image ? asset('uploads/gallery/' . $gallery->image) : 'https://dummyimage.com/700x500/c9cecf/000000' }}"
                                                class="card-img" alt="..." loading="lazy" decoding="async">

                                            <div class="card-img-overlay">
                                                <h5 class="card-title">
                                                    {{ $gallery->translations->first()->title ?? 'No Title' }}
                                                </h5>

                                                <!-- Tombol aksi di kanan bawah -->
                                                <div class="position-absolute bottom-0 end-0 p-3 d-flex gap-2">
                                                    <button type="button"
                                                        class="btn btn-sm btn-primary action_edit_gallery"
                                                        data-bs-toggle="modal" data-bs-target="#modalGallery"
                                                        data-gallery_id="{{ $gallery->id }}">
                                                        <i class="ti ti-pencil"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-secondary action_view_gallery"
                                                        data-gallery_id="{{ $gallery->id }}">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-warning text-center mb-0">
                                            Belum ada data gallery.
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            {{-- Pagination --}}
                            @if ($galleries->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $galleries->links('pagination::bootstrap-5') }}
                                </div>
                            @endif
                        </div>
                        @include('layouts.admin.gallery.modal_gallery')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    @include('layouts.admin.gallery.gallery_js')
@endpush
