@extends('layouts.admin.main', ['title' => 'Career Static Template'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Career</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Career</li>
                                <li class="breadcrumb-item" aria-current="page">Career Static Template</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== [ Cover ] ==================== --}}
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Cover</h4>
                        </div>
                        <div class="card-body">
                            {{-- PERBAIKAN: Alert khusus untuk Cover --}}
                            @if(session('cover_success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('cover_success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if(session('cover_error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ session('cover_error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if($errors->any() && (session('cover_error') || old('cover_title')))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Validation Errors:</strong>
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('store-career-header') }}" method="post" id="cover_form"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Hidden ID Field --}}
                                @if ($career_header)
                                    <input type="hidden" name="id" value="{{ $career_header->id }}">
                                @endif

                                <div class="mb-3">
                                    <ul class="nav nav-tabs mb-3" id="coverTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    id="cover-{{ $locale }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#cover-{{ $locale }}" type="button"
                                                    role="tab" aria-controls="cover-{{ $locale }}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ $properties['native'] }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach ($locales as $locale => $properties)
                                            @php
                                                $careerHeaderTrans = $career_header
                                                    ? $career_header->translations->where('locale', $locale)->first()
                                                    : null;
                                            @endphp
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                id="cover-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="cover-{{ $locale }}-tab">

                                                {{-- Cover Title --}}
                                                <div class="mb-3">
                                                    <label for="cover_title_{{ $locale }}" class="form-label">
                                                        Cover Title ({{ $properties['native'] }})
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="cover_title_{{ $locale }}"
                                                        name="cover_title[{{ $locale }}]"
                                                        value="{{ old('cover_title.' . $locale, $careerHeaderTrans ? $careerHeaderTrans->title : '') }}">
                                                    @error('cover_title.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Cover Image --}}
                                <div class="mb-3">
                                    <label for="cover_image" class="form-label">Cover Image</label>

                                    @if ($career_header && $career_header->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('uploads/career/header/' . $career_header->image) }}"
                                                alt="Current Cover" class="img-thumbnail" style="max-height: 150px;">
                                            <p class="small text-muted mt-1">Current image (upload new to replace)</p>
                                        </div>
                                    @endif

                                    <input type="file" class="form-control" id="cover_image" name="cover_image"
                                        accept="image/jpeg,image/png,image/gif,image/webp,.jpeg,.jpg,.png,.gif,.webp">
                                    @error('cover_image')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="btn btn-primary">{{ $career_header ? 'Update Changes' : 'Save Changes' }}</button>
                            </form>

                            <div id="career-cover-loading" class="video-loading d-none" aria-hidden="true">
                                <div class="text-center">
                                    <div class="spinner-border text-primary" role="status" aria-hidden="true">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="mt-2">Processing...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== [ Section 1 ] ==================== --}}
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Section 1</h4>
                        </div>
                        <div class="card-body">
                            {{-- PERBAIKAN: Alert khusus untuk Section 1 --}}
                            @if(session('section1_success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('section1_success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if(session('section1_error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ session('section1_error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if($errors->any() && (session('section1_error') || old('section1_title')))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Validation Errors:</strong>
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('store-career-section1') }}" method="post" id="section_1_form"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Hidden ID Field --}}
                                @if ($career_section)
                                    <input type="hidden" name="id" value="{{ $career_section->id }}">
                                @endif

                                <ul class="nav nav-tabs mb-3" id="section1Tab" role="tablist">
                                    @foreach ($locales as $locale => $properties)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                id="section1-{{ $locale }}-tab" data-bs-toggle="tab"
                                                data-bs-target="#section1-{{ $locale }}" type="button"
                                                role="tab" aria-controls="section1-{{ $locale }}"
                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                {{ $properties['native'] }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach ($locales as $locale => $properties)
                                        @php
                                            $careerSection1Trans = $career_section
                                                ? $career_section->translations->where('locale', $locale)->first()
                                                : null;
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                            id="section1-{{ $locale }}" role="tabpanel"
                                            aria-labelledby="section1-{{ $locale }}-tab">

                                            {{-- Section 1 Title --}}
                                            <div class="mb-3">
                                                <label for="section1_title_{{ $locale }}" class="form-label">
                                                    Section 1 Title ({{ $properties['native'] }})
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="section1_title_{{ $locale }}"
                                                    name="section1_title[{{ $locale }}]"
                                                    value="{{ old('section1_title.' . $locale, $careerSection1Trans ? $careerSection1Trans->title : '') }}">
                                                @error('section1_title.' . $locale)
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Section 1 Content --}}
                                            <div class="mb-3">
                                                <label for="section1_content_{{ $locale }}" class="form-label">
                                                    Content ({{ $properties['native'] }})
                                                </label>
                                                <textarea name="section1_content[{{ $locale }}]" id="section1_content_{{ $locale }}" cols="30"
                                                    rows="10" class="form-control section1_summernote">{{ old('section1_content.' . $locale, $careerSection1Trans ? $careerSection1Trans->content : '') }}</textarea>
                                                @error('section1_content.' . $locale)
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="submit"
                                    class="btn btn-primary">{{ $career_section ? 'Update Changes' : 'Save Changes' }}</button>
                            </form>

                            <div id="career-section-loading" class="video-loading d-none" aria-hidden="true">
                                <div class="text-center">
                                    <div class="spinner-border text-primary" role="status" aria-hidden="true">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="mt-2">Processing...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.section1_summernote').summernote({
                height: 200
            });
            $('#table_list_content_detail').DataTable();

            // Show loading overlay when submitting cover or section forms
            $('#cover_form').on('submit', function() {
                $('#career-cover-loading').removeClass('d-none');
            });

            $('#section_1_form').on('submit', function() {
                $('#career-section-loading').removeClass('d-none');
            });
        });
    </script>
@endpush