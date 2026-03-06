<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the jobs.
     * GET /api/jobs
     * Supports search and filtering by category and location
     */
    public function index(Request $request)
    {
        $query = Job::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $jobs = $query->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $jobs,
        ], 200);
    }

    /**
     * Store a newly created job.
     * POST /api/jobs
     */
    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Job created successfully',
            'data' => $job,
        ], 201);
    }

    /**
     * Display the specified job.
     * GET /api/jobs/{id}
     */
    public function show($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $job,
        ], 200);
    }

    /**
     * Remove the specified job.
     * DELETE /api/jobs/{id}
     */
    public function destroy($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found',
            ], 404);
        }

        $job->delete();

        return response()->json([
            'success' => true,
            'message' => 'Job deleted successfully',
        ], 200);
    }
}
