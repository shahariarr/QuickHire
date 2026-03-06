@extends('layouts.app')

@section('title', 'Apply – ' . $job->title . ' · QuickHire')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Back --}}
        <a href="{{ route('jobs.show', $job->id) }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Job
        </a>

        {{-- Job Summary Card --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-brand-light rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-brand font-bold">{{ strtoupper(substr($job->company, 0, 2)) }}</span>
            </div>
            <div>
                <h2 class="font-semibold text-gray-900">{{ $job->title }}</h2>
                <p class="text-sm text-gray-500">{{ $job->company }} · {{ $job->location }}</p>
            </div>
        </div>

        {{-- Application Form --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-8">
            <h1 class="text-xl font-bold text-gray-900 mb-1">Submit Your Application</h1>
            <p class="text-sm text-gray-500 mb-6">Fill in the details below and we'll pass them on to the employer.</p>

            <form action="{{ route('jobs.apply.store', $job->id) }}" method="POST" class="space-y-5" novalidate>
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           placeholder="Jane Doe"
                           class="w-full px-4 py-2.5 border {{ $errors->has('name') ? 'border-red-400 focus:ring-red-400' : 'border-gray-200 focus:ring-brand' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:border-transparent">
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           placeholder="jane@example.com"
                           class="w-full px-4 py-2.5 border {{ $errors->has('email') ? 'border-red-400 focus:ring-red-400' : 'border-gray-200 focus:ring-brand' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:border-transparent">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Resume Link --}}
                <div>
                    <label for="resume_link" class="block text-sm font-medium text-gray-700 mb-1.5">Resume / CV Link <span class="text-red-500">*</span></label>
                    <input type="url" id="resume_link" name="resume_link" value="{{ old('resume_link') }}"
                           placeholder="https://drive.google.com/…"
                           class="w-full px-4 py-2.5 border {{ $errors->has('resume_link') ? 'border-red-400 focus:ring-red-400' : 'border-gray-200 focus:ring-brand' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-400">Google Drive, Dropbox, LinkedIn, or any public link.</p>
                    @error('resume_link')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Cover Note --}}
                <div>
                    <label for="cover_note" class="block text-sm font-medium text-gray-700 mb-1.5">Cover Note <span class="text-red-500">*</span></label>
                    <textarea id="cover_note" name="cover_note" rows="5"
                              placeholder="Briefly tell the employer why you're a great fit for this role…"
                              class="w-full px-4 py-2.5 border {{ $errors->has('cover_note') ? 'border-red-400 focus:ring-red-400' : 'border-gray-200 focus:ring-brand' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:border-transparent resize-none">{{ old('cover_note') }}</textarea>
                    @error('cover_note')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-between pt-2">
                    <p class="text-xs text-gray-400">Your information is handled respectfully.</p>
                    <button type="submit"
                            class="bg-brand text-white font-semibold px-8 py-3 rounded-xl hover:bg-brand-dark transition-colors text-sm">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
