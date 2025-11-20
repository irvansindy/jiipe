<section class="profil-sec-2">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/menufooterlogo.png') }}" alt="">
                <p class="info">
                    @lang('system.vision & mission')
                </p>
            </div>

            <div class="col-md-45">
                <div class="row visi-misi">
                    <div class="col-md-30">
                        <div class="title mb-4" style="line-height: 1.2;">
                            <p>@lang('system.vision')</p>
                        </div>
                        <div class="content">
                            <p style="line-height: 32px !important;">{!! $vision ?? '' !!}</p>
                        </div>
                    </div>

                    <div class="col-md-30">
                        <div class="title mb-4" style="line-height: 1.2;">
                            <p>@lang('system.mission')</p>
                        </div>
                        <div class="content">
                            <p style="line-height: 32px !important;">{!! $mission ?? '' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>