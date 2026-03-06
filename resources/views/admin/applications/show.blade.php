@extends('layouts.admin')

@section('title', 'Application – ' . $application->name)
@section('page-title', 'Application Detail')
@section('breadcrumb', 'Admin / Applications / #' . $application->id)

@section('content')
<div class="max-w-2xl">

    {{-- Back --}}
    <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center gap-1 text-sm mb-5 transition hover:opacity-70" style="color:#515B6F;">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Applications
    </a>

    {{-- Applicant Card --}}
    <div class="bg-white border border-[#D6DDEB] rounded-lg overflow-hidden">
        <div class="px-6 py-5 border-b border-[#D6DDEB]">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#EEF0FD;">
                        <span class="font-bold text-lg" style="color:#4640DE;">{{ strtoupper(substr($application->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg" style="font-family:'Clash Display',sans-serif; color:#25324B;">{{ $application->name }}</h2>
                        <a href="mailto:{{ $application->email }}" class="text-sm transition hover:opacity-70" style="color:#4640DE;">{{ $application->email }}</a>
                    </div>
                </div>
                <span class="text-xs" style="color:#7C8493;">{{ $application->created_at->format('M d, Y · h:i A') }}</span>
            </div>
        </div>

        <div class="px-6 py-5 space-y-5">
            {{-- Job Applied For --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:#7C8493;">Applied For</p>
                @if($application->job)
                    <a href="{{ route('jobs.show', $application->job->id) }}" target="_blank"
                       class="flex items-center gap-3 p-3 rounded border border-[#D6DDEB] transition hover:border-[#4640DE]" style="background:#F8F8FD;">
                        <div class="w-9 h-9 rounded flex items-center justify-center flex-shrink-0" style="background:#EEF0FD;">
                            <span class="text-xs font-bold" style="color:#4640DE;">{{ strtoupper(substr($application->job->company, 0, 2)) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color:#25324B;">{{ $application->job->title }}</p>
                            <p class="text-xs" style="color:#515B6F;">{{ $application->job->company }} · {{ $application->job->location }}</p>
                        </div>
                    </a>
                @else
                    <p class="text-sm italic" style="color:#515B6F;">Job no longer available</p>
                @endif
            </div>

            {{-- Resume --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:#7C8493;">Resume / CV</p>
                <a href="{{ $application->resume_link }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 text-sm font-medium transition hover:opacity-70" style="color:#4640DE;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Open Resume
                </a>
            </div>

            {{-- Cover Note --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:#7C8493;">Cover Note</p>
                <div class="rounded p-4 text-sm leading-relaxed whitespace-pre-line border border-[#D6DDEB]" style="background:#F8F8FD; color:#515B6F;">
                    {{ $application->cover_note }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
