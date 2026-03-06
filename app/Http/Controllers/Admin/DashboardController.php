<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJobs         = Job::count();
        $totalApplications = Application::count();
        $jobsThisMonth     = Job::whereMonth('created_at', Carbon::now()->month)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->count();
        $appsThisMonth     = Application::whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->count();

        $recentJobs         = Job::latest()->take(5)->get();
        $recentApplications = Application::with('job')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalJobs', 'totalApplications', 'jobsThisMonth', 'appsThisMonth',
            'recentJobs', 'recentApplications'
        ));
    }
}
