{{-- @extends('layouts.admin.main', ['title' => 'Contact Management'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Contact</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Contact</li>
                                <li class="breadcrumb-item" aria-current="page">Contact Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $locales = config('laravellocalization.supportedLocales');
            @endphp
            <div class="row">
            </div>
        </div>
    </div>
@endsection --}}
@extends('layouts.admin.main', ['title' => 'Contact Overview', 'page' => 'contact'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Contact Settings</h5>
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

            <!-- [ Contact Overview ] start -->
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Contact Overview</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store-contact-overview') }}" method="post" id="contact_overview_form" enctype="multipart/form-data">
                                @csrf

                                {{-- Hidden ID Field --}}
                                @if($contactOverview)
                                    <input type="hidden" name="id" value="{{ $contactOverview->id }}">
                                @endif

                                <div class="mb-3">
                                    <ul class="nav nav-tabs mb-3" id="contactTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    id="contact-{{ $locale }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#contact-{{ $locale }}" type="button"
                                                    role="tab" aria-controls="contact-{{ $locale }}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ $properties['native'] }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach ($locales as $locale => $properties)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                id="contact-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="contact-{{ $locale }}-tab">

                                                <div class="mb-3">
                                                    <label for="title_{{ $locale }}" class="form-label">
                                                        Title ({{ $properties['native'] }})
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="title_{{ $locale }}"
                                                        name="title[{{ $locale }}]"
                                                        value="{{ old('title.' . $locale, $contactOverview ? optional($contactOverview->translations->where('locale', $locale)->first())->title : '') }}">
                                                    @error('title.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="subtitle_{{ $locale }}" class="form-label">
                                                        Subtitle ({{ $properties['native'] }})
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="subtitle_{{ $locale }}"
                                                        name="subtitle[{{ $locale }}]"
                                                        value="{{ old('subtitle.' . $locale, $contactOverview ? optional($contactOverview->translations->where('locale', $locale)->first())->subtitle : '') }}">
                                                    @error('subtitle.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description_{{ $locale }}" class="form-label">
                                                        Description ({{ $properties['native'] }})
                                                    </label>
                                                    <textarea class="form-control summernote"
                                                        id="description_{{ $locale }}"
                                                        name="description[{{ $locale }}]">{{ old('description.' . $locale, $contactOverview ? optional($contactOverview->translations->where('locale', $locale)->first())->description : '') }}</textarea>
                                                    @error('description.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="office_name_{{ $locale }}" class="form-label">
                                                        Office Name ({{ $properties['native'] }})
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="office_name_{{ $locale }}"
                                                        name="office_name[{{ $locale }}]"
                                                        value="{{ old('office_name.' . $locale, $contactOverview ? optional($contactOverview->translations->where('locale', $locale)->first())->office_name : '') }}">
                                                    @error('office_name.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="phone_{{ $locale }}" class="form-label">
                                                        Phone ({{ $properties['native'] }})
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="phone_{{ $locale }}"
                                                        name="phone[{{ $locale }}]"
                                                        value="{{ old('phone.' . $locale, $contactOverview ? optional($contactOverview->translations->where('locale', $locale)->first())->phone : '') }}">
                                                    @error('phone.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="address_{{ $locale }}" class="form-label">
                                                        Address ({{ $properties['native'] }})
                                                    </label>
                                                    <textarea class="form-control"
                                                        id="address_{{ $locale }}"
                                                        name="address[{{ $locale }}]"
                                                        rows="3">{{ old('address.' . $locale, $contactOverview ? optional($contactOverview->translations->where('locale', $locale)->first())->address : '') }}</textarea>
                                                    @error('address.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="map_link_{{ $locale }}" class="form-label">
                                                        Map Link ({{ $properties['native'] }})
                                                    </label>
                                                    <textarea class="form-control"
                                                        id="map_link_{{ $locale }}"
                                                        name="map_link[{{ $locale }}]"
                                                        rows="3"
                                                        placeholder="Google Maps iframe embed code">{{ old('map_link.' . $locale, $contactOverview ? optional($contactOverview->translations->where('locale', $locale)->first())->map_link : '') }}</textarea>
                                                    @error('map_link.' . $locale)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    @if($contactOverview && $contactOverview->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $contactOverview->image) }}"
                                                alt="Current Image" class="img-thumbnail"
                                                style="max-height: 150px;">
                                            <p class="small text-muted mt-1">Current image (upload new to replace)</p>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" id="image" name="image">
                                    @error('image')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    {{ $contactOverview ? 'Update Changes' : 'Save Changes' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Contact Overview ] end -->

        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush