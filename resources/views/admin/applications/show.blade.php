@extends('layouts.admin')

@section('title', 'Application – ' . $application->name)
@section('page-title', 'Application Detail')
@section('breadcrumb', 'Admin / Applications / #' . $application->id)

@section('content')
<div class="max-w-2xl">

    {{-- Back --}}
    <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Applications
    </a>

    {{-- Applicant Card --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-brand-light rounded-xl flex items-center justify-center">
                        <span class="text-brand font-bold text-lg">{{ strtoupper(substr($application->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900 text-lg">{{ $application->name }}</h2>
                        <a href="mailto:{{ $application->email }}" class="text-sm text-brand hover:underline">{{ $application->email }}</a>
                    </div>
                </div>
                <span class="text-xs text-gray-400">{{ $application->created_at->format('M d, Y · h:i A') }}</span>
            </div>
        </div>

        <div class="px-6 py-5 space-y-5">
            {{-- Job Applied For --}}
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Applied For</p>
                @if($application->job)
                    <a href="{{ route('jobs.show', $application->job->id) }}" target="_blank"
                       class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200 hover:border-brand/40 transition-colors">
                        <div class="w-9 h-9 bg-brand-light rounded-lg flex items-center justify-center">
                            <span class="text-brand text-xs font-bold">{{ strtoupper(substr($application->job->company, 0, 2)) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $application->job->title }}</p>
                            <p class="text-xs text-gray-500">{{ $application->job->company }} · {{ $application->job->location }}</p>
                        </div>
                    </a>
                @else
                    <p class="text-sm text-gray-500 italic">Job no longer available</p>
                @endif
            </div>

            {{-- Resume --}}
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Resume / CV</p>
                <a href="{{ $application->resume_link }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 text-sm text-brand font-medium hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Open Resume
                </a>
            </div>

            {{-- Cover Note --}}
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Cover Note</p>
                <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-700 leading-relaxed whitespace-pre-line border border-gray-200">
                    {{ $application->cover_note }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
