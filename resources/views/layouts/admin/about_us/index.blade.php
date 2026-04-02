@extends('layouts.admin.main', ['title' => 'Company Information', 'page' => 'company'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-danger">General Settings</h5>
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
                        <div class="card-header bg-danger">
                            <h4 class="text-white m-0">Cover</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store-about-us-header') }}" method="post" id="cover_form"
                                class="form-with-overlay" enctype="multipart/form-data">
                                @csrf

                                {{-- Hidden ID Field --}}
                                @if ($aboutUsHeader)
                                    <input type="hidden" name="id" value="{{ $aboutUsHeader->id }}">
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
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                id="cover-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="cover-{{ $locale }}-tab">
                                                <div class="mb-3">
                                                    <label for="cover_title_{{ $locale }}" class="form-label">Cover
                                                        Title ({{ $properties['native'] }})</label>
                                                    <input type="text" class="form-control"
                                                        id="cover_title_{{ $locale }}"
                                                        name="cover_title_{{ $locale }}"
                                                        value="{{ old('cover_title_' . $locale, $aboutUsHeader ? optional($aboutUsHeader->translations->where('locale', $locale)->first())->title : '') }}">
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
                                    @if ($aboutUsHeader && $aboutUsHeader->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('uploads/about-us/header/' . $aboutUsHeader->image) }}"
                                                alt="Current Cover" class="img-thumbnail" style="max-height: 150px;"
                                                loading="lazy" decoding="async">
                                            <p class="small text-muted mt-1">Current image (upload new to replace)</p>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" id="cover_image" name="cover_image">
                                    @error('cover_image')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    {{ $aboutUsHeader ? 'Update Changes' : 'Save Changes' }}
                                </button>
                                <div id="cover-loading" class="form-loading d-none" aria-hidden="true">
                                    <div class="text-center">
                                        <div class="spinner-border text-primary" role="status" aria-hidden="true">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <div class="mt-2">Processing...</div>
                                    </div>
                                </div>
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
                        <div class="card-header bg-danger">
                            <h4 class="text-white m-0">Content</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store-about-us-content') }}" method="post" id="content_form"
                                class="form-with-overlay" enctype="multipart/form-data">
                                @csrf

                                {{-- Hidden ID Field --}}
                                @if ($aboutUsContent)
                                    <input type="hidden" name="id" value="{{ $aboutUsContent->id }}">
                                @endif

                                <div class="mb-3">
                                    <ul class="nav nav-tabs mb-3" id="contentTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    id="content-{{ $locale }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#content-{{ $locale }}" type="button"
                                                    role="tab" aria-controls="content-{{ $locale }}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ $properties['native'] }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($locales as $locale => $properties)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                id="content-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="content-{{ $locale }}-tab">
                                                <div class="mb-3">
                                                    <label for="content_title_{{ $locale }}"
                                                        class="form-label">Content Title
                                                        ({{ $properties['native'] }})
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="content_title_{{ $locale }}"
                                                        name="content_title_{{ $locale }}"
                                                        value="{{ old('content_title_' . $locale, $aboutUsContent ? optional($aboutUsContent->translations->where('locale', $locale)->first())->title : '') }}">
                                                    @error('content_title_' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="content_subtitle_{{ $locale }}"
                                                        class="form-label">Content Sub Title
                                                        ({{ $properties['native'] }})</label>
                                                    <input type="text" class="form-control"
                                                        id="content_subtitle_{{ $locale }}"
                                                        name="content_subtitle_{{ $locale }}"
                                                        value="{{ old('content_subtitle_' . $locale, $aboutUsContent ? optional($aboutUsContent->translations->where('locale', $locale)->first())->subtitle : '') }}">
                                                    @error('content_subtitle_' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="content_body_{{ $locale }}"
                                                        class="form-label">Content Body
                                                        ({{ $properties['native'] }})</label>
                                                    <textarea class="form-control summernote" id="content_body_{{ $locale }}"
                                                        name="content_body_{{ $locale }}">{{ old('content_body_' . $locale, $aboutUsContent ? optional($aboutUsContent->translations->where('locale', $locale)->first())->content : '') }}</textarea>
                                                    @error('content_body_' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="mb-3">
                                            <label for="content_image" class="form-label">Content Image</label>
                                            @if ($aboutUsContent && $aboutUsContent->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('uploads/about-us/content/' . $aboutUsContent->image) }}"
                                                        alt="Current Content" class="img-thumbnail"
                                                        style="max-height: 150px;" loading="lazy" decoding="async">
                                                    <p class="small text-muted mt-1">Current image (upload new to replace)
                                                    </p>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" id="content_image"
                                                name="content_image">
                                            @error('content_image')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="content_video_url" class="form-label">Content Video URL</label>
                                            <input type="text" class="form-control" id="content_video_url"
                                                name="content_video_url"
                                                value="{{ old('content_video_url', $aboutUsContent?->video_url) }}">
                                            @error('content_video_url')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    {{ $aboutUsContent ? 'Update Changes' : 'Save Changes' }}
                                </button>
                                <div id="content-loading" class="form-loading d-none" aria-hidden="true">
                                    <div class="text-center">
                                        <div class="spinner-border text-primary" role="status" aria-hidden="true">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <div class="mt-2">Processing...</div>
                                    </div>
                                </div>
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
                        <div class="card-header bg-danger">
                            <h4 class="text-white m-0">Visi Misi</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('store-about-us-vision-mission') }}"
                                id="vision_mission_form" class="form-with-overlay" enctype="multipart/form-data">
                                @csrf

                                {{-- Hidden ID Field --}}
                                @if ($aboutUsVisionMission)
                                    <input type="hidden" name="id" value="{{ $aboutUsVisionMission->id }}">
                                @endif

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
                                                    <label for="title_{{ $locale }}" class="form-label">Title
                                                        ({{ $properties['native'] }})
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="title_{{ $locale }}" name="title[{{ $locale }}]"
                                                        value="{{ old('title.' . $locale, $aboutUsVisionMission ? optional($aboutUsVisionMission->translations->where('locale', $locale)->first())->title : '') }}">
                                                    @error('title.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="vision_{{ $locale }}" class="form-label">Vision
                                                        ({{ $properties['native'] }})</label>
                                                    <textarea class="form-control summernote" id="vision_{{ $locale }}" name="vision[{{ $locale }}]">{{ old('vision.' . $locale, $aboutUsVisionMission ? optional($aboutUsVisionMission->translations->where('locale', $locale)->first())->vision : '') }}</textarea>
                                                    @error('vision.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mission_{{ $locale }}" class="form-label">Mission
                                                        ({{ $properties['native'] }})</label>
                                                    <textarea class="form-control summernote" id="mission_{{ $locale }}" name="mission[{{ $locale }}]">{{ old('mission.' . $locale, $aboutUsVisionMission ? optional($aboutUsVisionMission->translations->where('locale', $locale)->first())->mission : '') }}</textarea>
                                                    @error('mission.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ $aboutUsVisionMission ? 'Update Changes' : 'Save Changes' }}
                                </button>
                                <div id="vision-loading" class="form-loading d-none" aria-hidden="true">
                                    <div class="text-center">
                                        <div class="spinner-border text-primary" role="status" aria-hidden="true">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <div class="mt-2">Processing...</div>
                                    </div>
                                </div>
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
                        <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                            <h4 class="text-white m-0">Content Detail</h4>
                            <button class="btn btn-light btn-sm float-end" id="create_content_detail"
                                data-bs-toggle="modal" data-bs-target="#modalContentDetail">
                                <i class="ti ti-plus"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_list_content_detail"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Icon</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
    <link rel="stylesheet" href="{{ asset('asset/css/cdn/datatable-bootstrap5.css') }}">
    <link href="{{ asset('asset/css/cdn/select2.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .form-loading {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .form-loading.d-none {
            display: none;
        }

        .form-with-overlay {
            position: relative;
        }

        /* FIX: Pastikan SweetAlert selalu di atas modal Bootstrap */
        .swal2-container {
            z-index: 9999 !important;
        }

        /* Bootstrap modal default z-index adalah 1050-1060 */
        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('asset/js/cdn/jquery-v3-7-1.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/datatable.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/datatable-bootstrap5.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/summernote.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/select2.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/moment.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('layouts.admin.about_us.content_detail_js')

    <script>
        (function() {
            function clearErrors($form) {
                $form.find('.text-danger.small.ajax-error').remove();
                $form.find('.is-invalid').removeClass('is-invalid');
            }

            function showOverlay(id) {
                $('#' + id).removeClass('d-none');
            }

            function hideOverlay(id) {
                $('#' + id).addClass('d-none');
            }

            function handleAjaxSubmit(selector, loadingId) {
                $(document).on('submit', selector, function(e) {
                    e.preventDefault();
                    var $form = $(this);
                    clearErrors($form);
                    var btn = $form.find('button[type="submit"]');
                    btn.prop('disabled', true);
                    showOverlay(loadingId);

                    var url = $form.attr('action');
                    var method = ($form.attr('method') || 'POST').toUpperCase();
                    var fd = new FormData(this);

                    $.ajax({
                        url: url,
                        type: method,
                        data: fd,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': 'application/json'
                        },
                        success: function(res) {
                            hideOverlay(loadingId);
                            btn.prop('disabled', false);
                            var message = 'Saved successfully';
                            if (res && res.message) message = res.message;

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: message,
                                timer: 2000,
                                showConfirmButton: false
                            });

                            // If server returns an id, ensure hidden input is present
                            if (res && (res.id || (res.data && res.data.id))) {
                                var id = res.id || res.data.id;
                                if ($form.find('input[name="id"]').length) {
                                    $form.find('input[name="id"]').val(id);
                                } else {
                                    $form.prepend('<input type="hidden" name="id" value="' + id +
                                        '">');
                                }
                            }
                        },
                        error: function(xhr) {
                            hideOverlay(loadingId);
                            btn.prop('disabled', false);
                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, msgs) {
                                    var name = key;
                                    if (name.indexOf('.') !== -1) {
                                        var parts = name.split('.');
                                        name = parts[0] + '[' + parts.slice(1).join('][') +
                                            ']';
                                    }
                                    var $field = $form.find('[name="' + name + '"]');
                                    var cleanMsgs = msgs.map(function(m) {
                                        return (m || '').replace(/[_\.]/g, ' ');
                                    });
                                    var $err = $(
                                        '<div class="text-danger small ajax-error">' +
                                        cleanMsgs.join('<br>') + '</div>');
                                    if ($field.length) {
                                        $field.addClass('is-invalid');
                                        $field.after($err);
                                    } else {
                                        var idKey = 'message_' + key.replace(
                                            /[^a-zA-Z0-9_]/g, '_');
                                        var $msgHolder = $('#' + idKey);
                                        if ($msgHolder.length) {
                                            $msgHolder.text(cleanMsgs[0]);
                                        } else {
                                            $form.prepend($err);
                                        }
                                    }
                                });
                            } else {
                                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr
                                    .responseJSON.message : 'Server error';
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: msg
                                });
                            }
                        }
                    });
                });
            }

            // attach handlers
            handleAjaxSubmit('#cover_form', 'cover-loading');
            handleAjaxSubmit('#content_form', 'content-loading');
            handleAjaxSubmit('#vision_mission_form', 'vision-loading');
        })();
    </script>
@endpush
