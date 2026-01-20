<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">
<section class="jiipe-contact" id="contact2">
    <div class="navigasi-box navigasi-box-shadow">
        <ul>
            <li>
                <a href="{{ route('home') }}#videotour">
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
                <a href="{{ route('home') }}#faq">
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
                <a href="{{ route('blog.index', ['type' => 'article']) }}">
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
                        <h5>
                            @lang('system.appointment header')
                        </h5>
                        <p class="mt-2">@lang('system.all fields marked with an asterisk (*) are mandatory')</p>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Validation Errors:</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('store-quick-appointment') }}" id="contactForm" method="POST">
                    @csrf

                    <div class="row my-3 px-lg-5 px-sm-0">
                        <div class="col-lg-60 col-sm-60 pr-lg-5 pr-sm-0">
                            <h5 class="title">@lang('system.basic information')</h5>

                            <!-- Full Name -->
                            <div class="row form-group">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left"
                                    for="first_name">@lang('system.full name') *</label>
                                <div class="col-lg-25 col-sm-60">
                                    <input id="first_name" name="QuickAppointment[first_name]" type="text"
                                        placeholder="First Name" required class="form-control">
                                </div>
                                <div class="col-lg-25 col-sm-60">
                                    <input id="last_name" name="QuickAppointment[last_name]" type="text"
                                        placeholder="Last Name" required class="form-control">
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="row form-group">
                                <label for="phone_number"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.phone number') *
                                </label>
                                <div class="col-lg-50 col-sm-60">
                                    <input id="phone_number" name="QuickAppointment[phone_number]"
                                        placeholder="(+62)xxx xxx xxx x" type="text" required class="form-control">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="row form-group">
                                <label for="email"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    Email *
                                </label>
                                <div class="col-lg-50 col-sm-60">
                                    <input id="email" name="QuickAppointment[email]"
                                        placeholder="yourname@mail.com" type="email" required class="form-control">
                                </div>
                            </div>

                            <!-- Company Name -->
                            <div class="row form-group">
                                <label for="company_name"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.company name') *
                                </label>
                                <div class="col-lg-50 col-sm-60">
                                    <input id="company_name" name="QuickAppointment[company_name]"
                                        placeholder="Your Company Name" type="text" required class="form-control">
                                </div>
                            </div>

                            <!-- Country Origin -->
                            <div class="row form-group">
                                <label for="country_origin"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.company origin country') *
                                </label>
                                <div class="col-lg-50 col-sm-60">
                                    <label class="custom-control custom-radio d-inline-block mr-4">
                                        <input id="country_origin_1" name="QuickAppointment[country_origin]"
                                            type="radio" class="custom-control-input" value="Indonesia" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Indonesia</span>
                                    </label>
                                    <label class="custom-control custom-radio d-inline-block">
                                        <input id="country_origin_2" name="QuickAppointment[country_origin]"
                                            type="radio" class="custom-control-input"
                                            value="Outside of Indonesia" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Outside of Indonesia</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-50 col-sm-60">
                                    <hr>
                                </div>
                            </div>

                            <h5 class="title">@lang('system.reason for considering jiipe') ? *</h5>

                            <!-- Reason -->
                            <div class="row form-group">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left"></label>
                                <div class="col-lg-50 col-sm-60">
                                    <label class="custom-control custom-radio d-inline-block mr-4">
                                        <input name="QuickAppointment[reason]" id="reason_0" type="radio"
                                            class="custom-control-input" value="To Approach Market" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">@lang('system.to approach market')</span>
                                    </label>
                                    <label class="custom-control custom-radio d-inline-block mr-4">
                                        <input name="QuickAppointment[reason]" id="reason_1" type="radio"
                                            class="custom-control-input" value="Require a seaport" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">@lang('system.require a seaport')</span>
                                    </label>
                                    <label class="custom-control custom-radio d-inline-block">
                                        <input name="QuickAppointment[reason]" id="reason_2" type="radio"
                                            class="custom-control-input" value="Other" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">@lang('system.other')</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Reason Other -->
                            <div id="reason_other_row" class="row form-group d-none">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-10 col-sm-60">
                                    <input id="reason_other" name="QuickAppointment[reason_other]"
                                        placeholder="Other" type="text" class="form-control">
                                </div>
                            </div>

                            <!-- Industry -->
                            <div class="row form-group">
                                <label for="classification"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.industry') *
                                </label>
                                <div class="col-lg-50 col-sm-60">
                                    <select class="custom-select form-control" name="QuickAppointment[classification]"
                                        id="classification" required>
                                        <option value="" disabled selected hidden>@lang('system.select your industry')</option>
                                        <option value="Chemical">@lang('system.chemical')</option>
                                        <option value="Energy">@lang('system.energy')</option>
                                        <option value="Electronic">@lang('system.electronic')</option>
                                        <option value="Metal">@lang('system.metal')</option>
                                        <option value="Supporting & Logistic">@lang('system.support & logistics')</option>
                                        <option value="Other">@lang('system.other')</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Classification Other -->
                            <div id="classification_other_row" class="row form-group d-none">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-50 col-sm-60">
                                    <input id="classification_other" name="QuickAppointment[classification_other]"
                                        placeholder="Other" type="text" class="form-control">
                                </div>
                            </div>

                            <!-- Land Plot & Timeline -->
                            <div class="row form-group">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.required industrial land plot') *
                                </label>
                                <div class="col-lg-15 col-sm-60">
                                    <div class="input-group">
                                        <input id="land_plot" name="QuickAppointment[land_plot]"
                                            placeholder="Number Only" type="number" required
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">(Ha)</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.timeline construction') *
                                </label>
                                <div class="col-lg-15 col-sm-60">
                                    <select class="custom-select form-control" name="QuickAppointment[timeline]" required>
                                        <option value="" disabled selected hidden>@lang('system.select your timeline construction')
                                        </option>
                                        <option value="1 - 2 Years">@lang('system.1 - 2 years')</option>
                                        <option value="More than 2 Years">@lang('system.more than 2 years')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-50 col-sm-60">
                                    <hr>
                                </div>
                            </div>

                            <h5 class="title">@lang('system.energy & utility needs')</h5>

                            <!-- Power & Industrial Water -->
                            <div class="row form-group">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    Total Required Power *
                                </label>
                                <div class="col-lg-15 col-sm-60">
                                    <div class="input-group">
                                        <input id="power" name="QuickAppointment[power]"
                                            placeholder="Number Only" type="number" required
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">MW</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.total industrial water') *
                                </label>
                                <div class="col-lg-15 col-sm-60">
                                    <div class="input-group">
                                        <input id="industrial_water" name="QuickAppointment[industrial_water]"
                                            placeholder="Number Only" type="number" required
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">m³/day</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Natural Gas & Throughput -->
                            <div class="row form-group">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.total required natural gas') *
                                </label>
                                <div class="col-lg-15 col-sm-60">
                                    <div class="input-group">
                                        <input id="natural_gas" name="QuickAppointment[natural_gas]"
                                            placeholder="Number Only" type="number" required
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">MMBTU/annum</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    @lang('system.est. vol. throughput via seaport') *
                                </label>
                                <div class="col-lg-15 col-sm-60">
                                    <div class="input-group">
                                        <input id="throughput_via_seaport"
                                            name="QuickAppointment[throughput_via_seaport]"
                                            placeholder="Number Only" type="number" required
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Tons/Year</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- reCAPTCHA -->
                            <div class="row form-group">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-50 col-sm-60">
                                    <div id="recaptcha-container">
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row px-5">
                                <div class="col-lg-60 col-md-60 col-sm-60">
                                    <input type="hidden" name="reff" value="index">
                                    <button type="submit"
                                        class="btn btn-block btn-danger">@lang('system.submit')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>

