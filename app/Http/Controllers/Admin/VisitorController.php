<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageVisit;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $query = PageVisit::query();

        if ($request->filled('date_from')) {
            $query->whereDate('visited_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('visited_at', '<=', $request->input('date_to'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%")
                  ->orWhere('referrer', 'like', "%{$search}%");
            });
        }

        $visitors = $query->latest('visited_at')->paginate(30)->withQueryString();

        $totalToday = PageVisit::whereDate('visited_at', today())->count();
        $uniqueToday = PageVisit::whereDate('visited_at', today())->distinct('ip_address')->count('ip_address');

        return view('admin.visitors.index', compact('visitors', 'totalToday', 'uniqueToday'));
    }
}
