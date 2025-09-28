<section class="kawasan-slider">
    <div id="kawasan_wrapper_one" class="kawasan-slider-one carousel slide" data-ride="carousel" data-interval="6000">
        <div class="carousel-inner">
            <div class="carousel-item ">
                <img src="" class="d-block w-100" alt="JIIPE ">
            </div>
            {{-- @forelse($areas as $index => $area)
            @empty
            @endforelse --}}
        </div>
    </div>

    <ol class="carousel-indicators">
        <li data-target="#kawasan_wrapper_one" data-slide-to="" data-attr="" 
            class="data_ ">
            <div class="wrapper-box">
                <h4 class="title"></h4>
                <span class="area"><small>{{ __('Ha') }}</small></span>   
            </div>
        </li>
        {{-- @forelse($areas as $index => $area)
            @empty
        @endforelse --}}
    </ol> 
</section>