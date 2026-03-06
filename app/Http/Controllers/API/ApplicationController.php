<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;

class ApplicationController extends Controller
{
    /**
     * Store a newly created application.
     * POST /api/applications
     */
    public function store(StoreApplicationRequest $request)
    {
        $application = Application::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully',
            'data' => $application,
        ], 201);
    }
}
