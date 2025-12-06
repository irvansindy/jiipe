<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Responses\LoginResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Custom login view
         */
        Fortify::loginView(fn () => view('layouts.auth.login'));

        /**
         * Custom authentication (email + password)
         */
        Fortify::authenticateUsing(function (Request $request) {
            // validate input first
            Validator::make($request->all(), [
                'email'    => 'required|email',
                'password' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ], [
                'email.required'=> 'User tidak ditemukan',
                'email.email'=> 'Format email tidak valid',
                'password.required'=> 'Password tidak boleh kosong',
                'g-recaptcha-response.required' => 'Please complete the CAPTCHA to proceed.',
                'g-recaptcha-response.captcha' => 'CAPTCHA verification failed. Please try again.',
            ])->validate();

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                // Manually login user so we can respect the "remember" checkbox
                // Auth::login will persist the session and (if true) create a long-lived cookie
                Auth::login($user, $request->boolean('remember'));

                return $user;
            }

            return null; // authentication failed
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
