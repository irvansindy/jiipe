<link rel="stylesheet" href="{{ asset('asset/css/creative/navigasi-box-fix.css') }}">

<section class="video-slider pt-5" id="videotour">

    <!-- HEADER SECTION -->
    <div class="virtual-tour-section text-center py-5">

        <!-- Sub Heading -->
        <h2 class="sub-title text-danger text-uppercase font-weight-bold mb-2">
            Virtual Tour
        </h2>

        <!-- Main Title -->
        <h3 class="main-title font-weight-bold mb-4">
            Explore JIIPE in a 360° Virtual Tour
        </h3>

        <!-- Description -->
        <div class="row justify-content-center">
            <p class="desc-text">
                Through this virtual tour, explore JIIPE’s strategic geography and key facilities. Experience the port, <br/>
                industrial zones, and office areas immersively—and discover why JIIPE is an ideal investment <br/>
                destination in Indonesia and Southeast Asia.
            </p>
        </div>

    </div>


    <!-- VIDEO THUMBNAIL SECTION -->
    <div class="video-thumbnail-wrapper">

        <div class="video-thumbnail"
            style="background-image: url('{{ asset($videoTours[0] != null ? $videoTours[0]['thumbnail'] : 'asset/storage/thumbnail/3A1GqSmcKSx4_1773366747.jpg') }}');">

            <!-- Overlay -->
            <div class="video-overlay"></div>

            <!-- Click Area -->
            <a href="{{ $videoTours[0] != null ? $videoTours[0]['embed_code'] : 'https://tours.jiipe.com/tours/5Ss66DNIH' }}"
                target="_blank"
                rel="noopener noreferrer"
                class="video-play-button">

                <div class="play-circle">

                    <span class="ping-effect"></span>

                    <!-- Play SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 111.43 111.43"
                        class="play-icon">
                        <g id="OBJECTS">
                            <path
                                d="M55.71 84.26c-3.68 0-7.36-.18-10.93-.54a2.858 2.858 0 0 1-2.56-3.12 2.864 2.864 0 0 1 3.12-2.56c7.88.78 16.24.65 23.97-.38 1.54-.21 3 .89 3.21 2.45.21 1.56-.89 3-2.45 3.21-4.65.62-9.48.93-14.35.93Z"/>
                        </g>
                    </svg>

                </div>

            </a>

        </div>

    </div>

    @include('layouts.client.home.partials.navigation_box')

</section>


<style>

/* SECTION HEADER */

.virtual-tour-section h2,
.virtual-tour-section h3,
.virtual-tour-section p{
    transition: all 700ms cubic-bezier(0,0,0.2,1);
}

/* SUB TITLE */

.sub-title{
    font-size:14px;
    letter-spacing:1px;
}

/* MAIN TITLE */

.main-title{
    font-size:30px;
    line-height:1.2;
}

@media (min-width:768px){
    .main-title{
        font-size:36px;
    }
}

/* DESCRIPTION */

.desc-text{
    font-size:16px;
    line-height:1.8;
    color:#4b5563;
    text-align:center;
}

/* VIDEO THUMBNAIL WRAPPER */

.video-thumbnail-wrapper{
    padding-left:0.5rem;
    padding-right:0.5rem;
}

/* VIDEO THUMBNAIL */

.video-thumbnail{
    position:relative;
    width:100%;
    height:450px;
    border-radius:1.5rem;
    overflow:hidden;
    box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);
    background-size:cover;
    background-position:center;
}

/* DARK OVERLAY */

.video-overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.25);
}

/* CLICK AREA */

.video-play-button{
    position:absolute;
    inset:0;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
}

/* PLAY CIRCLE */

.play-circle{
    position:relative;
    width:8rem;
    height:8rem;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* PING EFFECT */

.ping-effect{
    position:absolute;
    width:100%;
    height:100%;
    border-radius:50%;
    background:white;
    opacity:0.2;
    animation:ping 1s cubic-bezier(0,0,0.2,1) infinite;
}

/* PLAY ICON */

.play-icon{
    width:6rem;
    height:6rem;
    fill:white;
    filter:drop-shadow(0 4px 4px rgba(0,0,0,0.5));
}

/* ANIMATION */

@keyframes ping{
    75%,100%{
        transform:scale(2);
        opacity:0;
    }
}

</style>