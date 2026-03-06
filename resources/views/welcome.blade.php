@extends('layouts.app')

@section('title', 'QuickHire – Find Your Perfect Job')

@push('styles')
<style>
    /* Hero diagonal deco */
    .hero-deco {
        position: absolute;
        right: 0;
        bottom: -455px;
        height: 716px;
        width: 280px;
        transform: rotate(64deg);
        background: white;
        pointer-events: none;
    }
    /* Category card lift */
    .cat-card {
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .cat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -8px rgba(70,64,222,.18);
        border-color: #4640DE !important;
    }
    /* Job card hover */
    .job-card {
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .job-card:hover {
        border-color: #4640DE !important;
        box-shadow: 0 16px 40px -8px rgba(70,64,222,.15);
    }
    /* Company logo strip grayscale */
    .company-logo {
        filter: grayscale(100%) opacity(.55);
        transition: filter .3s ease;
    }
    .company-logo:hover { filter: none; }
</style>
@endpush

@section('content')

{{-- ============================================================
     HERO SECTION
============================================================ --}}
<section class="relative z-10 overflow-x-hidden pb-0" style="background-color:#F8F8FD;">
    {{-- Decorative SVG background --}}
    <svg class="absolute top-0 right-0 -z-10 w-[54rem] pointer-events-none" aria-hidden="true" viewBox="0 0 997 794" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.6" d="M328.972 194.827L615.806 54.9799L617.987 263.252L329.227 402.94L328.972 194.827Z" stroke="#CCCCF5" stroke-width="4"/>
        <path opacity="0.7" d="M428.972 304.383L997.883 24.3027L1120.59 325.287L429.229 662.488L428.972 304.383Z" stroke="#CCCCF5" stroke-width="4"/>
        <path d="M2.00481 561.244L517.767 307.214L517.767 617.25L2.22902 869.48L2.00481 561.244Z" fill="#F8F8FD" stroke="#CCCCF5" stroke-width="4"/>
    </svg>

    <div class="container relative z-10 w-full overflow-hidden">
        <div class="grid h-full w-full grid-cols-1 items-center gap-10 lg:grid-cols-2">

            {{-- Left: copy + search --}}
            <div class="pt-14 pb-10 lg:self-start lg:pt-28 lg:pb-0">
                <h1 class="mb-9 leading-none font-semibold text-4xl xl:text-7xl" style="font-family:'Clash Display',sans-serif; color:#25324B;">
                    Discover<br>
                    <span style="color:#26A4FF;">More Than</span><br>
                    5000+ Jobs
                </h1>

                {{-- Search form --}}
                <form action="{{ route('jobs.index') }}" method="GET">
                    <div class="flex flex-col sm:flex-row items-stretch gap-0 bg-white border border-[#D6DDEB] rounded-lg overflow-hidden shadow-sm">
                        {{-- Keyword --}}
                        <div class="flex items-center gap-3 flex-1 px-4 py-3.5 border-b sm:border-b-0 sm:border-r border-[#D6DDEB]">
                            <svg class="w-5 h-5 flex-shrink-0" style="color:#515B6F;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="search" placeholder="Job title or keyword"
                                class="w-full text-sm border-none outline-none bg-transparent"
                                style="color:#25324B;"
                                value="{{ request('search') }}">
                        </div>
                        {{-- Location --}}
                        <div class="relative flex items-center gap-3 px-4 py-3.5 sm:w-52 border-b sm:border-b-0 sm:border-r border-[#D6DDEB]" id="loc-wrapper">
                            <svg class="w-5 h-5 flex-shrink-0" style="color:#515B6F;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <input type="text" name="location" id="loc-input" placeholder="City or remote"
                                class="w-full text-sm border-none outline-none bg-transparent cursor-pointer"
                                style="color:#25324B;"
                                value="{{ request('location') }}"
                                autocomplete="off">
                            {{-- Dropdown suggestions --}}
                            <div id="loc-dropdown" class="hidden absolute left-0 top-full mt-1 w-full bg-white border border-[#D6DDEB] rounded-lg shadow-xl z-20 py-1">
                                @foreach(['Remote','New York, NY','San Francisco, CA','London, UK','Berlin, Germany','Toronto, Canada'] as $loc)
                                <button type="button" class="loc-option w-full text-left px-4 py-2.5 text-sm hover:bg-[#F8F8FD] transition" style="color:#515B6F;">{{ $loc }}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="px-2 py-2 flex items-center">
                            <button type="submit" class="primary-btn w-full sm:w-auto whitespace-nowrap">Search my job</button>
                        </div>
                    </div>
                </form>

                {{-- Popular tags --}}
                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
                    <p class="text-sm flex-shrink-0" style="color:#7C8493;">Popular Tags:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['UI Designer','UX Researcher','Full-Stack','Remote','Marketing'] as $tag)
                        <a href="{{ route('jobs.index', ['search' => $tag]) }}"
                           class="inline-block shrink-0 rounded-lg border border-[#25324B]/10 px-3 py-1.5 text-sm font-medium transition hover:bg-blue-100/20"
                           style="color:#515B6F;">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right: floating job cards illustration --}}
            <div class="relative hidden lg:flex flex-col items-end justify-end self-end pt-10">
                {{-- Decorative diagonal white strip --}}
                <div class="hero-deco" aria-hidden="true"></div>

                {{-- Floating stat badge --}}
                <div class="absolute left-0 top-24 z-10 bg-white rounded-2xl shadow-2xl shadow-gray-200 px-5 py-4 flex items-center gap-3 border border-[#D6DDEB]">
                    <div class="w-11 h-11 rounded-full flex items-center justify-center text-xl" style="background:#FFB836;">🎯</div>
                    <div>
                        <p class="text-xs font-semibold" style="color:#25324B;">{{ ($totalJobs ?? 0) }}+ Live Jobs</p>
                        <p class="text-xs" style="color:#7C8493;">Updated daily</p>
                    </div>
                </div>

                {{-- Mock job cards panel --}}
                <div class="relative z-10 w-[370px] xl:w-[420px] flex flex-col gap-3 pb-8">
                    @php
                        $mockCards = [
                            ['title'=>'UI / UX Designer',       'company'=>'Nomad',      'tags'=>['Full-Time','Remote'],   'color'=>'#56CDAD'],
                            ['title'=>'Software Engineer',      'company'=>'Stripe',     'tags'=>['Full-Time','On-site'],  'color'=>'#26A4FF'],
                            ['title'=>'Product Manager',        'company'=>'Notion',     'tags'=>['Part-Time','Hybrid'],   'color'=>'#FFB836'],
                        ];
                    @endphp
                    @foreach($mockCards as $i => $mc)
                    <div class="bg-white rounded-xl border border-[#D6DDEB] px-5 py-4 flex items-center gap-4 shadow-lg shadow-gray-100 {{ $i === 0 ? 'ring-2 ring-[#4640DE]/20' : '' }}">
                        <div class="w-11 h-11 rounded-lg flex items-center justify-center font-bold text-sm flex-shrink-0"
                             style="background:#EEF0FD; color:#4640DE;">
                            {{ strtoupper(substr($mc['company'], 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm" style="color:#25324B;">{{ $mc['title'] }}</p>
                            <p class="text-xs mt-0.5" style="color:#7C8493;">{{ $mc['company'] }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-1">
                            @foreach($mc['tags'] as $tag)
                            <span class="text-xs px-2 py-0.5 rounded border font-medium whitespace-nowrap"
                                  style="color:{{ $mc['color'] }}; border-color:{{ $mc['color'] }}; background:{{ $mc['color'] }}18;">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     COMPANIES WE HELPED GROW
============================================================ --}}
<section class="py-14 bg-white">
    <div class="container">
        <p class="text-[18px] font-normal leading-7 mb-7" style="color:#202430; opacity:.5;">Companies we helped grow</p>
        <div class="flex flex-wrap items-center justify-around gap-6 sm:justify-between">
            @foreach([
                ['name'=>'Vodafone',    'abbr'=>'VDF'],
                ['name'=>'Intel',       'abbr'=>'INTC'],
                ['name'=>'Tesla',       'abbr'=>'TSLA'],
                ['name'=>'AMD',         'abbr'=>'AMD'],
                ['name'=>'Talkit',      'abbr'=>'TLK'],
                ['name'=>'Puma',        'abbr'=>'PUMA'],
            ] as $co)
            <div class="company-logo flex items-center gap-2 select-none">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-xs font-bold border border-[#D6DDEB]"
                     style="color:#515B6F; background:#F8F8FD;">{{ $co['abbr'] }}</div>
                <span class="text-base font-semibold" style="color:#515B6F;">{{ $co['name'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     EXPLORE BY CATEGORY
============================================================ --}}
<section class="py-16" style="background-color:#F8F8FD;">
    <div class="container">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-4xl lg:text-5xl font-semibold" style="font-family:'Clash Display',sans-serif; color:#25324B;">
                Explore by <span style="color:#26A4FF;">category</span>
            </h2>
            <a href="{{ route('jobs.index') }}" class="hidden sm:flex items-center gap-1 text-sm font-semibold transition hover:translate-x-1" style="color:#4640DE;">
                Show all jobs
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @php
            $cats = [
                ['name'=>'Design',       'count'=>'235', 'icon'=>'🎨', 'gradient'=>false],
                ['name'=>'Sales',        'count'=>'756', 'icon'=>'📈', 'gradient'=>false],
                ['name'=>'Marketing',    'count'=>'140', 'icon'=>'📣', 'gradient'=>true],
                ['name'=>'Finance',      'count'=>'325', 'icon'=>'💼', 'gradient'=>false],
                ['name'=>'Technology',   'count'=>'1214','icon'=>'💻', 'gradient'=>false],
                ['name'=>'Engineering',  'count'=>'542', 'icon'=>'⚙️', 'gradient'=>false],
                ['name'=>'Business',     'count'=>'211', 'icon'=>'🏢', 'gradient'=>false],
                ['name'=>'Human Resource','count'=>'47', 'icon'=>'👥', 'gradient'=>false],
            ];
        @endphp

        <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($cats as $cat)
            <a href="{{ route('jobs.index', ['category' => $cat['name']]) }}"
               class="cat-card group w-full rounded-xl border border-[#D6DDEB] p-8 {{ $cat['gradient'] ? 'text-white' : '' }}"
               style="{{ $cat['gradient'] ? 'background:linear-gradient(135deg,#4640DE,rgba(70,64,222,.85));' : 'background:#fff;' }}">
                <div class="mb-3 w-14 h-14 rounded-lg flex items-center justify-center text-2xl shadow-lg"
                     style="{{ $cat['gradient'] ? 'background:rgba(255,255,255,.15);' : 'background:#F8F8FD;' }}">
                    {{ $cat['icon'] }}
                </div>
                <div class="flex flex-col justify-between gap-2 mt-2">
                    <p class="text-xl font-semibold transition group-hover:{{ $cat['gradient'] ? 'text-white' : 'text-[#4640DE]' }}"
                       style="{{ $cat['gradient'] ? '' : 'color:#25324B; font-family:\'Clash Display\',sans-serif;' }}">
                        {{ $cat['name'] }}
                    </p>
                    <div class="flex items-center justify-between {{ $cat['gradient'] ? 'text-blue-50' : '' }}" style="{{ $cat['gradient'] ? '' : 'color:#7C8493;' }}">
                        <p class="text-sm">{{ $cat['count'] }} Jobs available</p>
                        <svg class="w-6 h-6 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     FEATURED JOBS
============================================================ --}}
<section class="py-20" style="background-color:#F8F8FD;">
    <div class="container">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-4xl lg:text-5xl font-semibold" style="font-family:'Clash Display',sans-serif; color:#25324B;">
                Featured <span style="color:#26A4FF;">jobs</span>
            </h2>
            <a href="{{ route('jobs.index') }}" class="hidden sm:flex items-center gap-1 text-sm font-semibold transition hover:translate-x-1" style="color:#4640DE;">
                Show all jobs
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($latestJobs->isEmpty())
            <div class="text-center py-16" style="color:#7C8493;">No featured jobs yet. Check back soon!</div>
        @else
            <div class="mt-10 grid w-full gap-10 md:grid-cols-2 xl:grid-cols-3 xl:gap-5">
                @foreach($latestJobs->take(6) as $job)
                <a href="{{ route('jobs.show', $job->id) }}"
                   class="job-card relative cursor-pointer rounded-xl border border-gray-200 bg-white p-5 md:p-6 lg:p-7">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex w-full items-start gap-3">
                            <div class="w-12 h-12 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold text-sm flex-shrink-0"
                                 style="color:#4640DE; background:#EEF0FD;">
                                {{ strtoupper(substr($job->company, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-semibold text-base leading-snug" style="color:#25324B;">{{ $job->title }}</h3>
                                <p class="text-sm mt-0.5 flex items-center gap-1.5" style="color:#7C8493;">
                                    <span>{{ $job->company }}</span>
                                    <span class="text-[#D6DDEB]">•</span>
                                    <span>{{ $job->location }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @if($job->type)
                        <span class="text-xs font-medium px-3 py-1 rounded border" style="color:#56CDAD; border-color:#56CDAD; background:#E9FAF7;">{{ $job->type }}</span>
                        @endif
                        <span class="text-xs font-medium px-3 py-1 rounded border border-[#FFB836]" style="color:#FFB836; background:#FFF8EE;">{{ $job->category }}</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between pt-4 border-t border-[#D6DDEB]">
                        <span class="text-xs" style="color:#7C8493;">{{ $job->created_at->diffForHumans() }}</span>
                        <span class="text-xs font-semibold" style="color:#4640DE;">Apply →</span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     LATEST JOBS OPEN
============================================================ --}}
<section class="py-20 bg-white">
    <div class="container">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-4xl lg:text-5xl font-semibold" style="font-family:'Clash Display',sans-serif; color:#25324B;">
                Latest <span style="color:#26A4FF;">jobs open</span>
            </h2>
            <a href="{{ route('jobs.index') }}" class="hidden sm:flex items-center gap-1 text-sm font-semibold transition hover:translate-x-1" style="color:#4640DE;">
                Show all jobs
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($latestJobs->isEmpty())
            <div class="text-center py-16" style="color:#7C8493;">No jobs yet. Check back soon!</div>
        @else
            <div class="mt-10 grid grid-cols-1 gap-10 md:grid-cols-2 md:gap-y-4 xl:grid-cols-3">
                @foreach($latestJobs as $job)
                <a href="{{ route('jobs.show', $job->id) }}"
                   class="job-card flex min-w-min flex-col items-start gap-4 rounded-lg border border-gray-300 bg-white px-4 py-6 shadow-2xl shadow-gray-500/10">
                    <div class="flex w-full items-center justify-between">
                        <div class="w-11 h-11 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold text-sm"
                             style="color:#4640DE; background:#EEF0FD;">
                            {{ strtoupper(substr($job->company, 0, 2)) }}
                        </div>
                        @if($job->type)
                        <span class="text-xs font-medium px-3 py-1 rounded-full border" style="color:#56CDAD; border-color:#56CDAD; background:#E9FAF7;">{{ $job->type }}</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-semibold text-base" style="color:#25324B;">{{ $job->title }}</h3>
                        <p class="text-sm mt-0.5" style="color:#7C8493;">{{ $job->company }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs px-2 py-0.5 rounded border border-[#FFB836] font-medium" style="color:#FFB836; background:#FFF8EE;">{{ $job->category }}</span>
                    </div>
                    <div class="w-full flex items-center justify-between pt-3 border-t border-[#D6DDEB] mt-auto">
                        <div class="flex items-center gap-1 text-xs" style="color:#7C8493;">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $job->location }}
                        </div>
                        <span class="text-xs" style="color:#7C8493;">Posted: {{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     CTA - START POSTING JOBS TODAY
============================================================ --}}
<section class="py-10">
    <div class="container overflow-hidden">
        <div class="relative grid bg-primaryColor px-9 pt-20 pb-0 md:grid-cols-2 lg:px-20 lg:pt-20 rounded-2xl overflow-hidden
                    before:absolute before:-top-[250px] before:-left-[200px] before:h-[700px] before:w-[100px] before:rotate-[60deg] before:bg-white/10 before:content-['']
                    after:absolute after:right-0 after:-bottom-[350px] after:-z-10 after:h-[700px] after:w-[100px] after:rotate-[60deg] after:bg-white/10 after:content-['']">

            <div class="flex w-full flex-col items-start gap-5 pb-20">
                <h2 class="font-semibold text-4xl leading-[1.085] text-blue-50 lg:text-5xl" style="font-family:'Clash Display',sans-serif;">
                    Start posting<br class="hidden sm:block"> jobs today
                </h2>
                <p class="w-5/6 text-base font-medium text-blue-50/80">
                    Reach thousands of talented professionals actively looking for new opportunities. Post a job in minutes.
                </p>
                <a href="{{ route('admin.jobs.create') }}"
                   class="cursor-pointer rounded-sm bg-blue-50 px-5 py-3 font-semibold transition hover:scale-[1.02] hover:opacity-90 inline-block"
                   style="color:#4640DE;">
                    Post a Job for Free →
                </a>
            </div>

            {{-- Dashboard mockup panel --}}
            <div class="self-end flex justify-center lg:justify-end">
                <div class="w-full max-w-sm xl:max-w-md bg-white rounded-t-xl shadow-2xl overflow-hidden border border-[#D6DDEB]/40">
                    {{-- Mock topbar --}}
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-[#D6DDEB] bg-[#F8F8FD]">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        <div class="flex-1 mx-4 h-5 rounded bg-[#D6DDEB]/50 text-xs text-center flex items-center justify-center" style="color:#7C8493;">dashboard</div>
                    </div>
                    {{-- Mock job rows --}}
                    <div class="p-4 space-y-3">
                        @foreach([['UI Designer','Nomad','#56CDAD'],['Sr. Engineer','Stripe','#26A4FF'],['PM Intern','Notion','#FFB836']] as $r)
                        <div class="flex items-center gap-3 p-3 rounded-lg border border-[#D6DDEB]">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0" style="background:#EEF0FD; color:#4640DE;">
                                {{ strtoupper(substr($r[1], 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold truncate" style="color:#25324B;">{{ $r[0] }}</p>
                                <p class="text-xs" style="color:#7C8493;">{{ $r[1] }}</p>
                            </div>
                            <span class="text-xs px-2 py-0.5 rounded-full border font-medium whitespace-nowrap" style="color:{{ $r[2] }}; border-color:{{ $r[2] }}; background:{{ $r[2] }}15;">Full-Time</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Location dropdown toggle
    const locInput = document.getElementById('loc-input');
    const locDropdown = document.getElementById('loc-dropdown');
    const locWrapper = document.getElementById('loc-wrapper');

    locInput?.addEventListener('focus', () => locDropdown?.classList.remove('hidden'));
    document.addEventListener('click', (e) => {
        if (locWrapper && !locWrapper.contains(e.target)) {
            locDropdown?.classList.add('hidden');
        }
    });
    document.querySelectorAll('.loc-option').forEach(btn => {
        btn.addEventListener('click', () => {
            locInput.value = btn.textContent.trim();
            locDropdown?.classList.add('hidden');
        });
    });
</script>
@endpush
