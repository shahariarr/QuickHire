@extends('layouts.app')

@section('title', 'QuickHire – Find Your Perfect Job')

@section('content')
{{-- HERO SECTION --}}
<section class="bg-white pt-16 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 bg-brand-light text-brand text-sm font-medium px-4 py-1.5 rounded-full mb-6">
                <span class="w-2 h-2 bg-brand rounded-full"></span>
                {{ $totalJobs ?? 0 }}+ Jobs Available Right Now
            </div>
            <h1 class="text-5xl sm:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                Find Your <span class="text-brand">Dream Job</span><br>With QuickHire
            </h1>
            <p class="text-lg text-gray-500 mb-10 leading-relaxed">
                Browse hundreds of opportunities across every industry. Apply in minutes and land your next career move.
            </p>

            {{-- Search Bar --}}
            <form action="{{ route('jobs.index') }}" method="GET"
                  class="flex flex-col sm:flex-row gap-3 max-w-2xl mx-auto">
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" placeholder="Job title or keyword…"
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent text-sm"
                           value="{{ request('search') }}">
                </div>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <input type="text" name="location" placeholder="Location…"
                           class="w-full sm:w-44 pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent text-sm"
                           value="{{ request('location') }}">
                </div>
                <button type="submit"
                        class="bg-brand text-white font-semibold px-8 py-3 rounded-xl hover:bg-brand-dark transition-colors">
                    Search
                </button>
            </form>

            {{-- Popular Categories --}}
            <div class="mt-8 flex flex-wrap justify-center gap-2">
                <span class="text-sm text-gray-500">Popular:</span>
                @foreach(['Technology', 'Design', 'Marketing', 'Finance', 'Healthcare'] as $cat)
                    <a href="{{ route('jobs.index', ['category' => $cat]) }}"
                       class="text-sm text-brand font-medium hover:underline">{{ $cat }}</a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- STATS SECTION --}}
<section class="bg-brand py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-white">
            <div>
                <p class="text-3xl font-extrabold">{{ $totalJobs ?? 0 }}+</p>
                <p class="text-sm text-indigo-200 mt-1">Live Jobs</p>
            </div>
            <div>
                <p class="text-3xl font-extrabold">{{ $totalApplications ?? 0 }}+</p>
                <p class="text-sm text-indigo-200 mt-1">Applications</p>
            </div>
            <div>
                <p class="text-3xl font-extrabold">50+</p>
                <p class="text-sm text-indigo-200 mt-1">Companies</p>
            </div>
            <div>
                <p class="text-3xl font-extrabold">10+</p>
                <p class="text-sm text-indigo-200 mt-1">Categories</p>
            </div>
        </div>
    </div>
</section>

{{-- CATEGORIES SECTION --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Browse by Category</h2>
            <p class="text-gray-500 mt-2">Find the type of work you love</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @php
                $categories = [
                    ['name' => 'Technology',  'icon' => '💻', 'color' => 'bg-blue-50 text-blue-600 hover:bg-blue-100'],
                    ['name' => 'Design',      'icon' => '🎨', 'color' => 'bg-purple-50 text-purple-600 hover:bg-purple-100'],
                    ['name' => 'Marketing',   'icon' => '📣', 'color' => 'bg-pink-50 text-pink-600 hover:bg-pink-100'],
                    ['name' => 'Finance',     'icon' => '💼', 'color' => 'bg-green-50 text-green-600 hover:bg-green-100'],
                    ['name' => 'Healthcare',  'icon' => '🏥', 'color' => 'bg-red-50 text-red-600 hover:bg-red-100'],
                    ['name' => 'Education',   'icon' => '📚', 'color' => 'bg-yellow-50 text-yellow-600 hover:bg-yellow-100'],
                    ['name' => 'Engineering', 'icon' => '⚙️', 'color' => 'bg-gray-100 text-gray-700 hover:bg-gray-200'],
                    ['name' => 'Sales',       'icon' => '📈', 'color' => 'bg-orange-50 text-orange-600 hover:bg-orange-100'],
                    ['name' => 'Legal',       'icon' => '⚖️', 'color' => 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100'],
                    ['name' => 'Remote',      'icon' => '🌍', 'color' => 'bg-teal-50 text-teal-600 hover:bg-teal-100'],
                ];
            @endphp
            @foreach($categories as $cat)
                <a href="{{ route('jobs.index', ['category' => $cat['name']]) }}"
                   class="flex flex-col items-center gap-3 p-5 rounded-xl border border-transparent {{ $cat['color'] }} transition-all cursor-pointer">
                    <span class="text-2xl">{{ $cat['icon'] }}</span>
                    <span class="text-sm font-semibold">{{ $cat['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- FEATURED JOBS SECTION --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Latest Jobs</h2>
                <p class="text-gray-500 mt-1">Hand-picked opportunities updated daily</p>
            </div>
            <a href="{{ route('jobs.index') }}"
               class="text-sm font-semibold text-brand hover:underline flex items-center gap-1">
                View all jobs
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @if($latestJobs->isEmpty())
            <div class="text-center py-12 text-gray-400">No jobs yet. Check back soon!</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($latestJobs as $job)
                    <a href="{{ route('jobs.show', $job->id) }}"
                       class="bg-white border border-gray-200 rounded-xl p-5 hover:shadow-md hover:border-brand/30 transition-all flex flex-col gap-3">
                        <div class="flex items-start justify-between">
                            <div class="w-11 h-11 bg-brand-light rounded-lg flex items-center justify-center">
                                <span class="text-brand font-bold text-sm">{{ strtoupper(substr($job->company, 0, 2)) }}</span>
                            </div>
                            <span class="text-xs font-medium text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">
                                {{ $job->category }}
                            </span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 text-base">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-500 mt-0.5">{{ $job->company }}</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs text-gray-400 mt-auto pt-2 border-t border-gray-100">
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
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- HOW IT WORKS --}}
<section id="how-it-works" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">How It Works</h2>
            <p class="text-gray-500 mt-2">Get hired in three easy steps</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['step' => '01', 'title' => 'Search Jobs', 'desc' => 'Browse hundreds of listings filtered by category, location, or keyword.', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                ['step' => '02', 'title' => 'Apply Online',  'desc' => 'Submit your application with your resume link and a cover note in minutes.', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['step' => '03', 'title' => 'Get Hired',    'desc' => 'Employers review your application and reach out to schedule an interview.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ] as $item)
                <div class="flex flex-col items-center text-center p-6 bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="w-14 h-14 bg-brand-light rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-brand uppercase tracking-widest mb-2">Step {{ $item['step'] }}</span>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16 bg-brand">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-3xl font-extrabold mb-4">Ready to Find Your Next Role?</h2>
        <p class="text-indigo-200 mb-8">Thousands of companies are hiring right now. Don't miss out.</p>
        <a href="{{ route('jobs.index') }}"
           class="inline-block bg-white text-brand font-bold px-10 py-3.5 rounded-xl hover:bg-gray-100 transition-colors">
            Explore All Jobs
        </a>
    </div>
</section>
@endsection
