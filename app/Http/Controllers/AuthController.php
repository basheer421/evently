<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('pages.login', ['title' => 'Login']);
    }

    public function register() {
        return view('pages.register', ['title' => 'Register']);
    }

    public function logout() {
        // Logic for logging out the user
        return redirect()->route('login');
    }

    public function resetPassword() {
        return view('pages.reset-password', ['title' => 'Reset Password']);
    }
}
