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
    @include('layouts.client.home.partials.navigation_box')

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
