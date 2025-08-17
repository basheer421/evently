<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Xevent;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // Start with all events
        $query = Xevent::with('category', 'organizer');

        // Search functionality
        if ($request->filled('query')) {
            $searchTerm = $request->get('query');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('location', 'like', "%{$searchTerm}%")
                    ->orWhereHas('organizer', function ($orgQuery) use ($searchTerm) {
                        $orgQuery->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // Category filter
        if ($request->filled('category') && $request->get('category') !== '') {
            $query->where('category_id', $request->get('category'));
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('start_time', '>=', $request->get('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('start_time', '<=', $request->get('date_to'));
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->get('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->get('max_price'));
        }

        // Sorting
        $sortBy = $request->get('sort', 'asc');
        if ($sortBy === 'desc') {
            $query->orderBy('start_time', 'desc');
        } else {
            $query->orderBy('start_time', 'asc');
        }

        $events = $query->paginate(12);

        // Check if this is an AJAX request (for auto-search)
        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.events-grid', compact('events'))->render()
            ]);
        }

        return view('pages.explore', compact('categories', 'events'));
    }
}
