@extends('layouts.admin.main', ['title' => 'Brochure Management'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Brochure</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Gallery</li>
                                <li class="breadcrumb-item" aria-current="page">Brochure Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">List Brochure</h5>
                            <button class="btn btn-primary" id="create_brochure" type="button"
                                    title="Create Brochure" data-bs-toggle="modal" data-bs-target="#modalBrochure">
                                <i class="ti ti-plus me-1"></i> Add Brochure
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($brochures as $brochure)
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <div class="card h-100">
                                            {{-- Image --}}
                                            <div class="position-relative" style="height: 200px; overflow: hidden;">
                                                <img src="{{ $brochure->image && $brochure->image !== 'default.jpg' ? asset('uploads/' . $brochure->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                                                    class="card-img-top" alt="{{ $brochure->translations->first()->title ?? 'No Title' }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">

                                                {{-- Status Badge --}}
                                                <span class="position-absolute top-0 end-0 m-2 badge {{ $brochure->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $brochure->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>

                                            {{-- Content --}}
                                            <div class="card-body">
                                                <h6 class="card-title text-truncate" title="{{ $brochure->translations->first()->title ?? 'No Title' }}">
                                                    {{ $brochure->translations->first()->title ?? 'No Title' }}
                                                </h6>
                                                @if($brochure->translations->first()->sub_title)
                                                    <p class="card-text text-muted small text-truncate">
                                                        {{ $brochure->translations->first()->sub_title }}
                                                    </p>
                                                @endif

                                                {{-- PDF File Indicator --}}
                                                @if($brochure->translations->first()->file)
                                                    <div class="mt-2">
                                                        <a href="{{ asset('uploads/' . $brochure->translations->first()->file) }}"
                                                           target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                                            <i class="ti ti-file-pdf me-1"></i> View PDF
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Actions --}}
                                            <div class="card-footer bg-transparent border-top">
                                                <div class="d-flex gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-sm btn-warning btn-edit-brochure"
                                                            data-id="{{ $brochure->id }}" title="Edit">
                                                        <i class="ti ti-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-brochure"
                                                            data-id="{{ $brochure->id }}" title="Delete">
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
                                            No brochures available. Click "Add Brochure" to create one.
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            {{-- Pagination (if needed) --}}
                            {{-- @if ($brochures->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $brochures->links('pagination::bootstrap-5') }}
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Modal --}}
    @include('layouts.admin.brochure.modal_brochure')
@endsection

@push('css')
    <style>
        .card-img-top {
            transition: transform 0.3s ease;
        }
        .card:hover .card-img-top {
            transform: scale(1.05);
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('asset/js/cdn/jquery-v3-7-1.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/sweetalert2.js') }}"></script>
    @include('layouts.admin.brochure.brochure_js')
@endpush