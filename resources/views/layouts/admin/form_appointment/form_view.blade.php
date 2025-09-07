@extends('layouts.admin.main', ['title' => 'Form Appointment', 'page' => 'form_appointment'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Form Appointment</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Form Appointment</li>
                                <li class="breadcrumb-item" aria-current="page">Form Appointment</li>
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
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Section Quick Appointment</h4>
                        </div>
                        <div class="card-body">
                            <form id="form_create_appointment" method="post"
                                action="{{ route('store-quick-appointment') }}">
                                @csrf
                                <div class="mb-3">
                                    <ul class="nav nav-tabs" id="appointmentTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link @if ($loop->first) active @endif"
                                                    id="tab-appointment-{{ $locale }}" data-bs-toggle="tab"
                                                    data-bs-target="#appointment-{{ $locale }}" type="button"
                                                    role="tab" aria-controls="appointment-{{ $locale }}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ strtoupper($locale) }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content border border-top-0 p-3">
                                        @foreach ($locales as $locale => $properties)
                                            <div class="tab-pane fade @if ($loop->first) show active @endif"
                                                id="appointment-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="tab-appointment-{{ $locale }}">
                                                <div class="mb-3">
                                                    <label for="title_quick_appointment_{{ $locale }}"
                                                        class="form-label">
                                                        Title Quick Appointment ({{ strtoupper($locale) }})
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="title_quick_appointment_{{ $locale }}"
                                                        name="title_quick_appointment[{{ $locale }}]" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="appointment_description_{{ $locale }}"
                                                        class="form-label">
                                                        Description ({{ strtoupper($locale) }})
                                                    </label>
                                                    <textarea class="form-control summernote" id="appointment_description_{{ $locale }}"
                                                        name="appointment_description[{{ $locale }}]" rows="3" required></textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Appointment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <h4 class="text-white m-0">Basic Information</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $locales = config('laravellocalization.supportedLocales');
                            @endphp
                            <form method="POST" action="{{ route('store-basic-information') }}">
                                @csrf
                                <div class="mb-3">
                                    <ul class="nav nav-tabs mb-3" id="localeTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link @if ($loop->first) active @endif"
                                                    id="tab-{{ $locale }}" data-bs-toggle="tab"
                                                    data-bs-target="#tab-content-{{ $locale }}" type="button"
                                                    role="tab" aria-controls="tab-content-{{ $locale }}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    <span class="flag-icon flag-icon-{{ $locale }}"></span>
                                                    {{ strtoupper($locale) }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($locales as $locale => $properties)
                                            <div class="tab-pane fade @if ($loop->first) show active @endif"
                                                id="tab-content-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="tab-{{ $locale }}">
                                                <div class="mb-3">
                                                    <label for="title_basic_information_{{ $locale }}"
                                                        class="form-label">
                                                        Title Basic Information
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="title_basic_information_{{ $locale }}"
                                                        name="title_basic_information[{{ $locale }}]" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Full Name</label>
                                                        <input type="text" class="form-control"
                                                            name="label_full_name[{{ $locale }}]" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Full Name 1</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_full_name_1[{{ $locale }}]" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Full Name 2</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_full_name_2[{{ $locale }}]" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Phone Number</label>
                                                        <input type="text" class="form-control"
                                                            name="label_phone_number[{{ $locale }}]" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Phone Number</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_phone_number[{{ $locale }}]" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Email</label>
                                                        <input type="text" class="form-control"
                                                            name="label_email[{{ $locale }}]" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Email</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_email[{{ $locale }}]" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Company Name</label>
                                                        <input type="text" class="form-control"
                                                            name="label_company_name[{{ $locale }}]" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Company Name</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_company_name[{{ $locale }}]" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Company Origin Country</label>
                                                        <input type="text" class="form-control"
                                                            name="label_company_origin_country[{{ $locale }}]"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Company Origin
                                                            Country</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_company_origin_country[{{ $locale }}]"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200
            });
        });
    </script>
@endpush
