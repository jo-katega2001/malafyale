<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\PageVisit;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLeads = Lead::count();
        $newLeads = Lead::where('status', 'new')->count();
        $contactedLeads = Lead::where('status', 'contacted')->count();
        $convertedLeads = Lead::where('status', 'converted')->count();
        $leadsToday = Lead::whereDate('created_at', today())->count();
        $leadsThisWeek = Lead::where('created_at', '>=', now()->startOfWeek())->count();

        $totalVisits = PageVisit::count();
        $visitsToday = PageVisit::whereDate('visited_at', today())->count();
        $uniqueVisitors = PageVisit::distinct('ip_address')->count('ip_address');
        $uniqueToday = PageVisit::whereDate('visited_at', today())->distinct('ip_address')->count('ip_address');

        $recentLeads = Lead::latest()->take(10)->get();
        $recentVisitors = PageVisit::latest('visited_at')->take(10)->get();

        return view('admin.dashboard', compact(
            'totalLeads', 'newLeads', 'contactedLeads', 'convertedLeads',
            'leadsToday', 'leadsThisWeek',
            'totalVisits', 'visitsToday', 'uniqueVisitors', 'uniqueToday',
            'recentLeads', 'recentVisitors'
        ));
    }
}
