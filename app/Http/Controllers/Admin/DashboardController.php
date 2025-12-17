<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display dashboard with statistics
     */
    public function index()
    {
        $stats = $this->dashboardService->getDashboardStats();

        return view('layouts.admin.dashboard.index', compact('stats'));
    }

    /**
     * Get visitor chart data (AJAX)
     */
    public function getVisitorChartData(Request $request)
    {
        $period = $request->get('period', 'week'); // week or month

        if ($period === 'month') {
            $data = $this->dashboardService->getMonthlyVisitors();
        } else {
            $data = $this->dashboardService->getWeeklyVisitors();
        }

        return response()->json($data);
    }

    /**
     * Clear dashboard cache (admin only)
     */
    public function clearCache()
    {
        $this->dashboardService->clearCache();

        return back()->with('success', 'Dashboard cache cleared successfully!');
    }
}
