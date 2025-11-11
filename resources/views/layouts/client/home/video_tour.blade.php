<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">

<section class="video-slider pt-5" id="videotour">
    <div>
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-3">
                <h2 class="jiipe-main-header jiipe-main-red">Video Tour</h2>
            </div>
        </div>

        @php
            $videoTours = app(\App\Http\Controllers\Client\HomeController::class)->getVideoTours();
            $firstVideo = $videoTours->first();
        @endphp
        @if($firstVideo)
        {!! $firstVideo['embed_code'] !!}
        {{-- <div class="video-jiipe">
            <div class="embed-responsive embed-responsive-21by9">
            </div>
        </div> --}}
        @else
            <p class="text-center">No video tours available.</p>
        @endif
    </div>

    <div class="navigasi-box navigasi-box-shadow navigasi-box-border-bottom" style="display: block; width: 100%;">
        <ul>
            <li class="hover">
                <a href="#contact">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-calendar-alt"></i></div>
                        <div class="text">
                            <p>Quick Appointment</p>
                            <h6 class="title">PROPOSAL REQUEST</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#videotour">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-map-marked-alt"></i></div>
                        <div class="text">
                            <p>Watch</p>
                            <h6 class="title">VIDEO TOUR</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="/asset/brochure/61a6ed0108(Comp) eBrochure - JIIPE Brochure English.pdf" target="_blank"
                    class="hashmb d-none">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>Download</p>
                            <h6>JIIPE E-BROCHURE</h6>
                        </div>
                    </div>
                </a>
                <a href="/asset/brochure/323829b435(Comp) eBrochure - JIIPE Brochure English.pdf" target="_blank"
                    class="hashds">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>Download</p>
                            <h6>JIIPE E-BROCHURE</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#faq">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                        <div class="icon"><i class="fa fa-comment-alt"></i></div>
                        <div class="text">
                            <p>Frequently</p>
                            <h6>ASKED QUESTIONS</h6>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
</section>


<style>
    .video-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .video-caption {
        padding: 15px;
        background: rgba(255, 255, 255, 0.95);
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .video-caption h4 {
        margin: 0;
        color: #333;
        font-size: 1.2em;
    }

    .video-caption p {
        margin: 8px 0 0;
        color: #666;
        font-size: 0.9em;
    }
</style>