<style>
    /* reCAPTCHA responsive fix */
    #recaptcha-container {
        min-height: 78px;
    }

    #recaptcha-container>div {
        transform: scale(1);
        transform-origin: 0 0;
    }

    @media screen and (max-width: 576px) {
        #recaptcha-container>div {
            transform: scale(0.85);
            transform-origin: 0 0;
        }
    }

    .input-group-text {
        border: 1px solid #ced4da;
        background-color: #e9ecef;
        padding: 0.375rem 0.75rem;
    }

    .alert {
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    /* Radio buttons inline */
    .custom-control.d-inline-block {
        margin-right: 1.5rem;
    }

    @media (max-width: 991px) {
        .custom-control.d-inline-block {
            display: block !important;
            margin-bottom: 0.5rem;
        }
    }
</style>

@push('js')
    {!! NoCaptcha::renderJs() !!}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ---------------------------------------------
             * 1. Handle "Other" for Reason (Radio Button)
             * -------------------------------------------*/
            var reasonRadios = document.querySelectorAll('input[name="QuickAppointment[reason]"]');
            var reasonOtherRow = document.getElementById('reason_other_row');
            var reasonOtherInput = document.getElementById('reason_other');

            function toggleReasonOther() {
                var checked = document.querySelector('input[name="QuickAppointment[reason]"]:checked');
                if (checked && checked.value === 'Other') {
                    reasonOtherRow.classList.remove('d-none');
                    reasonOtherInput.setAttribute('required', 'required');
                    reasonOtherInput.focus();
                } else {
                    reasonOtherRow.classList.add('d-none');
                    reasonOtherInput.removeAttribute('required');
                    reasonOtherInput.value = '';
                }
            }

            // Bind event untuk setiap radio
            reasonRadios.forEach(function(radio) {
                radio.addEventListener('change', toggleReasonOther);
            });

            // Jalankan saat load (untuk old value validasi)
            toggleReasonOther();


            /* ---------------------------------------------
             * 2. Handle "Other" for Classification (Select)
             * -------------------------------------------*/
            var classificationSelect = document.getElementById('classification');
            var classificationOtherRow = document.getElementById('classification_other_row');
            var classificationOtherInput = document.getElementById('classification_other');

            function toggleClassificationOther() {
                if (classificationSelect.value == 'Other') {
                    classificationOtherRow.classList.remove('d-none');
                    classificationOtherInput.setAttribute('required', 'required');
                    classificationOtherInput.focus();
                } else {
                    classificationOtherRow.classList.add('d-none');
                    classificationOtherInput.removeAttribute('required');
                    classificationOtherInput.value = '';
                }
            }

            if (classificationSelect) {
                classificationSelect.addEventListener('change', toggleClassificationOther);
                toggleClassificationOther(); // inisialisasi
            }


            /* ---------------------------------------------
             * 3. Form reCAPTCHA Validation + Debug (opsional)
             * -------------------------------------------*/
            var form = document.getElementById('contactForm');

            if (form) {
                form.addEventListener('submit', function(e) {
                    console.log('Form submitting...');

                    var recaptchaResponse = grecaptcha.getResponse();
                    console.log('reCAPTCHA response:', recaptchaResponse);

                    if (recaptchaResponse.length === 0) {
                        e.preventDefault();
                        alert('Please complete the reCAPTCHA verification.');
                        return false;
                    }

                    // Debug data
                    var formData = new FormData(form);
                    console.log('Form data:');
                    for (var pair of formData.entries()) {
                        console.log(pair[0] + ': ' + pair[1]);
                    }

                    console.log('Form validated, submitting...');
                });
            }

        });
    </script>
@endpush