{{-- Video Profile Section --}}
<section class="video-jiipe" id="videojiipe">
    <div class="embed-responsive embed-responsive-21by9">
        <video class="embed-responsive-item" controls>
            <source src="{{ asset('Video_jiipe/62e1d25a28720.mp4') }}" type="video/mp4">
        </video>
    </div>
</section>

{{-- Tenants Section --}}
<section class="video-jiipe" id="tenants">
    <div class="prelative container my-5">
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-3">
                <h2 class="jiipe-main-header jiipe-main-red">{{ __('Our Tenants') }}</h2>
            </div>
        </div>
    </div>

    <div class="prelative container">
        <div class="patner-slider dtr-slick-slider">
            <div class="patner-items"> 
                <img class="img-thumbnail" src="">
            </div>
            {{-- @forelse($tenants as $tenant)
            @empty
            @endforelse --}}
        </div>  
    </div>
    <div class="clear"></div>
</section>