@extends('layouts.auth.app', ['title' => 'Jiipe Admin - Login', 'classLogin' => 'loginpage'])

@section('content')
    <!-- loginpanel -->
    <div class="outer-login">
        <div class="in">
            <div class="loginpanelinner">
                <div class="logo">
                    <img src="{{ asset('asset/images/logo/JIIPE_SEZ_Logo.png') }}" alt="Cms Markdesign"
                        class="img-responsive" />
                </div>

                {{-- Form Login --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mylogin mb-3">
                        <input type="text" name="email" id="email" placeholder="Enter email"
                            value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" />

                        @error('email')
                            <small class="text-danger">{{ __($message) }}</small>
                        @enderror
                    </div>

                    <div class="mylogin">
                        <input type="password" name="password" id="password" placeholder="Enter password"
                            class="form-control @error('password') is-invalid @enderror" />

                        @error('password')
                            <small class="text-danger">{{ __($message) }}</small>
                        @enderror
                    </div>
                    {{-- reCAPTCHA --}}
                    <div class="mylogin recaptcha-wrapper">
                        {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                        <br />
                    </div>
                    @error('g-recaptcha-response')
                        <small class="text-danger mb-1">{{ __($message) }}</small>
                    @enderror

                    <div class="mylogin">
                        <button type="submit">Sign In</button>
                    </div>

                    <div class="mylogin mesign">
                        <label>
                            <input type="checkbox" class="remember" name="remember" value="1"
                                {{ old('remember') ? 'checked' : '' }} /> Keep me sign in
                        </label>
                    </div>
                </form>

                {{-- Alert error global (misalnya credential salah) --}}
                @if ($errors->has('email') || $errors->has('username'))
                    <div class="text-danger mt-2">
                        {{ __($errors->first('email') ?: 'Invalid credentials, please try again.') }}
                    </div>
                @endif
            </div><!--loginpanelinner-->
        </div>
    </div><!--loginpanel-->

    <style type="text/css">
        html,
        body,
        .container {
            height: 100%;
        }

        .outer-login {
            display: table;
            width: 100%;
            height: 95%;
        }

        .outer-login .in {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }

        .mylogin input {
            border: 0;
            padding: 10px;
            background: #fff;
            height: 45px;
        }

        .mylogin button {
            display: block;
            border: 1px solid #ef1313;
            padding: 10px;
            background: #d10808;
            width: 100%;
            color: #fff;
            text-transform: uppercase;
            font-family: 'LatoBold', 'Helvetica Neue', Helvetica, sans-serif;
            font-weight: normal;
            font-size: 13px;
        }

        .mylogin.mesign {
            text-align: left;
        }

        .mylogin label {
            display: inline-block;
            margin-top: 10px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 11px;
            vertical-align: middle;
        }

        .mylogin label input {
            width: auto;
            margin: -3px 5px 0 0;
            vertical-align: middle;
        }

        .mylogin .remember {
            padding: 0;
            background: none;
        }

        .loginpanelinner {
            position: relative;
            top: inherit;
            left: inherit;
            width: 270px;
            margin: 0 auto;
        }

        #pushstat {
            display: none;
        }

        .loginpanelinner .logo {
            width: auto;
            background-color: transparent;
            padding: 0.8em 1.5em;
            margin-bottom: 1em;
        }

        .loginpanelinner .logo>img {
            max-width: 230px;
            display: block;
            margin: 0 auto;
        }

        body.loginpage {
            background: #000;
        }

        .recaptcha-wrapper {
            display: flex;
            justify-content: center;
        }

        .recaptcha-wrapper .g-recaptcha {
            transform: scale(0.85);
            /* atur sesuai kebutuhan */
            transform-origin: center;
        }
    </style>
@endsection
@push('js')
    {!! NoCaptcha::renderJs() !!}
@endpush
