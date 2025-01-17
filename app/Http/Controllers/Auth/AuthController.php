<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        return view('auth.login');
    }
    public function login_submit(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:rfc,dns|unique:users|max:255',
            'password' => 'required|min:8',
        ]);

        $this->ensureIsNotRateLimited($request);

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($this->throttleKey($request));
            $request->session()->regenerate();
            return redirect()->back();

        }

        if (Auth::guard('admin')->attempt($credentials)) {
            RateLimiter::clear($this->throttleKey($request));
            $request->session()->regenerate();
            // $this->otpLoginMail($request, env('OTP_MAIL'), "admin");
            return redirect()->back();
        }

        RateLimiter::hit($this->throttleKey($request));
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function ensureIsNotRateLimited(Request $request)
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }


    public function throttleKey(Request $request)
    {
        return str::lower($request->input('email')) . '|' . $request->ip();
    }
}
