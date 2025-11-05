<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show the login form for regular users.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            // Redirect admin users to admin dashboard
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            // Redirect regular users to home or user dashboard
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Handle a login request for regular users.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if (!$user->isActive()) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been deactivated.'])->withInput();
            }

            $request->session()->regenerate();

            // Redirect admin users to admin dashboard
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back!');
            }

            // Redirect regular users to home page
            return redirect()->intended(route('home'))->with('success', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput();
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        $isAdmin = Auth::check() && Auth::user()->isAdmin();
        
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($isAdmin) {
            return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
        }

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
