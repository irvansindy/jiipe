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
                            <p>Watch</p>
                            <h6 class="title">VIDEO TOUR</h6>
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
                            <p>Download</p>
                            <h6>JIIPE E-BROCHURE</h6>
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
                            <p>Download</p>
                            <h6>JIIPE E-BROCHURE</h6>
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
                            <p>Frequently</p>
                            <h6>ASKED QUESTIONS</h6>
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
                        <h5>This form is <strong>only</strong> for businesses genuinely interested in acquiring
                            industrial land within JIIPE SEZ.<br>
                            Please provide accurate details to help us assess your needs and offer the best solutions.
                        </h5>
                        <p class="mt-2">All fields marked with an asterisk (*) are mandatory</p>
                    </div>
                </div>

                <form action="{{ route('store-quick-appointment') }}" id="contactForm" method="POST">
                    @csrf

                    <div class="row my-3 px-lg-5 px-sm-0">
                        <div class="col-lg-60 col-sm-60 pr-lg-5 pr-sm-0">
                            <h5 class="title">Basic Information</h5>

                            <div class="row">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left"
                                    for="first_name">Full Name *</label>
                                <div class="col-lg-50 col-sm-60">
                                    <div class="row">
                                        <div class="col-lg-30 col-sm-60 form-group form-line">
                                            <input id="first_name" name="QuickAppointment[first_name]" type="text"
                                                placeholder="First Name" required class="form-control">
                                        </div>
                                        <div class="col-lg-30 col-sm-60 form-group form-line">
                                            <input id="last_name" name="QuickAppointment[last_name]" type="text"
                                                placeholder="Last Name" required class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="phone_number"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    Phone Number *
                                </label>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <input id="phone_number" name="QuickAppointment[phone_number]"
                                        placeholder="(+62)xxx xxx xxx x" type="text" required class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="email"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    Email *
                                </label>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <input id="email" name="QuickAppointment[email]" placeholder="yourname@mail.com"
                                        type="email" required class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="company_name"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    Company Name *
                                </label>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <input id="company_name" name="QuickAppointment[company_name]"
                                        placeholder="Your Company Name" type="text" required class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="country_origin"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    Company Origin Country *
                                </label>
                                <div class="col-lg-50 col-sm-60">
                                    <div class="row mb-0">
                                        <div class="col-lg-10 col-sm-60 form-group">
                                            <label class="custom-control custom-radio mt-2">
                                                <input id="country_origin_1" name="QuickAppointment[country_origin]"
                                                    type="radio" class="custom-control-input" value="Indonesia"
                                                    required>
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Indonesia</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-20 col-sm-60 form-group">
                                            <label class="custom-control custom-radio mt-2">
                                                <input id="country_origin_2" name="QuickAppointment[country_origin]"
                                                    type="radio" class="custom-control-input"
                                                    value="Outside of Indonesia" required>
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

                            <h5 class="title">The reason for considering JIIPE ? *</h5>

                            <div class="row form-group">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left"></label>
                                <div class="col-lg-15 col-sm-60">
                                    <label class="custom-control custom-radio">
                                        <input name="QuickAppointment[reason]" id="reason_0" type="radio"
                                            class="custom-control-input" value="To Approach Market" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">To Approach Market</span>
                                    </label>
                                </div>
                                <div class="col-lg-15 col-sm-60">
                                    <label class="custom-control custom-radio">
                                        <input name="QuickAppointment[reason]" id="reason_1" type="radio"
                                            class="custom-control-input" value="Require a seaport" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Require a seaport</span>
                                    </label>
                                </div>
                                <div class="col-lg-20 col-sm-60">
                                    <label class="custom-control custom-radio">
                                        <input name="QuickAppointment[reason]" id="reason_2" type="radio"
                                            class="custom-control-input" value="Other" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Other</span>
                                    </label>
                                </div>
                            </div>

                            <div id="reason_other_row" class="row d-none">
                                <div class="col-lg-20 col-sm-60"></div>
                                <div class="col-lg-20 col-sm-60"></div>
                                <div class="col-lg-20 col-sm-60 form-group">
                                    <input id="reason_other" name="QuickAppointment[reason_other]"
                                        placeholder="Other" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="classification"
                                    class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">
                                    Industry *
                                </label>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <select class="custom-select" name="QuickAppointment[classification]"
                                        id="classification" required>
                                        <option value="" disabled selected hidden>Select your Industry</option>
                                        <option value="Chemical">Chemical</option>
                                        <option value="Energy">Energy</option>
                                        <option value="Electronic">Electronic</option>
                                        <option value="Metal">Metal</option>
                                        <option value="Supporting & Logistic">Supporting & Logistic</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div id="classification_other_row" class="row d-none">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <input id="classification_other" name="QuickAppointment[classification_other]"
                                        placeholder="Other" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-30 col-sm-60">
                                    <div class="row">
                                        <label for="land_plot"
                                            class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">
                                            Required Industrial Land Plot *
                                        </label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <div class="input-group">
                                                <input id="land_plot" name="QuickAppointment[land_plot]"
                                                    placeholder="Number Only" type="number" required
                                                    class="form-control">
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
                                            class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">
                                            Timeline Construction *
                                        </label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <select class="custom-select" name="QuickAppointment[timeline]" required>
                                                <option value="" disabled selected hidden>Select your Timeline
                                                    Construction</option>
                                                <option value="1 - 2 Years">1 - 2 Years</option>
                                                <option value="More than 2 Years">More than 2 Years</option>
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

                            <h5 class="title">Energy & Utility Needs</h5>

                            <div class="row">
                                <div class="col-lg-30 col-sm-60">
                                    <div class="row">
                                        <label for="power"
                                            class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">
                                            Total Required Power *
                                        </label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <div class="input-group">
                                                <input id="power" name="QuickAppointment[power]"
                                                    placeholder="Number Only" type="number" required
                                                    class="form-control">
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
                                            class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">
                                            Total Industrial Water *
                                        </label>
                                        <div class="col-lg-40 col-sm-60 form-group">
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
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-30 col-sm-60">
                                    <div class="row">
                                        <label for="natural_gas"
                                            class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">
                                            Total Required Natural Gas *
                                        </label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <div class="input-group">
                                                <input id="natural_gas" name="QuickAppointment[natural_gas]"
                                                    placeholder="Number Only" type="number" required
                                                    class="form-control">
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
                                            class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">
                                            Est. Vol. Throughput Via Seaport *
                                        </label>
                                        <div class="col-lg-40 col-sm-60 form-group">
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
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <div id="recaptcha-container">
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row px-5">
                                <div class="col-lg-60 col-md-60 col-sm-60">
                                    <input type="hidden" name="reff" value="index">
                                    <button type="submit" class="btn btn-block btn-danger">SUBMIT</button>
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
</style>

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle "Other" reason field
            var reasonRadios = document.querySelectorAll('input[name="QuickAppointment[reason]"]');
            var reasonOtherRow = document.getElementById('reason_other_row');

            reasonRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (this.value === 'Other') {
                        reasonOtherRow.classList.remove('d-none');
                    } else {
                        reasonOtherRow.classList.add('d-none');
                    }
                });
            });

            // Handle "Other" classification field
            var classificationSelect = document.getElementById('classification');
            var classificationOtherRow = document.getElementById('classification_other_row');

            if (classificationSelect) {
                classificationSelect.addEventListener('change', function() {
                    if (this.value === 'Other') {
                        classificationOtherRow.classList.remove('d-none');
                    } else {
                        classificationOtherRow.classList.add('d-none');
                    }
                });
            }

            // Form validation
            var form = document.getElementById('contactForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    var recaptchaResponse = grecaptcha.getResponse();
                    if (recaptchaResponse.length === 0) {
                        e.preventDefault();
                        alert('Please complete the reCAPTCHA verification.');
                        return false;
                    }
                });
            }
        });
    </script>
@endpush
@push('js')
        {!! NoCaptcha::renderJs() !!}
@endpush