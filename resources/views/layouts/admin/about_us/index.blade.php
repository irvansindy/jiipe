@extends('layouts.admin.main', ['title' => 'Company Information', 'page' => 'company'])
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
                                <li class="breadcrumb-item">General Settings</li>
                                <li class="breadcrumb-item" aria-current="page">Company Information | About US</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $locales = config('laravellocalization.supportedLocales');
            @endphp
            <!-- [ Cover ] start -->
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Cover</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store-about-us-header') }}" method="post" id="cover_form" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <ul class="nav nav-tabs mb-3" id="coverTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="cover-{{ $locale }}-tab" data-bs-toggle="tab" data-bs-target="#cover-{{ $locale }}" type="button" role="tab" aria-controls="cover-{{ $locale }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ $properties['native'] }}
                                                </button>
                                            </li>

                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($locales as $locale => $properties)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="cover-{{ $locale }}" role="tabpanel" aria-labelledby="cover-{{ $locale }}-tab">
                                                <div class="mb-3">
                                                    <label for="cover_title_{{ $locale }}" class="form-label">Cover Title ({{ $properties['native'] }})</label>
                                                    <input type="text" class="form-control" id="cover_title_{{ $locale }}" name="cover_title_{{ $locale }}" value="{{ old('cover_title_' . $locale) }}">
                                                    @error('cover_title_' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="cover_image" class="form-label">Cover Image</label>
                                    <input type="file" class="form-control" id="cover_image" name="cover_image" >
                                    @error('cover_image')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Cover ] end -->
            <!-- [ Content ] start -->
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Content</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store-about-us-content') }}" method="post" id="content_form" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <ul class="nav nav-tabs mb-3" id="contentTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="content-{{ $locale }}-tab" data-bs-toggle="tab" data-bs-target="#content-{{ $locale }}" type="button" role="tab" aria-controls="content-{{ $locale }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ $properties['native'] }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($locales as $locale => $properties)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content-{{ $locale }}" role="tabpanel" aria-labelledby="content-{{ $locale }}-tab">
                                                <div class="mb-3">
                                                    <label for="content_title_{{ $locale }}" class="form-label">Content Title ({{ $properties['native'] }})</label>
                                                    <input type="text" class="form-control" id="content_title_{{ $locale }}" name="content_title_{{ $locale }}" value="{{ old('content_title_' . $locale) }}">
                                                    @error('content_title_' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="content_subtitle_{{ $locale }}" class="form-label">Content Sub Title ({{ $properties['native'] }})</label>
                                                    <input type="text" class="form-control" id="content_subtitle_{{ $locale }}" name="content_subtitle_{{ $locale }}" value="{{ old('content_subtitle_' . $locale) }}">
                                                    @error('content_subtitle_' .$locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="content_body_{{ $locale }}" class="form-label">Content Body ({{ $properties['native'] }})</label>
                                                    <textarea class="form-control summernote" id="content_body_{{ $locale }}" name="content_body_{{ $locale }}">{{ old('content_body_' . $locale) }}</textarea>
                                                    @error('content_body_' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">
                                            <label for="content_image" class="form-label">Content Image</label>
                                            <input type="file" class="form-control" id="content_image" name="content_image" value="{{ old('content_image') }}">
                                            @error('content_image')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="content_video_url" class="form-label">Content Video URL</label>
                                            <input type="text" class="form-control" id="content_video_url" name="content_video_url" value="{{ old('content_video_url') }}">
                                            @error('content_video_url')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Content ] end -->
            <!-- [ Visi Misi ] start -->
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Visi Misi</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('store-about-us-vision-mission') }}" id="vision_mission_form" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <ul class="nav nav-tabs mb-3" id="visionMissionTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link @if ($loop->first) active @endif"
                                                    id="tab-vision-{{ $locale }}" data-bs-toggle="tab"
                                                    data-bs-target="#tab-content-{{ $locale }}" type="button"
                                                    role="tab" aria-controls="tab-content-{{ $locale }}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    <span class="flag-icon flag-icon-{{ $locale }}"></span>
                                                    {{ strtoupper($properties['native']) }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($locales as $locale => $properties)
                                            <div class="tab-pane fade @if ($loop->first) show active @endif"
                                                id="tab-content-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="tab-vision-{{ $locale }}">
                                                <div class="mb-3">
                                                    <label for="title_{{ $locale }}" class="form-label">Title ({{ $properties['native'] }})</label>
                                                    <input type="text" class="form-control" id="title_{{ $locale }}" name="title[{{ $locale }}]" value="{{ old('title.' . $locale) }}">
                                                    @error('title.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="vision_{{ $locale }}" class="form-label">Vision ({{ $properties['native'] }})</label>
                                                    <textarea class="form-control summernote" id="vision_{{ $locale }}" name="vision[{{ $locale }}]">{{ old('vision.' . $locale) }}</textarea>
                                                    @error('vision.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mission_{{ $locale }}" class="form-label">Mission ({{ $properties['native'] }})</label>
                                                    <textarea class="form-control summernote" id="mission_{{ $locale }}" name="mission[{{ $locale }}]">{{ old('mission.' . $locale) }}</textarea>
                                                    @error('mission.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Visi Misi ] end -->
            <!-- [ Content detail ] start -->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                            <h4 class="text-white m-0">Content Detail</h4>
                            <button class="btn btn-light btn-sm float-end" id="create_content_detail" data-bs-toggle="modal" data-bs-target="#modalContentDetail">
                                <i class="ti ti-plus"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_list_content_detail" width="100%">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Content detail ] end -->
        </div>
    </div>
    @include('layouts.admin.about_us.modal_content_detail')
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    @include('layouts.admin.about_us.content_detail_js')
@endpush