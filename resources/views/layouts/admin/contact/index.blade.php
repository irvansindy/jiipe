@extends('layouts.admin.main', ['title' => 'Contact Overview', 'page' => 'contact'])
@section('content')
    {{-- Loading Overlay --}}
    <div id="loadingOverlayContact"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
         background: rgba(0,0,0,0.7); z-index: 9999; align-items: center; justify-content: center;">
        <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-danger">Contact Settings</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Contact Settings</li>
                                <li class="breadcrumb-item" aria-current="page">Contact Overview</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $locales = config('laravellocalization.supportedLocales');
            @endphp

            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Contact Overview</h5>
                            <button type="button" class="btn btn-primary" id="btnRefreshContact">
                                <i class="ti ti-refresh me-1"></i> Refresh
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="formContactOverview" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="contact_id" name="contact_id">

                                {{-- Image Upload --}}
                                <div class="mb-3">
                                    <label for="contact_image" class="form-label">
                                        Image <small class="text-muted">(Max 2MB, PNG/JPG/WebP)</small>
                                    </label>
                                    <input type="file" class="form-control" id="contact_image" name="image"
                                        accept="image/jpeg,image/png,image/jpg,image/webp">
                                    <small class="text-danger" id="error_contact_image"></small>

                                    {{-- Image Preview --}}
                                    <div id="preview_contact_image" class="mt-2"></div>
                                </div>

                                <hr>

                                {{-- Translation Tabs --}}
                                <ul class="nav nav-tabs mb-3" id="contactTransTab" role="tablist">
                                    @foreach ($locales as $locale => $properties)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                id="contact-tab-{{ $locale }}" data-bs-toggle="tab"
                                                data-bs-target="#contact-content-{{ $locale }}" type="button"
                                                role="tab" aria-controls="contact-content-{{ $locale }}">
                                                {{ $properties['native'] }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach ($locales as $locale => $properties)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                            id="contact-content-{{ $locale }}" role="tabpanel"
                                            aria-labelledby="contact-tab-{{ $locale }}">

                                            <div class="mb-3">
                                                <label for="title_{{ $locale }}" class="form-label">
                                                    Title ({{ $properties['native'] }})
                                                </label>
                                                <input type="text" class="form-control" id="title_{{ $locale }}"
                                                    name="title[{{ $locale }}]" placeholder="Enter title">
                                                <small class="text-danger"
                                                    id="error_contact_title_{{ $locale }}"></small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="subtitle_{{ $locale }}" class="form-label">
                                                    Subtitle ({{ $properties['native'] }})
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="subtitle_{{ $locale }}" name="subtitle[{{ $locale }}]"
                                                    placeholder="Enter subtitle">
                                                <small class="text-danger"
                                                    id="error_contact_subtitle_{{ $locale }}"></small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description_{{ $locale }}" class="form-label">
                                                    Description ({{ $properties['native'] }})
                                                </label>
                                                <textarea class="form-control summernote-contact" id="description_{{ $locale }}"
                                                    name="description[{{ $locale }}]" rows="4"></textarea>
                                                <small class="text-danger"
                                                    id="error_contact_description_{{ $locale }}"></small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="office_name_{{ $locale }}" class="form-label">
                                                    Office Name ({{ $properties['native'] }})
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="office_name_{{ $locale }}"
                                                    name="office_name[{{ $locale }}]"
                                                    placeholder="Enter office name">
                                                <small class="text-danger"
                                                    id="error_contact_office_name_{{ $locale }}"></small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone_{{ $locale }}" class="form-label">
                                                    Phone ({{ $properties['native'] }})
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="phone_{{ $locale }}" name="phone[{{ $locale }}]"
                                                    placeholder="Enter phone number">
                                                <small class="text-danger"
                                                    id="error_contact_phone_{{ $locale }}"></small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="address_{{ $locale }}" class="form-label">
                                                    Address ({{ $properties['native'] }})
                                                </label>
                                                <textarea class="form-control" id="address_{{ $locale }}" name="address[{{ $locale }}]" rows="3"
                                                    placeholder="Enter address"></textarea>
                                                <small class="text-danger"
                                                    id="error_contact_address_{{ $locale }}"></small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="map_link_{{ $locale }}" class="form-label">
                                                    Map Link ({{ $properties['native'] }})
                                                </label>
                                                <textarea class="form-control" id="map_link_{{ $locale }}" name="map_link[{{ $locale }}]"
                                                    rows="3" placeholder="Google Maps iframe embed code"></textarea>
                                                <small class="text-danger"
                                                    id="error_contact_map_link_{{ $locale }}"></small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-primary" id="btnSaveContact">
                                    <i class="ti ti-device-floppy me-1"></i> Save Changes
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('asset/js/cdn/jquery-v3-7-1.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/sweetalert2.js') }}"></script>
    <script src="{{ asset('asset/js/cdn/summernote.js') }}"></script>
    @include('layouts.admin.contact.contact_overview_js')
@endpush
