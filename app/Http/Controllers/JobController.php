<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::withCount('applications')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $jobs = $query->paginate(12);

        return Inertia::render('Jobs/Index', [
            'jobs'    => $jobs,
            'filters' => $request->only(['search', 'location', 'category', 'type']),
        ]);
    }

    public function show(int $id)
    {
        $job = Job::withCount('applications')->findOrFail($id);

        $relatedJobs = Job::where('category', $job->category)
            ->where('id', '!=', $job->id)
            ->latest()
            ->take(4)
            ->get();

        return Inertia::render('Jobs/Show', compact('job', 'relatedJobs'));
    }

    public function apply(int $id)
    {
        $job = Job::findOrFail($id);

        return Inertia::render('Jobs/Apply', compact('job'));
    }

    public function storeApplication(Request $request, int $id)
    {
        $job = Job::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'resume_link' => 'required|url|max:500',
            'cover_note'  => 'required|string|min:20|max:5000',
        ]);

        Application::create([
            'job_id'      => $job->id,
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'resume_link' => $validated['resume_link'],
            'cover_note'  => $validated['cover_note'],
        ]);

        return redirect()->route('jobs.show', $job->id)
            ->with('success', 'Your application was submitted successfully!');
    }
}
