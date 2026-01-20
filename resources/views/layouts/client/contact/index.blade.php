@extends('layouts.client.main')

@section('meta')
    <meta name="keywords"
        content="jiipe gresik, ports gresik, ports surabaya, jiipe industrial area, indonesia industrial estate, surabaya industrial estate, gresik industrial estate, kawasan ekonomi khusus gresik, freeport, copper smelter, hailiang asia, hilirisasi industri, industrial downstream, Industriepark Indonesien, asien herstellen, asien als investitionsziel und anreiz, Indonesia Manufacturing Industry outlook and Opportunities, asean, asia, south east asia industrial park, industrial zone, industrial area.">
    <meta name="description"
        content="Hubungi Kawasan Industri Terintegrasi JIIPE di Gresik, Indonesia. Dapatkan segala informasi tentang JIIPE sebagai lahan industri yang paling cocok untuk perkembangan dan kesuksesan usaha anda">
@endsection

@section('title', 'Contact - JIIPE - Java Integrated Industrial and Ports Estate. Gresik, Indonesia.')

@push('styles')
    <style>
        .input-group-text {
            border: #53565a 1px solid !important;
        }

        .lazy-bg {
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .lazy-bg.bg-loaded {
            opacity: 1;
        }
    </style>
@endpush

@section('content')

    {{-- Breadcrumbs --}}
    <section class="block-breadcrumbs">
        <div class="prelative container">
            <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
            <div class="clear"></div>
        </div>
    </section>
    
    {{-- Cover Image - Dynamic --}}
    <section class="cover-profil cover-contact lazy-bg"
        style="background-image: url('{{ asset('uploads/contact/overview/' . $contactData->image ?? 'uploads/contact/overview/3ec59cba31JIIPE Tower up.jpg') }}');">
        <div class="prelative container">
            <div class="row"></div>
        </div>
    </section>

    {{-- Contact Information - Dynamic --}}
    <section class="profil-sec-1">
        <div class="prelative container">
            <div class="row utama">
                <div class="col-md-15">
                    <img src="{{ asset('asset/images/beijing-red.png') }}" alt="kawasan industri gresik jiipe">
                    <p class="info">{{ $contactData->translation->title ?? 'Contact Us' }}</p>
                </div>

                <div class="col-md-45">
                    <div class="judul mb-4 pb-4">
                        <h2>{{ $contactData->translation->subtitle ?? 'We are here to support you' }}</h2>
                        @if ($contactData->translation->description)
                            {!! $contactData->translation->description !!}
                        @else
                            <h5>Please contact our hotline for further information (Monday - Friday, 08.00 - 17.00 local
                                time)</h5>
                            <h5>For inquiries above operating hours, kindly fill in the contact form and we will be in touch
                                with you at our earliest.</h5>
                        @endif
                    </div>

                    <div id="contact-form1" class="contacts_tx_info mb-5 pb-3 pt-1">
                        <div class="row">
                            <div class="col-md-20 col-sm-20">
                                <div class="bx_items">
                                    <div class="sn_icon d-inline-block align-top pr-3">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="sn_text d-inline-block align-top pl-1">
                                        <span class="pb-3 d-block">Headquarters</span>
                                        <p class="pt-1">
                                            <b>{{ $contactData->translation->office_name ?? 'PT. Berkah Kawasan Manyar Sejahtera' }}</b><br>
                                            {!! nl2br(e($contactData->translation->address ?? 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151')) !!}<br>
                                            @if ($contactData->translation->map_link)
                                                <a class="clicks_map" target="_blank"
                                                    href="{{ $contactData->translation->map_link }}">
                                                    Look on Google Map
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-20 col-sm-20">
                                <div class="bx_items">
                                    <div class="sn_icon d-inline-block align-top pr-3">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="sn_text d-inline-block align-top pl-1">
                                        <span class="pb-3 d-block">Telephone</span>
                                        <p class="pt-1">
                                            <a
                                                href="tel:{{ str_replace([' ', '-', '(', ')'], '', $contactData->translation->phone ?? '+6231985409 99') }}">
                                                {{ $contactData->translation->phone ?? '+62 31 985 409 99' }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Navigation Box & Contact Form --}}
    <section class="jiipe-contact" id="contact2">
        {{-- Navigation Box - ALWAYS HORIZONTAL --}}
        <div class="navigasi-box navigasi-box-shadow">
            <ul>
                <li>
                    <a href="{{ url(app()->getLocale()) }}#videotour">
                        <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                            <div class="icon">
                                <i class="fa fa-map-marked-alt"></i>
                            </div>
                            <div class="text">
                                <p>@lang('system.watch')</p>
                                <h6 class="title">@lang('system.video tour')</h6>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ asset('asset/brochure/61a6ed0108(Comp) eBrochure - JIIPE Brochure English.pdf') }}"
                        target="_blank" class="hashmb d-none">
                        <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                            <div class="icon">
                                <i class="fa fa-book-open"></i>
                            </div>
                            <div class="text">
                                <p>@lang('system.download')</p>
                                <h6>@lang('system.jiipe e-brochure')</h6>
                            </div>
                        </div>
                    </a>
                    <a href="{{ asset('asset/brochure/323829b435(Comp) eBrochure - JIIPE Brochure English.pdf') }}"
                        target="_blank" class="hashds">
                        <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                            <div class="icon">
                                <i class="fa fa-book-open"></i>
                            </div>
                            <div class="text">
                                <p>@lang('system.download')</p>
                                <h6>@lang('system.jiipe e-brochure')</h6>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url(app()->getLocale()) }}#faq">
                        <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                            <div class="icon">
                                <i class="fa fa-comment-alt"></i>
                            </div>
                            <div class="text">
                                <p>@lang('system.frequently')</p>
                                <h6>@lang('system.ask questions')</h6>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('blog.index') }}">
                        <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                            <div class="icon">
                                <i class="fa fa-newspaper"></i>
                            </div>
                            <div class="text">
                                <p>Gain</p>
                                <h6>NEW INSIGHTS</h6>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>

        {{-- Contact Form Section --}}
        <section id="contact">
            <div class="contact-images">
                <div class="prelative container">
                    <div class="row">
                        <div class="col-lg-60 col-md-60 col-sm-60 py-5">
                            <h2>Appointment for Industrial Land Acquisition / <br> Request for Proposal</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <div class="prelative container">
                    <div class="row">
                        <div class="col-lg-60 col-md-60 col-sm-60">
                            <h5>This form is <strong>only</strong> for businesses genuinely interested in acquiring
                                industrial land within JIIPE SEZ.<br>
                                Please provide accurate details to help us assess your needs and offer the best solutions.
                            </h5>
                            <p class="mt-2">All fields marked with an asterisk (*) are mandatory</p>
                        </div>
                    </div>

                    <form action="" id="contactForm" method="POST">
                        @csrf

                        <div class="row my-3 px-lg-5 px-sm-0">
                            <div class="col-lg-60 col-sm-60 pr-lg-5 pr-sm-0">
                                {{-- Success/Error Messages --}}
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-60 col-sm-60 pr-lg-5 pr-sm-0">
                                <h5 class="title">Basic Information</h5>

                                {{-- Full Name --}}
                                <div class="row">
                                    <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left"
                                        for="first_name">Full Name *</label>
                                    <div class="col-lg-50 col-sm-60">
                                        <div class="row">
                                            <div class="col-lg-30 col-sm-60 form-group form-line">
                                                <input id="first_name" name="first_name" type="text"
                                                    placeholder="First Name" required class="form-control"
                                                    value="{{ old('first_name') }}">
                                            </div>
                                            <div class="col-lg-30 col-sm-60 form-group form-line">
                                                <input id="last_name" name="last_name" type="text"
                                                    placeholder="Last Name" required class="form-control"
                                                    value="{{ old('last_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Phone Number --}}
                                <div class="row">
                                    <label for="phone_number"
                                        class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">Phone Number
                                        *</label>
                                    <div class="col-lg-50 col-sm-60 form-group">
                                        <input id="phone_number" name="phone_number" placeholder="(+62)xxx xxx xxx x"
                                            type="text" class="form-control" required
                                            value="{{ old('phone_number') }}">
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="row">
                                    <label for="email"
                                        class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">Email
                                        *</label>
                                    <div class="col-lg-50 col-sm-60 form-group">
                                        <input id="email" name="email" placeholder="yourname@mail.com"
                                            type="email" class="form-control" required value="{{ old('email') }}">
                                    </div>
                                </div>

                                {{-- Company Name --}}
                                <div class="row">
                                    <label for="company_name"
                                        class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">Company Name
                                        *</label>
                                    <div class="col-lg-50 col-sm-60 form-group">
                                        <input id="company_name" name="company_name" placeholder="Your Company Name"
                                            type="text" required class="form-control"
                                            value="{{ old('company_name') }}">
                                    </div>
                                </div>

                                {{-- Company Origin Country --}}
                                <div class="row">
                                    <label for="country_origin"
                                        class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">Company
                                        Origin Country *</label>
                                    <div class="col-lg-50 col-sm-60">
                                        <div class="row mb-0">
                                            <div class="col-lg-10 col-sm-60 form-group">
                                                <label class="custom-control custom-radio mt-2">
                                                    <input id="country_origin_1" name="country_origin" type="radio"
                                                        class="custom-control-input" value="Indonesia" required
                                                        {{ old('country_origin') == 'Indonesia' ? 'checked' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Indonesia</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-20 col-sm-60 form-group">
                                                <label class="custom-control custom-radio mt-2">
                                                    <input id="country_origin_2" name="country_origin" type="radio"
                                                        class="custom-control-input" value="Outside of Indonesia" required
                                                        {{ old('country_origin') == 'Outside of Indonesia' ? 'checked' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Outside of Indonesia</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-10 col-sm-60"></div>
                                    <div class="col-lg-50 col-sm-60">
                                        <hr>
                                    </div>
                                </div>

                                {{-- Reason for considering JIIPE --}}
                                <h5 class="title">The reason for considering JIIPE ? *</h5>
                                <div class="row form-group">
                                    <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left"></label>
                                    <div class="col-lg-15 col-sm-60">
                                        <label class="custom-control custom-radio">
                                            <input name="reason" id="reason_0" type="radio"
                                                class="custom-control-input" value="To Approach Market" required
                                                {{ old('reason') == 'To Approach Market' ? 'checked' : '' }}>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">To Approach Market</span>
                                        </label>
                                    </div>
                                    <div class="col-lg-15 col-sm-60">
                                        <label class="custom-control custom-radio">
                                            <input name="reason" id="reason_1" type="radio"
                                                class="custom-control-input" value="Require a seaport" required
                                                {{ old('reason') == 'Require a seaport' ? 'checked' : '' }}>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Require a seaport</span>
                                        </label>
                                    </div>
                                    <div class="col-lg-20 col-sm-60">
                                        <label class="custom-control custom-radio">
                                            <input name="reason" id="reason_2" type="radio"
                                                class="custom-control-input" value="Other" required
                                                {{ old('reason') == 'Other' ? 'checked' : '' }}>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Other</span>
                                        </label>
                                    </div>
                                </div>

                                <div id="reason_other_row" class="row d-none">
                                    <div class="col-lg-20 col-sm-60"></div>
                                    <div class="col-lg-20 col-sm-60"></div>
                                    <div class="col-lg-20 col-sm-60 form-group">
                                        <input id="reason_other" name="reason_other" placeholder="Other" type="text"
                                            class="form-control" value="{{ old('reason_other') }}">
                                    </div>
                                </div>

                                {{-- Industry --}}
                                <div class="row">
                                    <label for="classification"
                                        class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">Industry
                                        *</label>
                                    <div class="col-lg-50 col-sm-60 form-group">
                                        <select class="custom-select" name="classification" id="classification" required>
                                            <option value="" disabled selected hidden>Select your Industry</option>
                                            <option value="Chemical"
                                                {{ old('classification') == 'Chemical' ? 'selected' : '' }}>Chemical
                                            </option>
                                            <option value="Energy"
                                                {{ old('classification') == 'Energy' ? 'selected' : '' }}>Energy</option>
                                            <option value="Electronic"
                                                {{ old('classification') == 'Electronic' ? 'selected' : '' }}>Electronic
                                            </option>
                                            <option value="Metal"
                                                {{ old('classification') == 'Metal' ? 'selected' : '' }}>Metal</option>
                                            <option value="Supporting & Logistic"
                                                {{ old('classification') == 'Supporting & Logistic' ? 'selected' : '' }}>
                                                Supporting & Logistic</option>
                                            <option value="Other"
                                                {{ old('classification') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="classification_other_row" class="row d-none">
                                    <div class="col-lg-10 col-sm-60"></div>
                                    <div class="col-lg-50 col-sm-60 form-group">
                                        <input id="classification_other" name="classification_other" placeholder="Other"
                                            type="text" class="form-control"
                                            value="{{ old('classification_other') }}">
                                    </div>
                                </div>

                                {{-- Land Plot & Timeline --}}
                                <div class="row">
                                    <div class="col-lg-30 col-sm-60">
                                        <div class="row">
                                            <label for="land_plot"
                                                class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">Required
                                                Industrial Land Plot *</label>
                                            <div class="col-lg-40 col-sm-60 form-group">
                                                <div class="input-group">
                                                    <input id="land_plot" name="land_plot" placeholder="Number Only"
                                                        type="number" required class="form-control"
                                                        value="{{ old('land_plot') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">(Ha)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-30 col-sm-60">
                                        <div class="row">
                                            <label for="timeline"
                                                class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">Timeline
                                                Construction *</label>
                                            <div class="col-lg-40 col-sm-60 form-group">
                                                <select class="custom-select" name="timeline" required>
                                                    <option value="" disabled selected hidden>Select your Timeline
                                                        Construction</option>
                                                    <option value="1 - 2 Years"
                                                        {{ old('timeline') == '1 - 2 Years' ? 'selected' : '' }}>1 - 2
                                                        Years</option>
                                                    <option value="More than 2 Years"
                                                        {{ old('timeline') == 'More than 2 Years' ? 'selected' : '' }}>More
                                                        than 2 Years</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-10 col-sm-60"></div>
                                    <div class="col-lg-50 col-sm-60">
                                        <hr>
                                    </div>
                                </div>

                                {{-- Energy & Utility Needs --}}
                                <div class="row">
                                    <div class="col-lg-60 col-sm-60 pr-lg-5 pr-sm-0">
                                        <h5 class="title">Energy & Utility Needs</h5>
                                    </div>

                                    <div class="col-lg-30 col-sm-60">
                                        <div class="row">
                                            <label for="power"
                                                class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">Total
                                                Required Power *</label>
                                            <div class="col-lg-40 col-sm-60 form-group">
                                                <div class="input-group">
                                                    <input id="power" name="power" placeholder="Number Only"
                                                        type="number" class="form-control" required
                                                        value="{{ old('power') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">MW</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-30 col-sm-60">
                                        <div class="row">
                                            <label for="industrial_water"
                                                class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">Total
                                                Industrial Water *</label>
                                            <div class="col-lg-40 col-sm-60 form-group">
                                                <div class="input-group">
                                                    <input id="industrial_water" name="industrial_water"
                                                        placeholder="Number Only" type="number" class="form-control"
                                                        required value="{{ old('industrial_water') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">m³/day</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-30 col-sm-60">
                                        <div class="row">
                                            <label for="natural_gas"
                                                class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">Total
                                                Required Natural Gas *</label>
                                            <div class="col-lg-40 col-sm-60 form-group">
                                                <div class="input-group">
                                                    <input id="natural_gas" name="natural_gas" placeholder="Number Only"
                                                        type="number" class="form-control" required
                                                        value="{{ old('natural_gas') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">MMBTU/annum</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-30 col-sm-60">
                                        <div class="row">
                                            <label for="throughput_via_seaport"
                                                class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">Est.
                                                Vol. Throughput Via Seaport *</label>
                                            <div class="col-lg-40 col-sm-60 form-group">
                                                <div class="input-group">
                                                    <input id="throughput_via_seaport" name="throughput_via_seaport"
                                                        placeholder="Number Only" type="number" required
                                                        class="form-control" value="{{ old('throughput_via_seaport') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Tons/Year</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- reCAPTCHA --}}
                                <div class="col-lg-60 col-sm-60">
                                    <div class="row">
                                        <div class="form-group row">
                                            <label
                                                class="col-lg-6 col-sm-12 col-form-label text-lg-right text-sm-left"></label>
                                            <div class="col-lg-6 col-sm-12">
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="row px-5">
                            <div class="col-lg-60 col-md-60 col-sm-60">
                                <input type="hidden" name="reff" value="contact">
                                <button type="submit" class="btn btn-block btn-danger">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>

@endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{ asset('asset/js/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const lazySections = document.querySelectorAll('.lazy-bg');

            // Lazy load + async decode simulasi
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const bg = el.dataset.bg;

                        // Preload gambar secara async
                        const img = new Image();
                        img.decoding = "async"; // 👈 inilah efek decoding async
                        img.loading = "lazy"; // 👈 efek lazy
                        img.src = bg;

                        img.onload = () => {
                            el.style.backgroundImage = `url('${bg}')`;
                            el.classList.add('bg-loaded');
                        };

                        obs.unobserve(el);
                    }
                });
            });

            lazySections.forEach(el => observer.observe(el));
        });
        $(document).ready(function() {
            // Show/Hide reason other field
            $('input[name="reason"]').on('change', function() {
                if ($(this).val() === 'Other') {
                    $('#reason_other_row').removeClass('d-none');
                    $('#reason_other').prop('required', true);
                } else {
                    $('#reason_other_row').addClass('d-none');
                    $('#reason_other').prop('required', false);
                }
            });

            // Show/Hide classification other field
            $('#classification').on('change', function() {
                if ($(this).val() === 'Other') {
                    $('#classification_other_row').removeClass('d-none');
                    $('#classification_other').prop('required', true);
                } else {
                    $('#classification_other_row').addClass('d-none');
                    $('#classification_other').prop('required', false);
                }
            });

            // Form validation
            $('#contactForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    phone_number: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    phone_number: {
                        required: "Please enter your phone number",
                        minlength: "Phone number must be at least 10 digits"
                    }
                }
            });

            // Trigger change events on page load if old values exist
            @if (old('reason') === 'Other')
                $('#reason_other_row').removeClass('d-none');
                $('#reason_other').prop('required', true);
            @endif

            @if (old('classification') === 'Other')
                $('#classification_other_row').removeClass('d-none');
                $('#classification_other').prop('required', true);
            @endif
        });
    </script>
@endpush
