<style>
    .input-group-text {
        border: #53565a 1px solid !important;
    }
</style>

<section class="jiipe-contact" id="contact2">
    <div class="navigasi-box navigasi-box-shadow">
        <ul>
            <li>
                <a href="{{ route('home') }}#videotour">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-map-marked-alt"></i></div>
                        <div class="text">
                            <p>{{ __('Watch') }}</p>
                            <h6 class="title">{{ __('VIDEO TOUR') }}</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ asset('asset/brochure/' . ($settings['section2_home_creative_brochure_mobile'] ?? '')) }}" target="_blank" class="hashmb d-none">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>{{ __('Download') }}</p>
                            <h6>{{ __('JIIPE E-BROCHURE') }}</h6>
                        </div>
                    </div>
                </a>
                <a href="{{ asset('asset/brochure/' . ($settings['section2_home_creative_brochure_desktop'] ?? '')) }}" target="_blank" class="hashds">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>{{ __('Download') }}</p>
                            <h6>{{ __('JIIPE E-BROCHURE') }}</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('home') }}#faq">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-comment-alt"></i></div>
                        <div class="text">
                            <p>{{ __('Frequently') }}</p>
                            <h6>{{ __('ASKED QUESTIONS') }}</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-newspaper"></i></div>
                        <div class="text">
                            <p>{{ __('Gain') }}</p>
                            <h6>{{ __('NEW INSIGHTS') }}</h6>
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
                        <h2>{{ $settings['section10_home_creative_title'] ?? '' }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-form">
            <div class="prelative container">
                <div class="row">
                    <div class="col-lg-60 col-md-60 col-sm-60">
                        {!! $settings['section10_home_creative_subtitles'] ?? '' !!}
                        <p class="mt-2">All fields marked with an asterisk (*) are mandatory</p>
                    </div>
                </div>
                <form action="#" id="contactForm" method="POST">
                    @csrf
                    <div class="row my-3 px-lg-5 px-sm-0">
                        <div class="col-lg-60 col-sm-60 pr-lg-5 pr-sm-0">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        </div>
                        <div class="col-lg-60 col-sm-60 pr-lg-5 pr-sm-0">
                            <h5 class="title">{{ $settings['section10_home_basic_information'] ?? '' }}</h5>
                            <div class="row">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left" for="first_name">{{ $settings['section10_home_label_full_name'] ?? '' }} *</label>
                                <div class="col-lg-50 col-sm-60">
                                    <div class="row">
                                        <div class="col-lg-30 col-sm-60 form-group form-line">
                                            <input id="first_name" name="first_name" type="text" placeholder="{{ $settings['section10_home_placeholder_full_name1'] ?? '' }}" required class="form-control">
                                        </div>
                                        <div class="col-lg-30 col-sm-60 form-group form-line">
                                            <input id="last_name" name="last_name" type="text" placeholder="{{ $settings['section10_home_placeholder_full_name2'] ?? '' }}" required class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="phone_number" class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_label_phone_number'] ?? '' }} *</label>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <input id="phone_number" name="phone_number" placeholder="{{ $settings['section10_home_placeholder_phone_number'] ?? '' }}" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <label for="email" class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_label_email'] ?? '' }} *</label>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <input id="email" name="email" placeholder="{{ $settings['section10_home_placeholder_email'] ?? '' }}" type="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <label for="company_name" class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_label_company_name'] ?? '' }} *</label>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <input id="company_name" name="company_name" placeholder="{{ $settings['section10_home_placeholder_company_name'] ?? '' }}" type="text" required class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <label for="country_origin" class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_label_company_origin'] ?? '' }} *</label>
                                <div class="col-lg-50 col-sm-60">
                                    <div class="row mb-0">
                                        <div class="col-lg-10 col-sm-60 form-group">
                                            <label class="custom-control custom-radio mt-2">
                                                <input id="country_origin_1" name="country_origin" type="radio" class="custom-control-input" value="Indonesia" required>
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Indonesia</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-20 col-sm-60 form-group">
                                            <label class="custom-control custom-radio mt-2">
                                                <input id="country_origin_2" name="country_origin" type="radio" class="custom-control-input" value="Outside of Indonesia" required>
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Outside of Indonesia</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-50 col-sm-60"><hr></div>
                            </div>
                            <h5 class="title">{{ $settings['section10_home_label_reason'] ?? '' }} *</h5>
                            <div class="row form-group">
                                <label class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left"></label>
                                <div class="col-lg-15 col-sm-60">
                                    <label class="custom-control custom-radio" for="reason_">
                                        <input name="reason" id="reason_" type="radio" class="custom-control-input" value="" required>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description"></span>
                                    </label>
                                </div>
                                {{-- @foreach($reasons as $key => $reason)
                                @endforeach --}}
                                @if(($settings['section10_home_label_reason_other'] ?? 1) == 0)
                                    <div class="col-lg-20 col-sm-60">
                                        <label class="custom-control custom-radio" for="reason_other">
                                            <input name="reason" id="reason_other" type="radio" class="custom-control-input" value="Other" required>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Other</span>
                                        </label>
                                    </div>
                                @endif
                            </div>
                            @if(($settings['section10_home_label_reason_other'] ?? 1) == 0)
                                <div id="reason_other_row" class="row d-none">
                                    <div class="col-lg-20 col-sm-60"></div>
                                    <div class="col-lg-20 col-sm-60"></div>
                                    <div class="col-lg-20 col-sm-60 form-group">
                                        <input id="reason_other_input" name="reason_other" placeholder="Other" type="text" class="form-control">
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <label for="classification" class="col-lg-10 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_label_industry'] ?? '' }} *</label>
                                <div class="col-lg-50 col-sm-60 form-group">
                                    <select class="custom-select" name="classification" id="classification" required>
                                        <option value="" disabled selected hidden>{{ $settings['section10_home_placeholder_industry'] ?? '' }}</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            @if(($settings['section10_home_label_industry_other'] ?? 1) == 0)
                                <div id="classification_other_row" class="row d-none">
                                    <div class="col-lg-10 col-sm-60"></div>
                                    <div class="col-lg-50 col-sm-60 form-group">
                                        <input id="classification_other" name="classification_other" placeholder="Other" type="text" class="form-control">
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-30 col-sm-60">
                                    <div class="row">
                                        <label for="land_plot" class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_label_land_plot'] ?? '' }} *</label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <div class="input-group">
                                                <input id="land_plot" name="land_plot" placeholder="Number Only" type="number" required class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">(Ha)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-30 col-sm-60">
                                    <div class="row">
                                        <label for="timeline" class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_label_timeline'] ?? '' }} *</label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <select class="custom-select" name="timeline" required>
                                                <option value="" disabled selected hidden>{{ $settings['section10_home_placeholder_timeline'] ?? '' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 col-sm-60"></div>
                                <div class="col-lg-50 col-sm-60"><hr></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-60 col-sm-60 pr-lg-5 pr-sm-0">
                                    <h5 class="title">{{ $settings['section10_home_label_power'] ?? '' }}</h5>
                                </div>
                                <div class="col-lg-30 col-sm-60">
                                    <div class="row">
                                        <label for="power" class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_placeholder_power'] ?? '' }} *</label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <div class="input-group">
                                                <input id="power" name="power" placeholder="Number Only" type="number" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MW</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-30 col-sm-60">
                                    <div class="row">
                                        <label for="industrial_water" class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_placeholder_water'] ?? '' }} *</label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <div class="input-group">
                                                <input id="industrial_water" name="industrial_water" placeholder="Number Only" type="number" class="form-control" required>
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
                                        <label for="natural_gas" class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_placeholder_gas'] ?? '' }} *</label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <div class="input-group">
                                                <input id="natural_gas" name="natural_gas" placeholder="Number Only" type="number" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MMBTU/annum</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-30 col-sm-60">
                                    <div class="row">
                                        <label for="throughput_via_seaport" class="col-lg-20 col-sm-60 col-form-label text-lg-right text-sm-left">{{ $settings['section10_home_placeholder_throughput'] ?? '' }} *</label>
                                        <div class="col-lg-40 col-sm-60 form-group">
                                            <div class="input-group">
                                                <input id="throughput_via_seaport" name="throughput_via_seaport" placeholder="Number Only" type="number" required class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Tons/Year</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-60 col-sm-60">
                                <div class="row">
                                    <div class="form-group row">
                                        <label class="col-lg-6 col-sm-12 col-form-label text-lg-right text-sm-left"></label>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="g-recaptcha" data-sitekey="6Lcd9b0qAAAAAJ6OQeOmOcA7SBboCzOCFZf1Z1HF"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-5">
                        <div class="col-lg-60 col-md-60 col-sm-60">
                            <input type="hidden" name="reff" value="{{ $activeMenu ?? '' }}">
                            <button type="submit" class="btn btn-block btn-danger">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>

<footer class="footer-area footer-default black-bg footer-map">
    <div class="footer-text">
        <div class="prelative container">
            <div class="row">
                <div class="col-lg-60 col-md-60 col-sm-60">
                    <h2>{{ $settings['section11_home_creative_title'] ?? '' }}</h2>
                    {!! $settings['section11_home_creative_subtitles'] ?? '' !!}
                </div>
            </div>
        </div>
    </div>
    <div class="footer-widget-new">
        <div class="prelative container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 garis-lurus-right">
                    <div class="widget">
                        <h4 class="widget-title line">{{ $settings['section11_office1_creative_title'] ?? '' }}</h4>
                        <div class="widget-office">
                            <p class="title">{{ $settings['section11_office1_creative_name'] ?? '' }}</p>
                            {!! $settings['section11_office1_creative_address'] ?? '' !!}
                            <p class="telp">{{ __('Telepon') }}. <b>{{ $settings['section11_office1_creative_phone'] ?? '' }}</b></p>
                            <p class="title pt-3">{{ $settings['section11_office1_creative_maps1_title'] ?? '' }}</p>
                            <div class="widget-map-box">
                                <iframe src="{{ $settings['section11_office1_creative_maps'] ?? '' }}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="widget">
                        <h4 class="widget-title line">{{ $settings['section11_office2_creative_title'] ?? '' }}</h4>
                        <div class="widget-office">
                            <p class="title">{{ $settings['section11_office2_creative_name'] ?? '' }}</p>
                            {!! $settings['section11_office2_creative_address'] ?? '' !!}
                            <p class="telp">{{ __('Telepon') }}. <b>{{ $settings['section11_office2_creative_phone'] ?? '' }}</b></p>
                            <p class="title pt-3">{{ $settings['section11_office2_creative_maps2_title'] ?? '' }}</p>
                            <div class="widget-map-box">
                                <iframe src="{{ $settings['section11_office2_creative_maps'] ?? '' }}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="widget quick-link">
                        <h4 class="widget-title line">{{ __('quick link') }}</h4>
                        <ul class="widget-menu">
                            <li><a href="#">{{ __('Profil') }}</a></li>
                            <li><a href="{{ route('home') }}#tenants">{{ __('Video Profile Perusahaan') }}</a></li>
                            <li>
                                <a href="{{ asset('asset/brochure/(Mobile Version) E-Brochure JIIPE-Ineractive.pdf') }}" target="_blank" class="hashmb d-none">{{ __('Download Brosur') }}</a>
                                <a href="{{ asset('asset/brochure/(Desktop Version) E-Brochure JIIPE-Ineractive.pdf') }}" target="_blank" class="hashds">{{ __('Download Brosur') }}</a>
                            </li>
                            <li><a href="{{ route('home') }}#videotour">{{ __('Virtual Tour Video') }}</a></li>
                            <li><a href="#">{{ __('Artikel & Berita') }}</a></li>
                            <li><a href="">{{ __('Kontak') }}</a></li>
                        </ul>
                        <div class="icon-media">
                            <p>Get Connected to our social media <br>Form more insight</p>
                            <ul class="social-link">
                                <li><a target="_blank" href="https://www.instagram.com/jiipe.official/"><i class="fab fa-instagram text-white"></i></a></li>
                                <li><a target="_blank" href="https://www.linkedin.com/company/jiipe/"><i class="fab fa-linkedin text-white"></i></a></li>
                                <li><a target="_blank" href="https://www.facebook.com/jiipe.gresik/"><i class="fab fa-facebook text-white"></i></a></li>
                                <li><a target="_blank" href="http://www.youtube.com/c/jiipeofficial"><i class="fab fa-youtube text-white"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright footer-copyright-red">
        <div class="prelative container">
            <div class="row">
                <div class="col-md-30 col-sm-60">
                    <div class="text">
                        <img src="{{ asset('asset/images/jiipe_logo_white_small.png') }}" alt="kawasan industri gresik jiipe">
                        <p>
                            Copyright &copy; 2023
                            <a href="#">PT Berkah Kawasan Manyar Sejahtera</a> |
                            <a href="#">Java Industrial and Ports Estate</a>.
                            All Rights Reserved
                        </p>
                    </div>
                </div>
                <div class="col-md-30 col-sm-60"></div>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<a href="https://wa.me/6281388000168?text={{ urlencode('I would like to know more about JIIPE') }}" target="_blank" class="d-none btn-whatsapp-pulse btn-whatsapp-pulse-border"><i class="fab fa-whatsapp"></i></a>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ asset('asset/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('asset/js/owlslider/owl.carousel.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('asset/js/creative.js?ver=1.0.5') }}"></script>