@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Overview of your QuickHire platform')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    @foreach([
        ['label' => 'Total Jobs',         'value' => $totalJobs,         'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'text-brand bg-brand-light'],
        ['label' => 'Total Applications', 'value' => $totalApplications, 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',     'color' => 'text-green-600 bg-green-50'],
        ['label' => 'Jobs This Month',    'value' => $jobsThisMonth,     'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',                                              'color' => 'text-purple-600 bg-purple-50'],
        ['label' => 'Apps This Month',    'value' => $appsThisMonth,     'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',                                                                                                          'color' => 'text-orange-600 bg-orange-50'],
    ] as $card)
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 {{ $card['color'] }} rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $card['value'] }}</p>
            <p class="text-sm text-gray-500 mt-0.5">{{ $card['label'] }}</p>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Recent Jobs --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Recent Jobs</h2>
            <a href="{{ route('admin.jobs.index') }}" class="text-xs text-brand font-medium hover:underline">View all</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentJobs as $job)
                <div class="flex items-center justify-between px-5 py-3.5">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 bg-brand-light rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="text-brand text-xs font-bold">{{ strtoupper(substr($job->company, 0, 2)) }}</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $job->title }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $job->company }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0 ml-3">
                        <span class="text-xs text-gray-400">{{ $job->created_at->diffForHumans() }}</span>
                        <a href="{{ route('admin.jobs.edit', $job->id) }}"
                           class="text-xs text-brand hover:underline">Edit</a>
                    </div>
                </div>
            @empty
                <p class="px-5 py-6 text-sm text-gray-400 text-center">No jobs yet. <a href="{{ route('admin.jobs.create') }}" class="text-brand font-medium hover:underline">Post one.</a></p>
            @endforelse
        </div>
    </div>

    {{-- Recent Applications --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Recent Applications</h2>
            <a href="{{ route('admin.applications.index') }}" class="text-xs text-brand font-medium hover:underline">View all</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentApplications as $app)
                <div class="flex items-center justify-between px-5 py-3.5">
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $app->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $app->job->title ?? '—' }}</p>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0 ml-3">
                        <span class="text-xs text-gray-400">{{ $app->created_at->diffForHumans() }}</span>
                        <a href="{{ route('admin.applications.show', $app->id) }}"
                           class="text-xs text-brand hover:underline">View</a>
                    </div>
                </div>
            @empty
                <p class="px-5 py-6 text-sm text-gray-400 text-center">No applications yet.</p>
            @endforelse
        </div>
    </div>

</div>

{{-- Quick Action --}}
<div class="mt-6 flex justify-end">
    <a href="{{ route('admin.jobs.create') }}"
       class="inline-flex items-center gap-2 bg-brand text-white font-semibold px-6 py-3 rounded-xl hover:bg-brand-dark transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Post New Job
    </a>
</div>

@endsection
