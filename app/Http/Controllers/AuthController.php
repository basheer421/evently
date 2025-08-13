<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('pages.login', ['title' => 'Login']);
    }

    public function register(): View
    {
        return view('pages.register', ['title' => 'Register']);
    }

    public function loginPost(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials, $request->filled('remember'));
        return back()->withErrors([
            'email' => 'Your email or password is incorrect.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function registerPost(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin,organizer',
        ]);

        $user = User::create([
            'name' => $request->email, // email for now
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function resetPassword(): View
    {
        return view('pages.reset-password', ['title' => 'Reset Password']);
    }

    public function googleRedirect(Request $request): RedirectResponse
    {
        session(['role' => $request->input('role', 'user')]);
        $role = session('role', 'user');
        dd($role);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        $role = session('role', 'user');
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name' => $googleUser->getName(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'password' => Hash::make(uniqid()),
                'role' => $role,
            ]
        );
        Auth::login($user);
        return redirect()->route('home');
    }
}
