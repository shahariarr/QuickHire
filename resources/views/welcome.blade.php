@extends('layouts.app')

@section('title', 'QuickHire – Find Your Perfect Job')

@section('content')
{{-- ============================================================
     HERO SECTION
============================================================ --}}
<section class="relative overflow-hidden" style="background-color:#F8F8FD;">
    <div class="container py-20 lg:py-28">
        <div class="max-w-2xl">
            <p class="text-sm font-semibold uppercase tracking-widest mb-4" style="color:#4640DE;">— No. 1 Job Hunting Site</p>
            <h1 class="text-5xl lg:text-[64px] font-bold leading-[1.1] mb-6" style="font-family:'Clash Display',sans-serif; color:#25324B;">
                Discover<br><span style="color:#4640DE;">More Than<br>5000+ Jobs</span>
            </h1>
            <p class="text-base leading-7 mb-10 max-w-lg" style="color:#515B6F;">
                Great platform for job seekers who are searching for new career heights and passionate about their profession.
            </p>

            {{-- Search Bar --}}
            <form action="{{ route('jobs.index') }}" method="GET">
                <div class="flex flex-col sm:flex-row gap-0 bg-white border border-[#D6DDEB] rounded-lg overflow-hidden shadow-sm">
                    <div class="flex items-center gap-3 flex-1 px-4 py-3.5 border-b sm:border-b-0 sm:border-r border-[#D6DDEB]">
                        <svg class="w-5 h-5 flex-shrink-0" style="color:#515B6F;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" placeholder="Job title or keyword"
                               class="w-full text-sm border-none outline-none bg-transparent"
                               style="color:#25324B;"
                               value="{{ request('search') }}">
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3.5 sm:w-44">
                        <svg class="w-5 h-5 flex-shrink-0" style="color:#515B6F;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <input type="text" name="location" placeholder="Florence, Italy"
                               class="w-full text-sm border-none outline-none bg-transparent"
                               style="color:#25324B;"
                               value="{{ request('location') }}">
                    </div>
                    <div class="px-2 py-2 flex items-center">
                        <button type="submit" class="primary-btn w-full sm:w-auto">Search</button>
                    </div>
                </div>
            </form>

            <p class="mt-4 text-sm" style="color:#515B6F;">
                Popular:
                @foreach(['Technology','Design','Marketing','Finance','Healthcare'] as $cat)
                    <a href="{{ route('jobs.index', ['category' => $cat]) }}"
                       class="font-medium transition hover:underline ml-1" style="color:#25324B;">{{ $cat }}{{ !$loop->last ? ',' : '' }}</a>
                @endforeach
            </p>
        </div>
    </div>

    {{-- Decorative blob --}}
    <div class="absolute right-0 top-0 hidden lg:block w-1/2 h-full pointer-events-none" aria-hidden="true">
        <div class="w-full h-full" style="background:radial-gradient(ellipse at 80% 40%, rgba(70,64,222,.08) 0%, transparent 70%);"></div>
    </div>
</section>
{{-- ============================================================
     STATS STRIP
============================================================ --}}
<section class="bg-white border-y border-[#D6DDEB]">
    <div class="container py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 divide-x divide-[#D6DDEB]">
            @foreach([
                ['value' => ($totalJobs ?? 0) . '+',        'label' => 'Live Jobs'],
                ['value' => ($totalApplications ?? 0) . '+','label' => 'Applications Sent'],
                ['value' => '50+',                           'label' => 'Companies'],
                ['value' => '10+',                           'label' => 'Job Categories'],
            ] as $stat)
            <div class="pl-6 first:pl-0">
                <p class="text-3xl font-bold" style="font-family:'Clash Display',sans-serif; color:#25324B;">{{ $stat['value'] }}</p>
                <p class="text-sm mt-1" style="color:#515B6F;">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     CATEGORIES SECTION
============================================================ --}}
<section class="py-20" style="background-color:#F8F8FD;">
    <div class="container">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold mb-2" style="font-family:'Clash Display',sans-serif; color:#25324B;">Explore by <span style="color:#4640DE;">Category</span></h2>
                <p class="text-sm" style="color:#515B6F;">Find the type of work you love</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="hidden sm:flex items-center gap-1 text-sm font-semibold transition hover:opacity-80" style="color:#4640DE;">
                Show all jobs
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @php
            $cats = [
                ['name'=>'Technology',  'count'=>'1,245','bg'=>'#E9EFFD','color'=>'#3F75E0','icon'=>'💻'],
                ['name'=>'Design',      'count'=>'826',  'bg'=>'#F9E8FD','color'=>'#9B33C2','icon'=>'🎨'],
                ['name'=>'Marketing',   'count'=>'654',  'bg'=>'#FDE8F3','color'=>'#C2336D','icon'=>'📣'],
                ['name'=>'Finance',     'count'=>'490',  'bg'=>'#E8FDF0','color'=>'#22A05B','icon'=>'💼'],
                ['name'=>'Healthcare',  'count'=>'320',  'bg'=>'#FDE8E8','color'=>'#C23333','icon'=>'🏥'],
                ['name'=>'Education',   'count'=>'203',  'bg'=>'#FDF7E8','color'=>'#C29033','icon'=>'📚'],
                ['name'=>'Engineering', 'count'=>'391',  'bg'=>'#E8F4FD','color'=>'#3395C2','icon'=>'⚙️'],
                ['name'=>'Sales',       'count'=>'274',  'bg'=>'#FDF0E8','color'=>'#C26133','icon'=>'📈'],
            ];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($cats as $cat)
            <a href="{{ route('jobs.index', ['category' => $cat['name']]) }}"
               class="group flex items-center gap-4 p-5 bg-white border border-[#D6DDEB] rounded-lg transition hover:border-[#4640DE] hover:shadow-sm">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center text-2xl flex-shrink-0" style="background:{{ $cat['bg'] }};">
                    {{ $cat['icon'] }}
                </div>
                <div>
                    <p class="font-semibold text-sm" style="color:#25324B;">{{ $cat['name'] }}</p>
                    <p class="text-xs mt-0.5" style="color:#7C8493;">{{ $cat['count'] }} jobs available</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     LATEST JOBS
