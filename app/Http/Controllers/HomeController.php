<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.home', [
            'title' => 'Home',
            'user' => Auth::user()
        ]);
    }
}
