@extends('layouts.app')

@section('title', 'Browse Jobs – QuickHire')

@section('content')

{{-- Page Header --}}
<div class="bg-white border-b border-[#D6DDEB]">
    <div class="container py-10">
        <h1 class="text-3xl font-bold mb-1" style="font-family:'Clash Display',sans-serif; color:#25324B;">Browse Jobs</h1>
        <p class="text-sm" style="color:#515B6F;">{{ $jobs->total() }} job{{ $jobs->total() !== 1 ? 's' : '' }} found</p>

        {{-- Filter Form --}}
        <form method="GET" action="{{ route('jobs.index') }}" class="mt-6">
            <div class="flex flex-col sm:flex-row gap-0 bg-white border border-[#D6DDEB] rounded-lg overflow-hidden shadow-sm max-w-3xl">
                <div class="flex items-center gap-3 flex-1 px-4 py-3 border-b sm:border-b-0 sm:border-r border-[#D6DDEB]">
                    <svg class="w-4 h-4 flex-shrink-0" style="color:#515B6F;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Job title or company"
                           class="w-full text-sm border-none outline-none bg-transparent" style="color:#25324B;">
                </div>
                <div class="flex items-center gap-3 px-4 py-3 border-b sm:border-b-0 sm:border-r border-[#D6DDEB] sm:w-40">
                    <svg class="w-4 h-4 flex-shrink-0" style="color:#515B6F;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Location"
                           class="w-full text-sm border-none outline-none bg-transparent" style="color:#25324B;">
                </div>
                <div class="px-3 py-2 border-b sm:border-b-0 sm:border-r border-[#D6DDEB] sm:w-44">
                    <select name="category" class="w-full text-sm border-none outline-none bg-transparent py-1" style="color:#515B6F;">
                        <option value="">All Categories</option>
                        @foreach(['Technology','Design','Marketing','Finance','Healthcare','Education','Engineering','Sales','Legal','Remote'] as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="px-2 py-2 flex items-center gap-2">
                    <button type="submit" class="primary-btn">Search</button>
                    @if(request()->hasAny(['search','location','category']))
                        <a href="{{ route('jobs.index') }}" class="text-xs px-3 py-2 rounded border border-[#D6DDEB] transition hover:bg-gray-50" style="color:#515B6F;">Clear</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Job Listings --}}
<div style="background:#F8F8FD;" class="min-h-screen">
    <div class="container py-10">
        @if($jobs->isEmpty())
            <div class="text-center py-24 bg-white border border-[#D6DDEB] rounded-lg">
                <svg class="w-16 h-16 mx-auto mb-4" style="color:#D6DDEB;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <p class="text-base font-semibold mb-1" style="color:#25324B;">No jobs found</p>
                <p class="text-sm mb-4" style="color:#515B6F;">Try adjusting your filters or check back later.</p>
                <a href="{{ route('jobs.index') }}" class="text-sm font-medium" style="color:#4640DE;">Clear filters →</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($jobs as $job)
                <a href="{{ route('jobs.show', $job->id) }}"
                   class="group flex items-center gap-5 bg-white border border-[#D6DDEB] rounded-lg p-5 transition hover:border-[#4640DE] hover:shadow-md">
                    {{-- Avatar --}}
                    <div class="w-14 h-14 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold text-base flex-shrink-0"
                         style="color:#4640DE; background:#EEF0FD;">
                        {{ strtoupper(substr($job->company, 0, 2)) }}
                    </div>
                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="font-semibold text-base" style="color:#25324B;">{{ $job->title }}</h2>
                                <p class="text-sm mt-0.5" style="color:#515B6F;">{{ $job->company }}</p>
                            </div>
                            @if($job->type)
                            <span class="hidden sm:inline-block text-xs font-medium px-3 py-1 rounded border flex-shrink-0" style="color:#56CDAD; border-color:#56CDAD; background:#E9FAF7;">
                                {{ $job->type }}
                            </span>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-3 mt-3">
                            <span class="flex items-center gap-1 text-xs" style="color:#7C8493;">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $job->location }}
                            </span>
                            <span class="text-[#D6DDEB]">•</span>
                            <span class="text-xs px-2 py-0.5 rounded border border-[#FFB836] font-medium" style="color:#FFB836; background:#FFF8EE;">{{ $job->category }}</span>
                            <span class="text-[#D6DDEB]">•</span>
                            <span class="text-xs" style="color:#7C8493;">{{ $job->created_at->diffForHumans() }}</span>
                            @if(($job->applications_count ?? 0) > 0)
                            <span class="text-[#D6DDEB]">•</span>
                            <span class="text-xs" style="color:#7C8493;">{{ $job->applications_count }} applicant{{ $job->applications_count !== 1 ? 's' : '' }}</span>
                            @endif
                        </div>
                    </div>
                    <svg class="w-5 h-5 flex-shrink-0 opacity-30 group-hover:opacity-100 transition" style="color:#4640DE;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $jobs->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
