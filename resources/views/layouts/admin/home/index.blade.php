@extends('layouts.admin.main', ['title' => 'Home Page'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">General Settings</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item" aria-current="page">Home Page</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Slider</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills justify-content-end mb-2" id="chart-tab-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="btn btn-outline-dark me-1" id="refresh_table_slider" type="button"
                                        title="Refresh Table">
                                        <i class="ti ti-refresh"></i>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="btn btn-outline-primary" id="create_slider" type="button"
                                        data-bs-toggle="modal" data-bs-target="#ModalSlider" title="Create Slider">
                                        <i class="ti ti-pencil"></i>
                                    </button>
                                </li>
                            </ul>
                            @include('layouts.admin.home.table_slider')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Zone/Show Case</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-xl-12 col-sm-12">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="btn btn-outline-dark me-1" id="refresh_table_zone"
                                                    type="button" title="Refresh Table">
                                                    <i class="ti ti-refresh"></i>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="btn btn-outline-primary" id="create_zone" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#modalZone" title="Create Zone">
                                                    <i class="ti ti-pencil"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card tbl-card">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs mb-3" id="zoneTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="special-zone" data-bs-toggle="tab"
                                                        data-bs-target="#tab-special-zone" type="button" role="tab"
                                                        aria-controls="tab-special-zone" aria-selected="true">
                                                        Special Economic Zone
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="zone" data-bs-toggle="tab"
                                                        data-bs-target="#tab-zone" type="button" role="tab"
                                                        aria-controls="tab-zone" aria-selected="false">
                                                        Zone
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content border border-top-0 p-3">
                                                <div class="tab-pane fade show active" id="tab-special-zone" role="tabpanel"
                                                    aria-labelledby="special-zone">
                                                    @include('layouts.admin.zone.special_zone')
                                                </div>
                                                <div class="tab-pane fade" id="tab-zone" role="tabpanel"
                                                    aria-labelledby="zone">
                                                    @include('layouts.admin.zone.zone')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('layouts.admin.zone.modal_zone')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Tenant</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills justify-content-end mb-2" id="chart-tab-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="btn btn-outline-dark me-1" id="refresh_table_tenant" type="button"
                                        title="Refresh Table">
                                        <i class="ti ti-refresh"></i>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="btn btn-outline-primary" id="create_tenant" type="button"
                                        data-bs-toggle="modal" data-bs-target="#ModalTenant" title="Create Tenant">
                                        <i class="ti ti-pencil"></i>
                                    </button>
                                </li>
                            </ul>
                            @include('layouts.admin.home.table_tenant')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0"> Tour</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('submit-video360') }}" method="post" id="cover_form"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Hidden ID Field --}}
                                @if ($video = app(\App\Http\Controllers\Admin\Video360Controller::class)->fetchVideo360())
                                    <input type="hidden" name="id" value="{{ $video->id }}">
                                @endif

                                <div class="mb-3">
                                    <ul class="nav nav-tabs mb-3" id="videoTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    id="video-{{ $locale }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#video-{{ $locale }}" type="button"
                                                    role="tab" aria-controls="video-{{ $locale }}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ $properties['native'] }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($locales as $locale => $properties)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                id="video-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="video-{{ $locale }}-tab">
                                                <div class="mb-3">
                                                    <label for="video_title_{{ $locale }}" class="form-label">video
                                                        Title ({{ $properties['native'] }})</label>
                                                    <input type="text" class="form-control"
                                                        id="video_title_{{ $locale }}"
                                                        name="video_title[{{ $locale }}]"
                                                        value="{{ old('video_title_' . $locale, $video ? optional($video->translations->where('locale', $locale)->first())->title : '') }}">
                                                    @error('video_title_' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="embed_code">Embed Code for Video 360</label>
                                    <textarea class="form-control" id="embed_code" name="embed_code">{{ old('embed_code', $video ? $video->embed_code : '') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="video_thumbnail" class="form-label">Video Thumbnail</label>
                                    @if ($video && $video->thumbnail)
                                        <div class="mb-2">
                                            <img src="{{ asset($video->thumbnail) }}" alt="Current thumbnail"
                                                class="img-thumbnail" style="max-height: 150px;">
                                            <p class="small text-muted mt-1">Current image (upload new to replace)</p>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" id="video_thumbnail"
                                        name="video_thumbnail">
                                    @error('video_thumbnail')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    {{ $video ? 'Update Changes' : 'Save Changes' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Users Review</h4>
                        </div>
                        <div class="card-body">
                            @include('layouts.admin.home.table_user_review')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Frequently Asked Questions (FAQ)</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills justify-content-end mb-2" id="chart-tab-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="btn btn-outline-dark me-1" id="refresh_table_faq" type="button" title="Refresh Table">
                                        <i class="ti ti-refresh"></i>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="btn btn-outline-primary" id="btnAddFaq" type="button" data-bs-toggle="modal" data-bs-target="#faqModal" title="Create FAQ">
                                        <i class="ti ti-pencil"></i>
                                    </button>
                                </li>
                            </ul>
                            @include('layouts.admin.home.table_faq')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('layouts.admin.home.modal.slider.modal_slider')
@include('layouts.admin.home.modal.tenant.modal_tenant')
@include('layouts.admin.home.modal.review.modal_review')
@include('layouts.admin.home.modal.faq.modal_faq')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/cdn/datatable-bootstrap5.css') }}">
    <link href="{{ asset('asset/css/cdn/summernote.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('asset/js/cdn/jquery-v3-7-1.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/datatable.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/datatable-bootstrap5.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/summernote.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/select2.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/moment.js') }}"></script>
    @include('layouts.admin.home.js.home_js')
@endpush
