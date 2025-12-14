<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">

<section class="video-slider pt-5" id="videotour">
    <div>
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-3">
                <h2 class="jiipe-main-header jiipe-main-red">Video Tour</h2>
            </div>
        </div>
        @if(!empty($videoTours) && count($videoTours) > 0)
            {!! $videoTours[0]['embed_code'] !!}
        @else
            <p class="text-center">No video tours available.</p>
        @endif
    </div>

    @include('layouts.client.home.partials.navigation_box')
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
