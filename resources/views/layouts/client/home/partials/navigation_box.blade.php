{{-- navigation_box.blade.php --}}
<div class="navigasi-box navigasi-box-shadow navigasi-box-border-bottom" style="width:100%;">
    <ul>
        <li class>
            <a href="#contact">
                <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex mt-3">
                    <div class="icon"><i class="fa fa-calendar-alt"></i></div>
                    <div class="text">
                        <p>@lang('system.quick appointment')</p>
                        <h6 class="title">@lang('system.request for proposal')</h6>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="#videotour">
                <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex mt-3">
                    <div class="icon"><i class="fa fa-map-marked-alt"></i></div>
                    <div class="text">
                        <p>@lang('system.watch')</p>
                        <h6 class="title">@lang('system.video tour')</h6>
                    </div>
                </div>
            </a>
        </li>
        <li>
            @php
                $brochure = \App\Helpers\BrochureHelper::getActiveBrochure();
                $isMobile = \App\Helpers\BrochureHelper::isMobile();
            @endphp

            @if ($brochure && $brochure->translations->first() && $brochure->translations->first()->file)
                @php
                    $brochureUrl = url('uploads/brochures/files/' . $brochure->translations->first()->file);
                    $brochureId = $brochure->translations->first()->id;
                @endphp

                @if ($isMobile)
                    {{-- Mobile Version --}}
                    <a href="{{ $brochureUrl }}" target="_blank" rel="noopener" class="hashmb track-brochure-download"
                        data-brochure-id="{{ $brochureId }}" download>
                        <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex mt-3">
                            <div class="icon"><i class="fa fa-book-open"></i></div>
                            <div class="text">
                                <p>@lang('system.download')</p>
                                <h6>@lang('system.jiipe e-brochure')</h6>
                            </div>
                        </div>
                    </a>
                @else
                    {{-- Desktop Version --}}
                    <a href="{{ $brochureUrl }}" target="_blank" rel="noopener" class="hash track-brochure-download"
                        data-brochure-id="{{ $brochureId }}" download>
                        <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex mt-3">
                            <div class="icon"><i class="fa fa-book-open"></i></div>
                            <div class="text">
                                <p>@lang('system.download')</p>
                                <h6>@lang('system.jiipe e-brochure')</h6>
                            </div>
                        </div>
                    </a>
                @endif
            @else
                {{-- Fallback ke file static --}}
                <a href="{{ asset('asset/brochure/(Desktop Version) E-Brochure JIIPE-Ineractive.pdf') }}"
                    target="_blank" rel="noopener" class="hash track-brochure-download">
                    <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex mt-3">
                        <div class="icon"><i class="fa fa-book-open"></i></div>
                        <div class="text">
                            <p>@lang('system.download')</p>
                            <h6>@lang('system.jiipe e-brochure')</h6>
                        </div>
                    </div>
                </a>
            @endif
        </li>
        <li>
            <a href="#faq">
                <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex mt-3">
                    <div class="icon"><i class="fa fa-comment-alt"></i></div>
                    <div class="text">
                        <p>@lang('system.frequently')</p>
                        <h6>@lang('system.frequently asked questions')</h6>
                    </div>
                </div>
            </a>
        </li>
    </ul>
    <div class="clear"></div>
</div>
