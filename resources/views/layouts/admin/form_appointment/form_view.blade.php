@extends('layouts.admin.main', ['title' => 'Form Appointment', 'page' => 'form_appointment'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-danger">Form Appointment</h5>
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
                        <div class="card-header bg-danger">
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
                                                    {{ strtoupper($properties['native']) }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content border border-top-0 p-3">
                                        @foreach ($locales as $locale => $properties)
                                            @php
                                                $appointmentTrans = $appointment
                                                    ? $appointment->translations->where('locale', $locale)->first()
                                                    : null;
                                            @endphp
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
                                                        name="title_quick_appointment[{{ $locale }}]" required
                                                        value="{{ old('title_quick_appointment.' . $locale, $appointmentTrans ? $appointmentTrans->title_quick_appointment : '') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="appointment_description_{{ $locale }}"
                                                        class="form-label">
                                                        Description ({{ strtoupper($locale) }})
                                                    </label>
                                                    <textarea class="form-control summernote" id="appointment_description_{{ $locale }}"
                                                        name="appointment_description[{{ $locale }}]" rows="3" required>{{ old('appointment_description.' . $locale, $appointmentTrans ? $appointmentTrans->appointment_description : '') }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ $appointment ? 'Update Appointment' : 'Create Appointment' }}
                                </button>
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
                                    <ul class="nav nav-tabs mb-3" id="basicInformationTab" role="tablist">
                                        @foreach ($locales as $locale => $properties)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link @if ($loop->first) active @endif"
                                                    id="tab-basic-{{ $locale }}" data-bs-toggle="tab"
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
                                            @php
                                                $basicTrans = $basicInfo
                                                    ? $basicInfo->translations->where('locale', $locale)->first()
                                                    : null;
                                            @endphp
                                            <div class="tab-pane fade @if ($loop->first) show active @endif"
                                                id="tab-content-{{ $locale }}" role="tabpanel"
                                                aria-labelledby="tab-basic-{{ $locale }}">
                                                <div class="mb-3">
                                                    <label for="title_basic_information_{{ $locale }}"
                                                        class="form-label">
                                                        Title Basic Information
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="title_basic_information_{{ $locale }}"
                                                        name="title_basic_information[{{ $locale }}]" required
                                                        value="{{ old('title_basic_information.' . $locale, $basicTrans ? $basicTrans->title_basic_information : '') }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Full Name</label>
                                                        <input type="text" class="form-control"
                                                            name="label_full_name[{{ $locale }}]" required
                                                            value="{{ old('label_full_name.' . $locale, $basicTrans ? $basicTrans->label_full_name : '') }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Full Name 1</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_full_name_1[{{ $locale }}]" required
                                                            value="{{ old('placeholder_full_name_1.' . $locale, $basicTrans ? $basicTrans->placeholder_full_name_1 : '') }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Full Name 2</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_full_name_2[{{ $locale }}]" required
                                                            value="{{ old('placeholder_full_name_2.' . $locale, $basicTrans ? $basicTrans->placeholder_full_name_2 : '') }}">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Phone Number</label>
                                                        <input type="text" class="form-control"
                                                            name="label_phone_number[{{ $locale }}]" required
                                                            value="{{ old('label_phone_number.' . $locale, $basicTrans ? $basicTrans->label_phone_number : '') }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Phone Number</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_phone_number[{{ $locale }}]" required
                                                            value="{{ old('placeholder_phone_number.' . $locale, $basicTrans ? $basicTrans->placeholder_phone_number : '') }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Email</label>
                                                        <input type="text" class="form-control"
                                                            name="label_email[{{ $locale }}]" required
                                                            value="{{ old('label_email.' . $locale, $basicTrans ? $basicTrans->label_email : '') }}">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Email</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_email[{{ $locale }}]" required
                                                            value="{{ old('placeholder_email.' . $locale, $basicTrans ? $basicTrans->placeholder_email : '') }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Company Name</label>
                                                        <input type="text" class="form-control"
                                                            name="label_company_name[{{ $locale }}]" required
                                                            value="{{ old('label_company_name.' . $locale, $basicTrans ? $basicTrans->label_company_name : '') }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Company Name</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_company_name[{{ $locale }}]" required
                                                            value="{{ old('placeholder_company_name.' . $locale, $basicTrans ? $basicTrans->placeholder_company_name : '') }}">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label Company Origin Country</label>
                                                        <input type="text" class="form-control"
                                                            name="label_company_origin_country[{{ $locale }}]"
                                                            required
                                                            value="{{ old('label_company_origin_country.' . $locale, $basicTrans ? $basicTrans->label_company_origin_country : '') }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Placeholder Company Origin
                                                            Country</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_company_origin_country[{{ $locale }}]"
                                                            required
                                                            value="{{ old('placeholder_company_origin_country.' . $locale, $basicTrans ? $basicTrans->placeholder_company_origin_country : '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    {{ $basicInfo ? 'Update' : 'Save' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <h4 class="text-white m-0">The reason for considering JIIPE</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $locales = config('laravellocalization.supportedLocales');
                            @endphp
                            <form method="POST" action="{{ route('store-reason') }}">
                                @csrf
                                <ul class="nav nav-tabs mb-3" id="reasonTab" role="tablist">
                                    @foreach ($locales as $locale => $properties)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link @if ($loop->first) active @endif"
                                                id="tab-{{ $locale }}" data-bs-toggle="tab"
                                                data-bs-target="#tab-reason-{{ $locale }}" type="button"
                                                role="tab" aria-controls="tab-reason-{{ $locale }}"
                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                {{ strtoupper($properties['native']) }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach ($locales as $locale => $properties)
                                        @php
                                            $reasonTrans = $reason
                                                ? $reason->translations->where('locale', $locale)->first()
                                                : null;
                                        @endphp
                                        <div class="tab-pane fade @if ($loop->first) show active @endif"
                                            id="tab-reason-{{ $locale }}" role="tabpanel"
                                            aria-labelledby="tab-{{ $locale }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Label The reason</label>
                                                        <input type="text" class="form-control"
                                                            name="label_reason[{{ $locale }}]" required
                                                            value="{{ old('label_reason.' . $locale, $reasonTrans ? $reasonTrans->label_reason : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Label Industry</label>
                                                        <input type="text" class="form-control"
                                                            name="label_industry[{{ $locale }}]" required
                                                            value="{{ old('label_industry.' . $locale, $reasonTrans ? $reasonTrans->label_industry : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Label Required Industrial Land Plot</label>
                                                        <input type="text" class="form-control"
                                                            name="label_land_plot[{{ $locale }}]" required
                                                            value="{{ old('label_land_plot.' . $locale, $reasonTrans ? $reasonTrans->label_land_plot : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Label Timeline Construction</label>
                                                        <input type="text" class="form-control"
                                                            name="label_timeline_construction[{{ $locale }}]"
                                                            required
                                                            value="{{ old('label_timeline_construction.' . $locale, $reasonTrans ? $reasonTrans->label_timeline_construction : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Label Energy & Utility Needs</label>
                                                        <input type="text" class="form-control"
                                                            name="label_energy_utility[{{ $locale }}]" required
                                                            value="{{ old('label_energy_utility.' . $locale, $reasonTrans ? $reasonTrans->label_energy_utility : '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Placeholder Industry</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_industry[{{ $locale }}]" required
                                                            value="{{ old('placeholder_industry.' . $locale, $reasonTrans ? $reasonTrans->placeholder_industry : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Placeholder Required Industrial Land Plot</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_land_plot[{{ $locale }}]" required
                                                            value="{{ old('placeholder_land_plot.' . $locale, $reasonTrans ? $reasonTrans->placeholder_land_plot : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Placeholder Timeline Construction</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_timeline_construction[{{ $locale }}]"
                                                            required
                                                            value="{{ old('placeholder_timeline_construction.' . $locale, $reasonTrans ? $reasonTrans->placeholder_timeline_construction : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Placeholder Total Required Power</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_total_power[{{ $locale }}]" required
                                                            value="{{ old('placeholder_total_power.' . $locale, $reasonTrans ? $reasonTrans->placeholder_total_power : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Placeholder Total Industrial Water</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_total_water[{{ $locale }}]" required
                                                            value="{{ old('placeholder_total_water.' . $locale, $reasonTrans ? $reasonTrans->placeholder_total_water : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Placeholder Total Required Natural Gas</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_total_gas[{{ $locale }}]" required
                                                            value="{{ old('placeholder_total_gas.' . $locale, $reasonTrans ? $reasonTrans->placeholder_total_gas : '') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Placeholder Est. Vol. Throughput Via Seaport</label>
                                                        <input type="text" class="form-control"
                                                            name="placeholder_throughput_seaport[{{ $locale }}]"
                                                            required
                                                            value="{{ old('placeholder_throughput_seaport.' . $locale, $reasonTrans ? $reasonTrans->placeholder_throughput_seaport : '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    {{ $reason ? 'Update' : 'Save' }}
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
