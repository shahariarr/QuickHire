@extends('layouts.admin')

@section('title', 'Manage Jobs')
@section('page-title', 'Manage Jobs')
@section('breadcrumb', 'Admin / Jobs')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm" style="color:#515B6F;">{{ $jobs->total() }} job{{ $jobs->total() !== 1 ? 's' : '' }} total</p>
    <a href="{{ route('admin.jobs.create') }}" class="primary-btn">+ New Job</a>
</div>

{{-- Search --}}
<form method="GET" action="{{ route('admin.jobs.index') }}" class="mb-5 flex gap-3">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search jobs…"
           class="flex-1 sm:max-w-xs px-4 py-2.5 border border-[#D6DDEB] rounded text-sm outline-none transition focus:border-[#4640DE]"
           style="color:#25324B;">
    <button type="submit" class="px-4 py-2.5 text-sm rounded border border-[#D6DDEB] transition hover:border-[#4640DE]" style="color:#515B6F;">Search</button>
    @if(request('search'))
        <a href="{{ route('admin.jobs.index') }}" class="px-3 py-2.5 text-sm" style="color:#7C8493;">Clear</a>
    @endif
</form>

{{-- Table --}}
<div class="bg-white border border-[#D6DDEB] rounded-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-[#D6DDEB] text-left" style="background:#F8F8FD;">
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider" style="color:#7C8493;">Job</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider hidden md:table-cell" style="color:#7C8493;">Category</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider hidden lg:table-cell" style="color:#7C8493;">Location</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider hidden sm:table-cell" style="color:#7C8493;">Apps</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider hidden sm:table-cell" style="color:#7C8493;">Posted</th>
                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-right" style="color:#7C8493;">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#F8F8FD]">
            @forelse($jobs as $job)
            <tr class="transition hover:bg-[#F8F8FD]">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold text-xs flex-shrink-0" style="color:#4640DE; background:#EEF0FD;">
                            {{ strtoupper(substr($job->company, 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-medium" style="color:#25324B;">{{ $job->title }}</p>
                            <p class="text-xs mt-0.5" style="color:#7C8493;">{{ $job->company }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    <span class="text-xs font-medium px-2.5 py-1 rounded border border-[#FFB836]" style="color:#FFB836; background:#FFF8EE;">{{ $job->category }}</span>
                </td>
                <td class="px-5 py-4 hidden lg:table-cell text-xs" style="color:#515B6F;">{{ $job->location }}</td>
                <td class="px-5 py-4 hidden sm:table-cell font-medium" style="color:#25324B;">{{ $job->applications_count ?? 0 }}</td>
                <td class="px-5 py-4 hidden sm:table-cell text-xs" style="color:#7C8493;">{{ $job->created_at->format('M d, Y') }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('jobs.show', $job->id) }}" target="_blank" class="transition hover:opacity-70" style="color:#7C8493;" title="View">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="text-xs font-semibold transition hover:opacity-70" style="color:#4640DE;">Edit</a>
                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST"
                              onsubmit="return confirm('Delete this job and all its applications?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-5 py-12 text-center text-sm" style="color:#7C8493;">
                    No jobs found.
                    <a href="{{ route('admin.jobs.create') }}" class="font-semibold" style="color:#4640DE;">Create the first one.</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-5">
    {{ $jobs->withQueryString()->links() }}
</div>

@endsection
