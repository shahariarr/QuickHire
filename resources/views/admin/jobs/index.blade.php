@extends('layouts.admin')

@section('title', 'Manage Jobs')
@section('page-title', 'Jobs')
@section('breadcrumb', 'Admin / Jobs')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">{{ $jobs->total() }} job{{ $jobs->total() !== 1 ? 's' : '' }} total</p>
    </div>
    <a href="{{ route('admin.jobs.create') }}"
       class="inline-flex items-center gap-2 bg-brand text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-brand-dark transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        New Job
    </a>
</div>

{{-- Search --}}
<form method="GET" action="{{ route('admin.jobs.index') }}" class="mb-5 flex gap-3">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search jobs…"
           class="flex-1 sm:max-w-xs px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent">
    <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition-colors">Search</button>
    @if(request('search'))
        <a href="{{ route('admin.jobs.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700">Clear</a>
    @endif
</form>

{{-- Table --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <th class="px-5 py-3.5">Job</th>
                <th class="px-5 py-3.5 hidden md:table-cell">Category</th>
                <th class="px-5 py-3.5 hidden lg:table-cell">Location</th>
                <th class="px-5 py-3.5 hidden sm:table-cell">Applications</th>
                <th class="px-5 py-3.5 hidden sm:table-cell">Posted</th>
                <th class="px-5 py-3.5 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($jobs as $job)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-brand-light rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-brand text-xs font-bold">{{ strtoupper(substr($job->company, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $job->title }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $job->company }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell">
                        <span class="text-xs bg-brand-light text-brand font-medium px-2.5 py-1 rounded-full">{{ $job->category }}</span>
                    </td>
                    <td class="px-5 py-4 hidden lg:table-cell text-gray-500">{{ $job->location }}</td>
                    <td class="px-5 py-4 hidden sm:table-cell text-gray-900 font-medium">
                        {{ $job->applications_count ?? 0 }}
                    </td>
                    <td class="px-5 py-4 hidden sm:table-cell text-gray-400 text-xs">{{ $job->created_at->format('M d, Y') }}</td>
                    <td class="px-5 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('jobs.show', $job->id) }}" target="_blank"
                               class="text-xs text-gray-400 hover:text-gray-600" title="View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.jobs.edit', $job->id) }}"
                               class="text-xs text-brand font-medium hover:underline">Edit</a>
                            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST"
                                  onsubmit="return confirm('Delete this job and all its applications?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 font-medium hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-400">
                        No jobs found.
                        <a href="{{ route('admin.jobs.create') }}" class="text-brand font-medium hover:underline">Create the first one.</a>
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
