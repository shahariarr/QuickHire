@extends('layouts.app')

@section('title', $job->title . ' at ' . $job->company . ' – QuickHire')

@section('content')

{{-- Page Header / Hero --}}
<div class="bg-white border-b border-[#D6DDEB]">
    <div class="container py-8">
        <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-1.5 text-sm transition hover:opacity-70 mb-6" style="color:#4640DE;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Jobs
        </a>

        <div class="flex flex-col sm:flex-row items-start gap-6">
            <div class="w-16 h-16 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold text-xl flex-shrink-0"
                 style="color:#4640DE; background:#EEF0FD;">
                {{ strtoupper(substr($job->company, 0, 2)) }}
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold mb-1" style="font-family:'Clash Display',sans-serif; color:#25324B;">{{ $job->title }}</h1>
                <p class="text-sm mb-3" style="color:#515B6F;">{{ $job->company }}</p>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="flex items-center gap-1.5 text-sm" style="color:#515B6F;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        {{ $job->location }}
                    </span>
                    <span class="text-[#D6DDEB]">•</span>
                    <span class="text-xs px-3 py-1 rounded border border-[#FFB836] font-medium" style="color:#FFB836; background:#FFF8EE;">{{ $job->category }}</span>
                    @if($job->type)
                    <span class="text-[#D6DDEB]">•</span>
                    <span class="text-xs px-3 py-1 rounded border font-medium" style="color:#56CDAD; border-color:#56CDAD; background:#E9FAF7;">{{ $job->type }}</span>
                    @endif
                    <span class="text-[#D6DDEB]">•</span>
                    <span class="text-sm" style="color:#7C8493;">Posted {{ $job->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            <a href="{{ route('jobs.apply', $job->id) }}" class="primary-btn flex-shrink-0">
                Apply Now →
            </a>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div style="background:#F8F8FD;" class="min-h-screen py-10">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Description --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-[#D6DDEB] rounded-lg p-8">
                    <h2 class="text-lg font-bold mb-5" style="font-family:'Clash Display',sans-serif; color:#25324B;">Job Description</h2>
                    <div class="text-sm leading-8 whitespace-pre-line" style="color:#515B6F;">{{ $job->description }}</div>
                </div>

                {{-- Apply CTA (bottom) --}}
                <div class="bg-white border border-[#D6DDEB] rounded-lg p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="font-semibold text-sm" style="color:#25324B;">Interested in this role?</p>
                        <p class="text-xs mt-1" style="color:#7C8493;">{{ $job->applications_count ?? 0 }} people have already applied</p>
                    </div>
                    <a href="{{ route('jobs.apply', $job->id) }}" class="primary-btn flex-shrink-0">Apply Now →</a>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">
                {{-- Job Overview --}}
                <div class="bg-white border border-[#D6DDEB] rounded-lg p-6">
                    <h3 class="text-base font-bold mb-5" style="font-family:'Clash Display',sans-serif; color:#25324B;">Job Overview</h3>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded flex items-center justify-center flex-shrink-0" style="background:#EEF0FD;">
                                <svg class="w-4 h-4" style="color:#4640DE;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs mb-0.5" style="color:#7C8493;">Location</p>
                                <p class="font-medium" style="color:#25324B;">{{ $job->location }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded flex items-center justify-center flex-shrink-0" style="background:#EEF0FD;">
                                <svg class="w-4 h-4" style="color:#4640DE;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs mb-0.5" style="color:#7C8493;">Category</p>
                                <p class="font-medium" style="color:#25324B;">{{ $job->category }}</p>
                            </div>
                        </li>
                        @if($job->type)
                        <li class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded flex items-center justify-center flex-shrink-0" style="background:#EEF0FD;">
                                <svg class="w-4 h-4" style="color:#4640DE;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs mb-0.5" style="color:#7C8493;">Job Type</p>
                                <p class="font-medium" style="color:#25324B;">{{ $job->type }}</p>
                            </div>
                        </li>
                        @endif
                        <li class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded flex items-center justify-center flex-shrink-0" style="background:#EEF0FD;">
                                <svg class="w-4 h-4" style="color:#4640DE;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs mb-0.5" style="color:#7C8493;">Date Posted</p>
                                <p class="font-medium" style="color:#25324B;">{{ $job->created_at->format('M d, Y') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Share --}}
                <div class="bg-white border border-[#D6DDEB] rounded-lg p-6">
                    <h3 class="text-base font-bold mb-3" style="font-family:'Clash Display',sans-serif; color:#25324B;">Share This Job</h3>
                    <p class="text-xs mb-4" style="color:#515B6F;">Help a friend find their next role</p>
                    <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>alert('Link copied!'))"
                            class="w-full py-2.5 text-sm font-semibold rounded border border-[#D6DDEB] transition hover:border-[#4640DE] hover:text-[#4640DE]"
                            style="color:#515B6F;">
                        Copy Link
                    </button>
                </div>
            </div>
        </div>

        {{-- Related Jobs --}}
        @if($relatedJobs->isNotEmpty())
        <div class="mt-12">
            <h2 class="text-xl font-bold mb-6" style="font-family:'Clash Display',sans-serif; color:#25324B;">Similar Jobs</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($relatedJobs as $related)
                <a href="{{ route('jobs.show', $related->id) }}"
                   class="group flex items-start gap-4 bg-white border border-[#D6DDEB] rounded-lg p-5 transition hover:border-[#4640DE] hover:shadow-md">
                    <div class="w-12 h-12 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold text-sm flex-shrink-0"
                         style="color:#4640DE; background:#EEF0FD;">
                        {{ strtoupper(substr($related->company, 0, 2)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-sm" style="color:#25324B;">{{ $related->title }}</p>
                        <p class="text-xs mt-0.5" style="color:#515B6F;">{{ $related->company }} · {{ $related->location }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
