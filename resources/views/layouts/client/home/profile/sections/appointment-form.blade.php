<section class="jiipe-contact" id="contact2">
    {{-- Navigation Box --}}
    <div class="navigasi-box navigasi-box-shadow">
        <ul>
            <li>
                <a href="{{ url('/') }}#videotour">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon">
                            <i class="fa fa-map-marked-alt"></i>
                        </div>
                        <div class="text">
                            <p>{{ __('Watch') }}</p>
                            <h6 class="title">{{ __('VIDEO TOUR') }}</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ asset('asset/brochure/JIIPE-Brochure-English.pdf') }}" target="_blank">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon">
                            <i class="fa fa-book-open"></i>
                        </div>
                        <div class="text">
                            <p>{{ __('Download') }}</p>
                            <h6>{{ __('JIIPE E-BROCHURE') }}</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}#faq">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon">
                            <i class="fa fa-comment-alt"></i>
                        </div>
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
                        <div class="icon">
                            <i class="fa fa-newspaper"></i>
                        </div>
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

    {{-- Contact Section --}}
    <section id="contact">
        <div class="contact-images">
            <div class="prelative container">
                <div class="row">
                    <div class="col-lg-60 col-md-60 col-sm-60 py-5">
                        <h2>
                            {{ __('Appointment for Industrial Land Acquisition') }} / <br>
                            {{ __('Request for Proposal') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        @include('components.appointment-form')
    </section>
</section>
