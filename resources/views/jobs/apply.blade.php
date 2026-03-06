@extends('layouts.app')

@section('title', 'Apply – ' . $job->title . ' · QuickHire')

@section('content')

{{-- Page Header --}}
<div class="bg-white border-b border-[#D6DDEB]">
    <div class="container py-8">
        <a href="{{ route('jobs.show', $job->id) }}" class="inline-flex items-center gap-1.5 text-sm transition hover:opacity-70 mb-5" style="color:#4640DE;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back to Job
        </a>
        <h1 class="text-2xl font-bold" style="font-family:'Clash Display',sans-serif; color:#25324B;">Submit Application</h1>
        <p class="text-sm mt-1" style="color:#515B6F;">{{ $job->title }} at {{ $job->company }}</p>
    </div>
</div>

<div style="background:#F8F8FD;" class="min-h-screen py-10">
    <div class="container max-w-2xl">

        {{-- Job Summary Card --}}
        <div class="bg-white border border-[#D6DDEB] rounded-lg p-5 mb-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg border border-[#D6DDEB] flex items-center justify-center font-bold flex-shrink-0" style="color:#4640DE; background:#EEF0FD;">
                {{ strtoupper(substr($job->company, 0, 2)) }}
            </div>
            <div>
                <h2 class="font-semibold text-sm" style="color:#25324B;">{{ $job->title }}</h2>
                <p class="text-xs mt-0.5" style="color:#515B6F;">{{ $job->company }} · {{ $job->location }}</p>
            </div>
        </div>

        {{-- Application Form --}}
        <div class="bg-white border border-[#D6DDEB] rounded-lg p-8">
            <h2 class="text-xl font-bold mb-1" style="font-family:'Clash Display',sans-serif; color:#25324B;">Your Application</h2>
            <p class="text-sm mb-6" style="color:#515B6F;">Fill in the details below and we'll pass them on to the employer.</p>

            <form action="{{ route('jobs.apply.store', $job->id) }}" method="POST" class="space-y-5" novalidate>
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           placeholder="Jane Doe"
                           class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] {{ $errors->has('name') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                           style="color:#25324B;">
                    @error('name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           placeholder="jane@example.com"
                           class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] {{ $errors->has('email') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                           style="color:#25324B;">
                    @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Resume Link --}}
                <div>
                    <label for="resume_link" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Resume / CV Link <span class="text-red-500">*</span></label>
                    <input type="url" id="resume_link" name="resume_link" value="{{ old('resume_link') }}"
                           placeholder="https://drive.google.com/…"
                           class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] {{ $errors->has('resume_link') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                           style="color:#25324B;">
                    <p class="mt-1 text-xs" style="color:#7C8493;">Google Drive, Dropbox, LinkedIn, or any public link.</p>
                    @error('resume_link')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Cover Note --}}
                <div>
                    <label for="cover_note" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Cover Note <span class="text-red-500">*</span></label>
                    <textarea id="cover_note" name="cover_note" rows="5"
                              placeholder="Briefly tell the employer why you're a great fit for this role…"
                              class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] resize-none {{ $errors->has('cover_note') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                              style="color:#25324B;">{{ old('cover_note') }}</textarea>
                    @error('cover_note')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-between pt-2">
                    <p class="text-xs" style="color:#7C8493;">Your information is handled respectfully.</p>
                    <button type="submit" class="primary-btn">Submit Application →</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
