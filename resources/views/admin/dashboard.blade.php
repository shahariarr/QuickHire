@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Overview of your QuickHire platform')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    @foreach([
        ['label' => 'Total Jobs',         'value' => $totalJobs,         'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'bg' => '#EEF0FD', 'color' => '#4640DE'],
        ['label' => 'Total Applications', 'value' => $totalApplications, 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'bg' => '#E9FAF7', 'color' => '#56CDAD'],
        ['label' => 'Jobs This Month',    'value' => $jobsThisMonth,     'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',                                              'bg' => '#FFF8EE', 'color' => '#FFB836'],
        ['label' => 'Apps This Month',    'value' => $appsThisMonth,     'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',                                                                                                          'bg' => '#E8F4FD', 'color' => '#26A4FF'],
    ] as $card)
    <div class="bg-white border border-[#D6DDEB] rounded-lg p-6">
        <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-4" style="background:{{ $card['bg'] }};">
            <svg class="w-6 h-6" style="color:{{ $card['color'] }};" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>
            </svg>
        </div>
        <p class="text-2xl font-bold" style="font-family:'Clash Display',sans-serif; color:#25324B;">{{ $card['value'] }}</p>
        <p class="text-xs mt-1" style="color:#7C8493;">{{ $card['label'] }}</p>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Recent Jobs --}}
    <div class="bg-white border border-[#D6DDEB] rounded-lg overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-[#D6DDEB]">
            <h2 class="font-bold text-sm" style="font-family:'Clash Display',sans-serif; color:#25324B;">Recent Jobs</h2>
            <a href="{{ route('admin.jobs.index') }}" class="text-xs font-semibold transition hover:opacity-70" style="color:#4640DE;">View all</a>
        </div>
        <div class="divide-y divide-[#F8F8FD]">
            @forelse($recentJobs as $job)
            <div class="flex items-center justify-between px-5 py-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold text-xs flex-shrink-0" style="color:#4640DE; background:#EEF0FD;">
                        {{ strtoupper(substr($job->company, 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium truncate" style="color:#25324B;">{{ $job->title }}</p>
                        <p class="text-xs truncate" style="color:#7C8493;">{{ $job->company }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0 ml-3">
                    <span class="text-xs" style="color:#7C8493;">{{ $job->created_at->diffForHumans() }}</span>
                    <a href="{{ route('admin.jobs.edit', $job->id) }}" class="text-xs font-semibold transition hover:opacity-70" style="color:#4640DE;">Edit</a>
                </div>
            </div>
            @empty
            <p class="px-5 py-8 text-sm text-center" style="color:#7C8493;">No jobs yet.
                <a href="{{ route('admin.jobs.create') }}" class="font-semibold" style="color:#4640DE;">Post one.</a>
            </p>
            @endforelse
        </div>
    </div>

    {{-- Recent Applications --}}
    <div class="bg-white border border-[#D6DDEB] rounded-lg overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-[#D6DDEB]">
            <h2 class="font-bold text-sm" style="font-family:'Clash Display',sans-serif; color:#25324B;">Recent Applications</h2>
            <a href="{{ route('admin.applications.index') }}" class="text-xs font-semibold transition hover:opacity-70" style="color:#4640DE;">View all</a>
        </div>
        <div class="divide-y divide-[#F8F8FD]">
            @forelse($recentApplications as $app)
            <div class="flex items-center justify-between px-5 py-4">
                <div class="min-w-0">
                    <p class="text-sm font-medium truncate" style="color:#25324B;">{{ $app->name }}</p>
                    <p class="text-xs truncate" style="color:#7C8493;">{{ $app->job->title ?? '—' }}</p>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0 ml-3">
                    <span class="text-xs" style="color:#7C8493;">{{ $app->created_at->diffForHumans() }}</span>
                    <a href="{{ route('admin.applications.show', $app->id) }}" class="text-xs font-semibold transition hover:opacity-70" style="color:#4640DE;">View</a>
                </div>
            </div>
            @empty
            <p class="px-5 py-8 text-sm text-center" style="color:#7C8493;">No applications yet.</p>
            @endforelse
        </div>
    </div>

</div>

@endsection
