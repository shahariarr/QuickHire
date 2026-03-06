<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $latestJobs = Job::withCount('applications')
            ->latest()
            ->take(6)
            ->get();

        $totalJobs         = Job::count();
        $totalApplications = \App\Models\Application::count();

        return Inertia::render('Welcome', compact('latestJobs', 'totalJobs', 'totalApplications'));
    }
}
