<section class="industri-jiipe-sec-1">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}"
                    alt="{{ __('JIIPE Industrial Estate Gresik') }}"
                    class="img img-fluid">
                <p class="info">{{ __('SEZ') }}</p>

                <div class="side">
                    <div class="leftsn_menu">
                        {{-- Desktop Navigation --}}
                        <ul id="lists_leftmenuKawasan" class="list-unstyled d-none d-sm-block">
                            @foreach ($data['sezPages'] as $index => $sezPage)
                                <li class="tab-link {{ $index === 0 ? 'active' : '' }}"
                                    data-tab="tab-{{ $index }}"
                                    data-title="{{ $sezPage['title'] }}"
                                    data-thumbnail="{{ asset('storage/zone/'. ($sezPage['thumbnail'] ?? 'asset/images/default-cover.jpg')) }}">
                                    <a href="javascript:void(0)">
                                        {{ $sezPage['menu_title'] ?? $sezPage['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Mobile Select Dropdown --}}
                        <select id="mobile-tab-select" class="form-control d-block d-sm-none">
                            @foreach ($data['sezPages'] as $index => $sezPage)
                                <option value="tab-{{ $index }}"
                                        data-title="{{ $sezPage['title'] }}"
                                        data-thumbnail="{{ asset('storage/zone/'. ($sezPage['thumbnail'] ?? 'asset/images/default-cover.jpg')) }}"
                                        {{ $index === 0 ? 'selected' : '' }}>
                                    {{ $sezPage['menu_title'] ?? $sezPage['title'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-45">
                {{-- Tab Contents --}}
                @foreach ($data['sezPages'] as $index => $sezPage)
                    <div id="tab-{{ $index }}" class="tab-content-item {{ $index === 0 ? 'active' : '' }}">
                        @if (!empty($sezPage['subtitle']))
                            <div class="title">
                                <p>{{ $sezPage['subtitle'] }}</p>
                            </div>
                        @endif

                        <div class="content">
                            @if ($index === 0)
                                {{-- Default/First Content (PP 71/2021) --}}
                                <p>
                                    <img src="{{ asset('storage/zone/pp_71_1.jpg') }}" class="img img-fluid">
                                </p>
                                <p>(As per PP No.71 / 2021)</p>
                                <p>
                                    JAKARTA, 2 Juli 2021 - Java Integrated Industrial &amp; Ports Estate, or JIIPE, was founded
                                    by PT AKR Corporindo Tbk through its subsidiary PT Usaha Era Pratama Nusantara (AKR) and PT
                                    Pelindo Ill through its subsidiary PT Berlian Jasa Terminal Indonesia in order to accelerate
                                    job creation and economic development in Indonesia, particularly East Java. JIIPE has been
                                    officially designated as Gresik Special Economic Zone (SEZ) through the Government
                                    Regulation (PP) of the Republic of Indonesia.
                                </p>
                                <p>
                                    JIIPE's designation as a Gresik SEZ makes it one of the most competitive and alluring
                                    industrial estates for both domestic and foreign industry participants. Gresik SEZ (JIIPE)
                                    is a national strategic project that is prepared to accept investors from Industry 4.0.
                                    Gresik SEZ offers superior connectivity via multimodal transportation, direct connections to
                                    deep seaport, comprehensive utility facilities, one-stop licensing services, centralized
                                    AMDAL administration at the area manager's office, and expedited construction permits via
                                    the KLIK facility.
                                </p>
                                <p>
                                    With the administrator office in Gresik SEZ, the synergy of licensing services and
                                    interconnection between agencies will be very simple and quick, ensuring ease of doing
                                    business and the existence of government facilities and incentives for investors, including
                                    tax and fiscal incentives as stipulated in the Regulation of the Minister of Finance of the
                                    Republic of Indonesia.
                                </p>
                                <p>
                                    The combination of JIIPE facilities, strategic location, and SEZ status will promote
                                    economic growth via export-oriented foreign direct investment activities and import
                                    substitution.
                                </p>
                                <p>
                                    Bambang Soetiono, President Director of PT Berkah Kawasan Manyar Sejahtera as the manager of
                                    JIIPE Special Economic Zone (SEZ) Gresik, expressed his gratitude to the Government of the
                                    Republic of Indonesia, East Java Province, and Gresik Regency for their support in
                                    establishing JIIPE as Gresik SEZ.
                                </p>
                                <p>
                                    <img src="{{ asset('storage/zone/pp_71_2.jpg') }}" class="img img-fluid">
                                </p>
                                <p>
                                    Bambang Soetiono stated in his statement, "With the establishment of JIIPE as KEK Gresik, we
                                    are certain to be more competitive in facilitating industries that will invest in East Java,
                                    thereby contributing to the Indonesian state by accelerating economic recovery and
                                    employment creation. For Gresik SEZ (JIIPE) to become one of the most attractive investment
                                    destinations for domestic and international investors, we are committed to developing
                                    various innovations and collaborating with the government to provide a variety of business
                                    facilities, reduce logistics costs, and develop high-value integrated areas for industry
                                    players. KEK Gresik (JIIPE) contributes to the development of industrial estate 4.0 by
                                    providing utilities such as electricity facilities, clean water and waste management, gas
                                    supply, telecommunications networks, and multimodal transportation.
                                </p>
                                <p>
                                    Industry 4.0 places an emphasis on the integration of information technology and industry.
                                    JIIPE is a significant investment destination in East Java and provides solutions for
                                    enhancing Indonesia's industrial competitiveness. A 2,167-hectare environmentally favourable
                                    industrial area is organized by industry type.
                                </p>
                                <p>
                                    Currently, Gresik SEZ (JIIPE) has fifteen tenants from diverse industries. Cluster
                                    development in Gresik SEZ is:
                                </p>
                                <ul>
                                    <li>1. Metal Industry Concentration</li>
                                    <li>2. Cluster of Electronic Industry</li>
                                    <li>3. Chemical Industry Concentration</li>
                                    <li>4. Energy Industry Concentration</li>
                                    <li>5. Industry Cluster for Support and Logistics</li>
                                </ul>
                                <p>
                                    Approximately 400 ha of the 2,167 ha of Gresik SEZ (JIIPE) is a deep seaport strategically
                                    located in the Madura Strait and part of the Surabaya West Water Current (APBS). With a
                                    total ultimate pier length of 6,500 meters and a water depth of -16 meters LWS, KEK Gresik
                                    Port (JIIPE) can accommodate vessels of up to 100,000 deadweight tons.
                                </p>
                                <p>
                                    This port has been operational since 2015; at present, JIIPE Port has served up to 2 million
                                    tons of cargo, and after the jetty extension in June 2021, it is expected to be able to
                                    manage up to 6 million tons of cargo.
                                </p>
                                <p>
                                    JIIPE is designed as a green project with comprehensive utility facilities and negligible
                                    runoff. This facility is also a source of recurring revenue for JIIPE, as it meets the
                                    industry's requirements for production efficiency. The strategic location of JIIPE, which is
                                    connected to the sea route, Tol Krian Legundi Sunder Manyar Road, and the Railway,
                                    facilitates the export and import of goods in East Java.
                                </p>
                                <hr>
                                <p>
                                    <img src="{{ asset('storage/zone/pp_71_3.jpg') }}" class="img img-fluid">
                                </p>
                            @else
                                {{-- Dynamic content from database for other tabs --}}
                                {!! $sezPage['description'] !!}

                                @if (!empty($sezPage['thumbnail']))
                                    <div class="mt-4">
                                        <img src="{{ asset('storage/' . $sezPage['thumbnail']) }}"
                                            class="img img-fluid"
                                            alt="{{ $sezPage['title'] }}">
                                    </div>
                                @endif
                            @endif
                        </div>

                        @if (!empty($sezPage['note']))
                            <div class="note mt-4 p-3 bg-light">
                                {!! $sezPage['note'] !!}
                            </div>
                        @endif
                    </div>
                @endforeach

                <hr class="artikel-brosur">
            </div>
        </div>
    </div>
</section>

@push('js')
    <script>
        $(document).ready(function() {
            // Add img-fluid class to all images in content
            $('.content img').addClass('img img-fluid');

            // Function to update breadcrumb and cover image
            function updatePageElements(title, thumbnailUrl) {
                // Update breadcrumb with fade effect
                $('#dynamic-breadcrumb').fadeOut(200, function() {
                    $(this).text(title).fadeIn(200);
                });

                // Update cover image with transition
                var $coverImage = $('#dynamic-cover-image');
                $coverImage.addClass('fade-out');

                setTimeout(function() {
                    $coverImage.attr('src', thumbnailUrl);
                    $coverImage.attr('alt', title);
                    $coverImage.removeClass('fade-out');
                }, 300);
            }

            // Desktop Tab Navigation
            $('.tab-link').on('click', function(e) {
                e.preventDefault();

                var targetTab = $(this).data('tab');
                var title = $(this).data('title');
                var thumbnail = $(this).data('thumbnail');

                // Remove active class from all tabs and contents
                $('.tab-link').removeClass('active');
                $('.tab-content-item').removeClass('active');

                // Add active class to clicked tab and corresponding content
                $(this).addClass('active');
                $('#' + targetTab).addClass('active');

                // Update mobile select to match
                $('#mobile-tab-select').val(targetTab);

                // Update breadcrumb and cover image
                updatePageElements(title, thumbnail);

                // Smooth scroll to top of content
                $('html, body').animate({
                    scrollTop: $('.col-md-45').offset().top - 100
                }, 300);
            });

            // Mobile Select Navigation
            $('#mobile-tab-select').on('change', function() {
                var targetTab = $(this).val();
                var selectedOption = $(this).find('option:selected');
                var title = selectedOption.data('title');
                var thumbnail = selectedOption.data('thumbnail');

                // Remove active class from all contents
                $('.tab-content-item').removeClass('active');

                // Add active class to selected content
                $('#' + targetTab).addClass('active');

                // Update breadcrumb and cover image
                updatePageElements(title, thumbnail);

                // Smooth scroll to top of content
                $('html, body').animate({
                    scrollTop: $('.col-md-45').offset().top - 100
                }, 300);
            });
        });
    </script>
@endpush

@push('css')
    <style>
        /* Content Spacing */
        section.industri-jiipe-sec-1 .prelative.container .row .content p {
            margin-bottom: 1.35rem;
        }

        section.industri-jiipe-sec-1 .prelative.container .row .content ul {
            padding-left: 20px;
        }

        section.industri-jiipe-sec-1 .prelative.container .row .content ul li {
            margin-bottom: 0.5rem;
        }

        /* Tab Navigation Styles */
        .tab-link {
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }

        .tab-link a {
            display: block;
            padding: 12px 15px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            border-radius: 4px;
        }

        .tab-link:hover a {
            background-color: #f5f5f5;
            padding-left: 20px;
        }

        .tab-link.active a {
            color: #d32f2f;
            font-weight: bold;
            border-left: 4px solid #d32f2f;
            background-color: #fff;
        }

        /* Tab Content Styles */
        .tab-content-item {
            display: none;
            animation: fadeIn 0.4s ease-in;
        }

        .tab-content-item.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Select Styles */
        #mobile-tab-select {
            margin-bottom: 20px;
            padding: 12px;
            font-size: 14px;
            border: 2px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            width: 100%;
        }

        #mobile-tab-select:focus {
            outline: none;
            border-color: #d32f2f;
            box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25);
        }

        /* Title Styles */
        .tab-content-item .title p {
            font-size: 24px;
            font-weight: bold;
            color: #d32f2f;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #d32f2f;
        }

        /* Note Box Styles */
        .note {
            background-color: #f8f9fa !important;
            border-left: 4px solid #d32f2f;
            border-radius: 4px;
        }

        /* Breadcrumb transition */
        #dynamic-breadcrumb {
            transition: opacity 0.2s ease-in-out;
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .tab-link a {
                padding: 10px 12px;
                font-size: 14px;
            }

            .tab-content-item .title p {
                font-size: 20px;
            }
        }
    </style>
@endpush