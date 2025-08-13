<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use Exception;
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
        return redirect()->route('login');
    }

    public function resetPassword(): View
    {
        return view('pages.reset-password', ['title' => 'Reset Password']);
    }

    public function googleRedirect(Request $request): RedirectResponse
    {
        session(['role' => $request->input('role', 'user')]);
        $role = session('role', 'user');
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $role = session('role', 'user');
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                ]);
            } else {
                $user = User::create([
                    'email' => $googleUser->getEmail(),
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'password' => Hash::make(uniqid()),
                    'role' => $role,
                ]);
            }

            Auth::login($user);
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('login')
                ->withErrors(['google' => 'Google authentication failed. Please try again.']);
        }
    }
}
