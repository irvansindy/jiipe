{{-- ⚡ REUSABLE COMPONENT: Navigation Box --}}
<div class="navigasi-box navigasi-box-shadow navigasi-box-border-bottom" style="width:100%;">
    <ul>
        <li class="hover">
            <a href="#contact">
                <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                    <div class="icon"><i class="fa fa-calendar-alt"></i></div>
                    <div class="text">
                        <p>@lang('system.quick appointment')</p>
                        <h6 class="title">@lang('system.proposal request')</h6>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="#videotour">
                <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                    <div class="icon"><i class="fa fa-map-marked-alt"></i></div>
                    <div class="text">
                        <p>@lang('system.watch')</p>
                        <h6 class="title">@lang('system.video tour')</h6>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ asset('asset/brochure/323829b435(Comp) eBrochure - JIIPE Brochure English.pdf') }}"
               target="_blank"
               rel="noopener">
                <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                    <div class="icon"><i class="fa fa-book-open"></i></div>
                    <div class="text">
                        <p>@lang('system.download')</p>
                        <h6>@lang('system.jiipe e-brochure')</h6>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="#faq">
                <div class="navigasi-body animate-icon d-lg-flex d-sm-inline-flex">
                    <div class="icon"><i class="fa fa-comment-alt"></i></div>
                    <div class="text">
                        <p>@lang('system.frequently')</p>
                        <h6>@lang('system.ask questions')</h6>
                    </div>
                </div>
            </a>
        </li>
    </ul>
    <div class="clear"></div>
</div>