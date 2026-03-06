@extends('layouts.admin')

@section('title', 'Applications')
@section('page-title', 'Applications')
@section('breadcrumb', 'Admin / Applications')

@section('content')

{{-- Filters --}}
<form method="GET" action="{{ route('admin.applications.index') }}" class="mb-6 flex flex-wrap gap-3 items-center">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search applicant or job…"
           class="flex-1 sm:max-w-xs px-4 py-2.5 border border-[#D6DDEB] rounded text-sm outline-none transition focus:border-[#4640DE]"
           style="color:#25324B;">
    <button type="submit" class="px-4 py-2.5 text-sm rounded border border-[#D6DDEB] transition hover:border-[#4640DE]" style="color:#515B6F;">Search</button>
    @if(request('search'))
        <a href="{{ route('admin.applications.index') }}" class="px-3 py-2.5 text-sm" style="color:#7C8493;">Clear</a>
    @endif
    <div class="ml-auto text-sm" style="color:#7C8493;">{{ $applications->total() }} application{{ $applications->total() !== 1 ? 's' : '' }}</div>
</form>

{{-- Table --}}
<div class="bg-white border border-[#D6DDEB] rounded-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-[#D6DDEB] text-left" style="background:#F8F8FD;">
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider" style="color:#7C8493;">Applicant</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider hidden sm:table-cell" style="color:#7C8493;">Applied For</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider hidden lg:table-cell" style="color:#7C8493;">Resume</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider hidden md:table-cell" style="color:#7C8493;">Date</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-right" style="color:#7C8493;">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#F8F8FD]">
            @forelse($applications as $app)
                <tr class="transition hover:bg-[#F8F8FD]">
                    <td class="px-5 py-4">
                        <p class="font-medium" style="color:#25324B;">{{ $app->name }}</p>
                        <p class="text-xs mt-0.5" style="color:#7C8493;">{{ $app->email }}</p>
                    </td>
                    <td class="px-5 py-4 hidden sm:table-cell" style="color:#515B6F;">
                        {{ $app->job->title ?? '—' }}
                        <span class="block text-xs" style="color:#7C8493;">{{ $app->job->company ?? '' }}</span>
                    </td>
                    <td class="px-5 py-4 hidden lg:table-cell">
                        <a href="{{ $app->resume_link }}" target="_blank" rel="noopener"
                           class="text-xs font-medium hover:underline flex items-center gap-1 transition hover:opacity-70" style="color:#4640DE;">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            View Resume
                        </a>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell text-xs" style="color:#7C8493;">{{ $app->created_at->format('M d, Y') }}</td>
                    <td class="px-5 py-4 text-right">
                        <a href="{{ route('admin.applications.show', $app->id) }}"
                           class="text-xs font-semibold transition hover:opacity-70" style="color:#4640DE;">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center text-sm" style="color:#7C8493;">No applications yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-5">
    {{ $applications->withQueryString()->links() }}
</div>

@endsection
