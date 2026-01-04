<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>{{ $title ?? config('app.name') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- [Google Font] Family -->
    <!-- Preconnect ke Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Load Public Sans + Roboto + Montserrat -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <!-- Preload Font Awesome (penting!) -->
    <link rel="preload" href="{{ asset('asset/fonts/fontawesome/webfonts/fa-solid-900.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('asset/fonts/fontawesome/webfonts/fa-brands-400.woff2') }}" as="font" type="font/woff2" crossorigin>

    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style-preset.css') }}">
    @stack('css')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @include('layouts.admin.partials.sidebar_mantis')
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    @include('layouts.admin.partials.header_mantis')
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    @yield('content')
    <!-- [ Main Content ] end -->

    <!-- [ Footer ] end -->
    @include('layouts.admin.partials.footer_mantis')

    <!-- Floating Language Button -->
    <div class="floating-language">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle rounded-full shadow-lg px-4 py-3" type="button"
                id="languageMenu" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-language"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="languageMenu">
                @foreach (Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item"
                            href="{{ Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Tambahkan CSS -->
    <style>
        .floating-language {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
        }

        .modal-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            display: none;
        }

        .modal-loader .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #ddd;
            border-top-color: #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="modal-loader" id="modalLoader">
        <div class="spinner"></div>
    </div>


    <!-- [ Footer ] end -->
    <!-- [Page Specific JS] start -->
    <script src="{{ asset('dist/assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/dashboard-default.js') }}"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="{{ asset('dist/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/feather.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        layout_change('light');
        change_box_container('false');
        layout_rtl_change('false');
        preset_change("preset-1");
        font_change("Public-Sans");

        /**
         * ajaxRequest
         *  - Bisa GET/POST/PUT/PATCH/DELETE
         *  - Bisa pakai formSelector ATAU data object manual
         *  - Sudah include loader + error Laravel
         *
         * @param {object} opts
         *   formSelector : string | null -> contoh '#myForm', null jika kirim data manual
         *   url          : string        -> endpoint Laravel
         *   method       : string        -> GET | POST | PUT | PATCH | DELETE
         *   data         : object        -> data manual jika tanpa formSelector
         *   onSuccess    : function      -> callback sukses
         *   onError      : function      -> callback error
         */
        function ajaxRequest(opts = {}) {
            const {
                formSelector = null,
                    url = '',
                    method = 'GET',
                    data = {},
                    onSuccess = null,
                    onError = null
            } = opts;

            if (!url) {
                console.error('ajaxRequest error: url wajib diisi.');
                return;
            }

            let ajaxType = method.toUpperCase();
            let ajaxData;
            let process = true;
            let content = 'application/x-www-form-urlencoded; charset=UTF-8';
            let $allButtons;

            // Jika ada formSelector → gunakan FormData
            if (formSelector) {
                const $form = $(formSelector);
                const formEl = $form[0];
                ajaxData = new FormData(formEl);

                if (!['POST', 'GET'].includes(ajaxType)) {
                    // Laravel method spoofing
                    ajaxData.append('_method', ajaxType);
                    ajaxType = 'POST';
                }

                process = false;
                content = false;
                $allButtons = $form.find('button, input[type=button], input[type=submit]');
            } else {
                // Tidak ada formSelector → data manual
                ajaxData = data;
            }

            $.ajax({
                url: url,
                type: ajaxType,
                data: ajaxData,
                processData: process,
                contentType: content,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    showLoader();
                    if ($allButtons) {
                        $allButtons.prop('disabled', true);
                        $('.text-danger').text('');
                    }
                },
                success: function(res) {
                    if (typeof onSuccess === 'function') onSuccess(res);
                },
                error: function(xhr) {
                    // validasi Laravel (jika pakai form)
                    if ($allButtons && xhr.responseText) {
                        try {
                            const response_error = JSON.parse(xhr.responseText);
                            $('.text-danger').text('');
                            if (response_error.meta?.message?.errors) {
                                $.each(response_error.meta.message.errors, function(i, value) {
                                    $('#message_' + i.replace(/\./g, '_')).text(value);
                                });
                            }
                        } catch (e) {
                            console.error('Parse error response:', e);
                        }
                    }
                    if (typeof onError === 'function') onError(xhr);
                },
                complete: function() {
                    hideLoader();
                    if ($allButtons) $allButtons.prop('disabled', false);
                }
            });
        }
    </script>
    {{-- Global Tracking Script - TAMBAHKAN INI --}}
    <script src="{{ asset('asset/js/global-tracking.js') }}"></script>
    @stack('js')
</body>
<!-- [Body] end -->

</html>
