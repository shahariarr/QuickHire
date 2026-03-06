<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
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

        $jobs = $query->paginate(15);

        return Inertia::render('Admin/Jobs/Index', [
            'jobs'    => $jobs,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Jobs/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'type'        => 'nullable|string|max:50',
            'description' => 'required|string|min:20',
        ]);

        Job::create($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job posted successfully.');
    }

    public function edit(int $id)
    {
        $job = Job::findOrFail($id);

        return Inertia::render('Admin/Jobs/Edit', compact('job'));
    }

    public function update(Request $request, int $id)
    {
        $job = Job::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'type'        => 'nullable|string|max:50',
            'description' => 'required|string|min:20',
        ]);

        $job->update($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    public function destroy(int $id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job deleted.');
    }
}
