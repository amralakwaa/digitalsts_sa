<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => app()->getLocale() === 'ar'
                    ? "عدد محاولات الدخول تجاوز الحد المسموح، يرجى الانتظار {$seconds} ثانية."
                    : "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Requirement 1: تجديد معرّف الجلسة بعد تسجيل الدخول
            $request->session()->regenerate();
            RateLimiter::clear($throttleKey);

            if (!Auth::user()->isAdmin()) {
                // Not an admin: log out immediately, invalidate session, and regenerate token
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => app()->getLocale() === 'ar'
                        ? 'هذا الحساب لا يملك صلاحيات وصول إدارية.'
                        : 'This account does not have administrative privileges.',
                ]);
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        RateLimiter::hit($throttleKey);

        return back()->withErrors([
            'email' => __('messages.invalid_credentials'),
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Requirement 2: إبطال الجلسة عند تسجيل الخروج
        $request->session()->invalidate();
        // Requirement 3: تجديد رمز CSRF وفق آليات Laravel
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
