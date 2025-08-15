<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Xevent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $events = Xevent::where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->paginate(10);
        $categories = Category::paginate(10);
        return view('pages.home', [
            'title' => 'Home',
            'user' => $request->user(),
            'events' => $events,
            'categories' => $categories,
        ]);
    }
}
