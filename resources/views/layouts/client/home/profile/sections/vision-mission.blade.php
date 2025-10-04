<section class="profil-sec-2">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/menufooterlogo.png') }}" alt="">
                <p class="info">
                    {{ __('Vision & Mission') }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row visi-misi">
                    <div class="col-md-30">
                        <div class="title">
                            <p>{{ __('Vision') }}</p>
                        </div>
                        <div class="content">
                            <p>{!! $vision ?? '' !!}</p>
                        </div>
                    </div>

                    <div class="col-md-30">
                        <div class="title">
                            <p>{{ __('Mission') }}</p>
                        </div>
                        <div class="content">
                            <p>{!! $mission ?? '' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>