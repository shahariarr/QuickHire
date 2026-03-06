@extends('layouts.app')

@section('title', 'Browse Jobs – QuickHire')

@section('content')
<div class="bg-gray-50 min-h-screen">

    {{-- Page Header --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl font-bold text-gray-900">All Jobs</h1>
            <p class="text-gray-500 mt-1">{{ $jobs->total() }} job{{ $jobs->total() !== 1 ? 's' : '' }} found</p>

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('jobs.index') }}" class="mt-5 flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title or company…"
                           class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent">
                </div>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Location…"
                           class="w-full sm:w-44 pl-9 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent">
                </div>
                <select name="category"
                        class="sm:w-44 px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent bg-white">
                    <option value="">All Categories</option>
                    @foreach(['Technology','Design','Marketing','Finance','Healthcare','Education','Engineering','Sales','Legal','Remote'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-brand text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-brand-dark transition-colors text-sm">
                    Filter
                </button>
                @if(request()->hasAny(['search','location','category']))
                    <a href="{{ route('jobs.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center">Clear</a>
                @endif
            </form>
        </div>
    </div>

    {{-- Job Listings --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($jobs->isEmpty())
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500 text-lg font-medium">No jobs found</p>
                <p class="text-gray-400 text-sm mt-1">Try adjusting your filters or check back later.</p>
                <a href="{{ route('jobs.index') }}" class="mt-4 inline-block text-brand font-medium hover:underline text-sm">Clear filters</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($jobs as $job)
                    <a href="{{ route('jobs.show', $job->id) }}"
                       class="flex items-center gap-5 bg-white border border-gray-200 rounded-xl p-5 hover:shadow-md hover:border-brand/30 transition-all">
                        {{-- Company Avatar --}}
                        <div class="w-14 h-14 bg-brand-light rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="text-brand font-bold text-lg">{{ strtoupper(substr($job->company, 0, 2)) }}</span>
                        </div>
                        {{-- Job Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="font-semibold text-gray-900 text-base">{{ $job->title }}</h2>
                                    <p class="text-sm text-gray-500 mt-0.5">{{ $job->company }}</p>
                                </div>
                                <span class="hidden sm:inline-block text-xs font-medium bg-brand-light text-brand px-3 py-1 rounded-full flex-shrink-0">
                                    {{ $job->category }}
                                </span>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 mt-3 text-xs text-gray-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $job->location }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $job->created_at->diffForHumans() }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    {{ $job->applications_count ?? 0 }} applicant{{ ($job->applications_count ?? 0) !== 1 ? 's' : '' }}
                                </span>
                            </div>
                        </div>
                        {{-- Arrow --}}
                        <svg class="w-5 h-5 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $jobs->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
