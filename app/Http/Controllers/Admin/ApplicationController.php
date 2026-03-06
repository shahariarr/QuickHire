<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with('job')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('job', fn ($j) => $j->where('title', 'like', "%{$search}%"));
            });
        }

        $applications = $query->paginate(20);

        return Inertia::render('Admin/Applications/Index', [
            'applications' => $applications,
            'filters'      => $request->only(['search']),
        ]);
    }

    public function show(int $id)
    {
        $application = Application::with('job')->findOrFail($id);

        return Inertia::render('Admin/Applications/Show', compact('application'));
    }
}
