<section class="industri_jippe1-sec-2">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/menufooterlogo.png') }}"
                    alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <p class="info">
                    {{ __("JIIPE Industrial Estate's Featured Features in Gresik") }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row nlists_block_kunggulan">
                    @foreach ($area['features'] ?? [] as $feature)
                        <div class="col-md-20">
                            <div class="items">
                                <div class="pictures">
                                    <img src="{{ $feature['image'] ?? '' }}" alt="{{ $feature['title'] ?? '' }}"
                                        class="img-fluid">
                                    <span class="names_ap">{{ $feature['title'] ?? '' }}</span>
                                </div>
                                <div class="content">
                                    {!! $feature['description'] ?? '' !!}
                                </div>
                                <div class="clear clearfix"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