============================================================ --}}
<section class="py-20 bg-white">
    <div class="container">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold mb-2" style="font-family:'Clash Display',sans-serif; color:#25324B;">Latest <span style="color:#4640DE;">Job Open</span></h2>
                <p class="text-sm" style="color:#515B6F;">Hand-picked opportunities updated daily</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="hidden sm:flex items-center gap-1 text-sm font-semibold transition hover:opacity-80" style="color:#4640DE;">
                Show all jobs
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($latestJobs->isEmpty())
            <div class="text-center py-16" style="color:#7C8493;">No jobs yet. Check back soon!</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($latestJobs as $job)
                <a href="{{ route('jobs.show', $job->id) }}"
                   class="group flex flex-col gap-4 p-6 bg-white border border-[#D6DDEB] rounded-lg transition hover:border-[#4640DE] hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold text-sm"
                             style="color:#4640DE; background:#EEF0FD;">
                            {{ strtoupper(substr($job->company, 0, 2)) }}
                        </div>
                        @if($job->type)
                        <span class="text-xs font-medium px-3 py-1 rounded border" style="color:#56CDAD; border-color:#56CDAD; background:#E9FAF7;">
                            {{ $job->type }}
                        </span>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-semibold text-base mb-0.5" style="color:#25324B;">{{ $job->title }}</h3>
                        <p class="text-sm" style="color:#515B6F;">{{ $job->company }}</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 pt-3 border-t border-[#D6DDEB]">
                        <span class="flex items-center gap-1 text-xs" style="color:#7C8493;">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $job->location }}
                        </span>
                        <span class="mx-1 text-[#D6DDEB]">•</span>
                        <span class="text-xs px-2 py-0.5 rounded border border-[#FFB836] font-medium" style="color:#FFB836; background:#FFF8EE;">{{ $job->category }}</span>
                        <span class="mx-1 text-[#D6DDEB]">•</span>
                        <span class="text-xs" style="color:#7C8493;">{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     HOW IT WORKS
============================================================ --}}
<section id="how-it-works" class="py-20" style="background-color:#F8F8FD;">
    <div class="container">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold mb-2" style="font-family:'Clash Display',sans-serif; color:#25324B;">How <span style="color:#4640DE;">QuickHire</span> Works</h2>
            <p class="text-sm" style="color:#515B6F;">Get hired in three easy steps</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['step'=>'01','title'=>'Create Account',    'desc'=>'Sign up and complete your profile so employers can find and contact you easily.',       'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['step'=>'02','title'=>'Search For Jobs',   'desc'=>'Browse hundreds of listings filtered by category, location, or keyword that match you.', 'icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                ['step'=>'03','title'=>'Apply For Job',     'desc'=>'Submit your application with your resume and a cover note in minutes and get hired.',     'icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ] as $i => $item)
            <div class="relative bg-white border border-[#D6DDEB] rounded-lg p-8">
                @if(!$loop->last)
                <div class="hidden md:block absolute top-1/2 -right-4 -translate-y-1/2 z-10 w-8">
                    <svg class="w-full" viewBox="0 0 32 16" fill="none"><path d="M0 8 H28 M22 2 L28 8 L22 14" stroke="#C5C9D6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                @endif
                <span class="text-5xl font-bold mb-5 block" style="color:#D6DDEB; font-family:'Clash Display',sans-serif;">{{ $item['step'] }}</span>
                <div class="w-14 h-14 rounded-full flex items-center justify-center mb-5" style="background:#EEF0FD;">
                    <svg class="w-7 h-7" style="color:#4640DE;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2" style="font-family:'Clash Display',sans-serif; color:#25324B;">{{ $item['title'] }}</h3>
                <p class="text-sm leading-7" style="color:#515B6F;">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     CALL TO ACTION
============================================================ --}}
<section class="py-20" style="background-color:#4640DE;">
    <div class="container text-center text-white">
        <h2 class="text-3xl lg:text-4xl font-bold mb-4" style="font-family:'Clash Display',sans-serif;">Start Posting Jobs Today</h2>
        <p class="mb-8 text-sm opacity-80 max-w-md mx-auto">Start posting jobs for only $10 and reach thousands of professionals looking for their next opportunity.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('jobs.index') }}"
               class="px-8 py-3.5 rounded font-semibold text-sm transition hover:opacity-90"
               style="background:#FFFFFF; color:#4640DE;">
                Search Jobs
            </a>
            <a href="{{ route('admin.jobs.create') }}"
               class="px-8 py-3.5 rounded font-semibold text-sm border border-white text-white transition hover:bg-white/10">
                Post a Job →
            </a>
        </div>
    </div>
</section>
@endsection
