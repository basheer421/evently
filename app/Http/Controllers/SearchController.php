<?php

namespace App\Http\Controllers;

use App\Models\XEvent;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('pages.search');
    }

    // Not done
    public static function search(Request $request)
    {
        $request->validate([
            'category' => 'nullable|exists:categories,id',
            'date_range' => 'nullable|string',
            'sort_by' => 'nullable|string|in:start_time,end_time,title',
        ]);
        $category = $request->input('category');
        $date_range = explode(' - ', $request->input('date_range') ? $request->input('date_range') : '');
        $start_date = null;
        $end_date = null;
        if (count($date_range) === 2) {
            $start_date = $date_range[0];
            $end_date = $date_range[1];
        }
        // $price_range = null;
        $sort_by = $request->input('sort_by', 'start_time');

        $events = XEvent::query()
            ->when($category, fn($query) => $query->where('category_id', $category))
            ->when($start_date && $end_date, fn($query) => $query->whereBetween('start_time', [$start_date, $end_date]))
            ->orderBy($sort_by)
            ->paginate(10);

        return view('pages.search', [
            'title' => 'Search Results',
            'user' => $request->user(),
            'events' => $events,
        ]);
    }
}
