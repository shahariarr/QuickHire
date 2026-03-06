@extends('layouts.admin')

@section('title', 'Applications')
@section('page-title', 'Applications')
@section('breadcrumb', 'Admin / Applications')

@section('content')

{{-- Filters --}}
<form method="GET" action="{{ route('admin.applications.index') }}" class="mb-6 flex flex-wrap gap-3">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search applicant or job…"
           class="flex-1 sm:max-w-xs px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent">
    <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition-colors">Search</button>
    @if(request('search'))
        <a href="{{ route('admin.applications.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700">Clear</a>
    @endif
    <div class="ml-auto text-sm text-gray-500 flex items-center">{{ $applications->total() }} application{{ $applications->total() !== 1 ? 's' : '' }}</div>
</form>

{{-- Table --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <th class="px-5 py-3.5">Applicant</th>
                <th class="px-5 py-3.5 hidden sm:table-cell">Applied For</th>
                <th class="px-5 py-3.5 hidden lg:table-cell">Resume</th>
                <th class="px-5 py-3.5 hidden md:table-cell">Date</th>
                <th class="px-5 py-3.5 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($applications as $app)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <p class="font-medium text-gray-900">{{ $app->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $app->email }}</p>
                    </td>
                    <td class="px-5 py-4 hidden sm:table-cell text-gray-600">
                        {{ $app->job->title ?? '—' }}
                        <span class="block text-xs text-gray-400">{{ $app->job->company ?? '' }}</span>
                    </td>
                    <td class="px-5 py-4 hidden lg:table-cell">
                        <a href="{{ $app->resume_link }}" target="_blank" rel="noopener"
                           class="text-xs text-brand font-medium hover:underline flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            View Resume
                        </a>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell text-xs text-gray-400">{{ $app->created_at->format('M d, Y') }}</td>
                    <td class="px-5 py-4 text-right">
                        <a href="{{ route('admin.applications.show', $app->id) }}"
                           class="text-xs text-brand font-medium hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-sm text-gray-400">No applications yet.</td>
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
