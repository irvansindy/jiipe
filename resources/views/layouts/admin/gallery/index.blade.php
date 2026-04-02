@extends('layouts.admin.main', ['title' => 'Gallery Management'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-danger">Gallery Management</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Gallery</li>
                                <li class="breadcrumb-item active" aria-current="page">Gallery Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-danger d-flex align-items-center justify-content-between">
                            <h4 class="text-white m-0"><i class="ti ti-photo me-2"></i>Gallery List</h4>
                            <button class="btn btn-light" id="create_gallery" type="button" title="Create Gallery"
                                data-bs-toggle="modal" data-bs-target="#modalGallery">
                                <i class="ti ti-plus"></i> Add Gallery
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($galleries as $gallery)
                                    <div class="col-md-3 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            <div class="position-relative" style="height: 200px; overflow: hidden;">
                                                <img src="{{ $gallery->image ? asset('uploads/gallery/' . $gallery->image) : 'https://via.placeholder.com/400x300/e9ecef/6c757d?text=No+Image' }}"
                                                    class="card-img-top w-100 h-100" style="object-fit: cover;"
                                                    alt="{{ $gallery->translations->first()->title ?? 'Gallery Image' }}"
                                                    loading="lazy">

                                                <!-- Status Badge -->
                                                <span class="position-absolute top-0 start-0 m-2">
                                                    @if ($gallery->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </span>
                                            </div>

                                            <div class="card-body">
                                                <h6 class="card-title text-truncate"
                                                    title="{{ $gallery->translations->first()->title ?? 'No Title' }}">
                                                    {{ $gallery->translations->first()->title ?? 'No Title' }}
                                                </h6>

                                                <div class="d-flex align-items-center text-muted small mb-2">
                                                    <i class="ti ti-calendar me-1"></i>
                                                    {{ $gallery->created_at->format('d M Y') }}
                                                </div>

                                                @if ($gallery->images->count() > 0)
                                                    <div class="d-flex align-items-center text-muted small">
                                                        <i class="ti ti-photo me-1"></i>
                                                        {{ $gallery->images->count() }} additional images
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="card-footer bg-transparent border-top">
                                                <div class="d-flex gap-2 justify-content-end">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-primary action_edit_gallery"
                                                        data-bs-toggle="modal" data-bs-target="#modalGallery"
                                                        data-gallery_id="{{ $gallery->id }}" title="Edit Gallery">
                                                        <i class="ti ti-pencil"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger action_delete_gallery"
                                                        data-gallery_id="{{ $gallery->id }}" title="Delete Gallery">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info text-center mb-0">
                                            <i class="ti ti-info-circle me-2"></i>
                                            No gallery data available. Click "Add Gallery" to create one.
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.gallery.modal_gallery')
@endsection

@push('css')
    <style>
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .card-img-top {
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    @include('layouts.admin.gallery.gallery_js')
@endpush
