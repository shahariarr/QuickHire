@extends('layouts.app')

@section('title', $job->title . ' at ' . $job->company . ' – QuickHire')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Back --}}
        <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Jobs
        </a>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">

            {{-- Job Header --}}
            <div class="p-8 border-b border-gray-100">
                <div class="flex items-start gap-5">
                    <div class="w-16 h-16 bg-brand-light rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="text-brand font-bold text-xl">{{ strtoupper(substr($job->company, 0, 2)) }}</span>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h1>
                        <p class="text-gray-500 mt-1 text-base">{{ $job->company }}</p>
                        <div class="flex flex-wrap items-center gap-4 mt-3">
                            <span class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $job->location }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                {{ $job->category }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Posted {{ $job->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('jobs.apply', $job->id) }}"
                       class="hidden sm:block bg-brand text-white font-semibold px-6 py-3 rounded-xl hover:bg-brand-dark transition-colors text-sm flex-shrink-0">
                        Apply Now
                    </a>
                </div>
            </div>

            {{-- Job Description --}}
            <div class="p-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Job Description</h2>
                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed whitespace-pre-line">
                    {{ $job->description }}
                </div>
            </div>

            {{-- Apply Footer --}}
            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-500">Interested in this role?</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $job->applications_count ?? 0 }} people have already applied</p>
                </div>
                <a href="{{ route('jobs.apply', $job->id) }}"
                   class="bg-brand text-white font-semibold px-8 py-3 rounded-xl hover:bg-brand-dark transition-colors">
                    Apply Now
                </a>
            </div>
        </div>

        {{-- Related Jobs --}}
        @if($relatedJobs->isNotEmpty())
            <div class="mt-10">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Similar Jobs</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($relatedJobs as $related)
                        <a href="{{ route('jobs.show', $related->id) }}"
                           class="bg-white border border-gray-200 rounded-xl p-4 hover:shadow-md hover:border-brand/30 transition-all flex items-start gap-4">
                            <div class="w-10 h-10 bg-brand-light rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-brand font-bold text-sm">{{ strtoupper(substr($related->company, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 text-sm">{{ $related->title }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $related->company }} · {{ $related->location }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
