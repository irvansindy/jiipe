{{-- filepath: resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('asset/backend/css/style.default.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('asset/backend/css/styles.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('asset/backend/css/responsive-tables.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/backend/css/style.default.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/creative/creative.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}

    <title>{{ $title ?? config('app.name') }}</title>

    <script type="text/javascript" src="{{ asset('asset/backend/js/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/jquery-migrate-1.1.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/jquery-ui-1.10.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/modernizr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/jquery.uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/responsive-tables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/jquery.slimscroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/backend/js/my.js') }}"></script>
    <meta name="robots" content="noindex, nofollow">
    @stack('head')
</head>

<body>
    <div id="mainwrapper" class="mainwrapper">
        <!-- // start header -->
        <div class="header">
            @include('layouts.admin.partials.header')
        </div>
        <!-- // end header -->

        <div class="leftpanel">
            @include('layouts.admin.partials.sidebar_menu')
        </div><!-- leftpanel -->

        <div class="rightpanel">
            @yield('content')
        </div><!--rightpanel-->
    </div>


    <style type="text/css">
        .header .logo {
            padding-top: 15px;
        }

        .header .logo a {
            display: block;
            max-width: 230px;
            padding: 2.2em 1em;
            background-color: transparent;
        }

        .header .logo a img {
            max-width: 100%;
        }
    </style>
    @stack('scripts')
</body>

</html>
