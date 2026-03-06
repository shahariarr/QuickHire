@extends('layouts.admin')

@section('title', 'Post New Job')
@section('page-title', 'Post New Job')
@section('breadcrumb', 'Admin / Jobs / New')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white border border-[#D6DDEB] rounded-lg p-6">

        <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-5" novalidate>
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:#25324B;">Job Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Senior Frontend Developer"
                       class="w-full px-4 py-2.5 border {{ $errors->has('title') ? 'border-red-400' : 'border-[#D6DDEB]' }} rounded text-sm outline-none transition focus:border-[#4640DE]"
                       style="color:#25324B;">
                @error('title') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Company --}}
            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:#25324B;">Company Name <span class="text-red-500">*</span></label>
                <input type="text" name="company" value="{{ old('company') }}" placeholder="e.g. Acme Corp"
                       class="w-full px-4 py-2.5 border {{ $errors->has('company') ? 'border-red-400' : 'border-[#D6DDEB]' }} rounded text-sm outline-none transition focus:border-[#4640DE]"
                       style="color:#25324B;">
                @error('company') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Location --}}
            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:#25324B;">Location <span class="text-red-500">*</span></label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. New York, NY / Remote"
                       class="w-full px-4 py-2.5 border {{ $errors->has('location') ? 'border-red-400' : 'border-[#D6DDEB]' }} rounded text-sm outline-none transition focus:border-[#4640DE]"
                       style="color:#25324B;">
                @error('location') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:#25324B;">Category <span class="text-red-500">*</span></label>
                <select name="category"
                        class="w-full px-4 py-2.5 border {{ $errors->has('category') ? 'border-red-400' : 'border-[#D6DDEB]' }} rounded text-sm outline-none transition focus:border-[#4640DE] bg-white"
                        style="color:#25324B;">
                    <option value="">Select a category…</option>
                    @foreach(['Technology','Design','Marketing','Finance','Healthcare','Education','Engineering','Sales','Legal','Remote'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:#25324B;">Job Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="8" placeholder="Describe the role, responsibilities, and requirements…"
                          class="w-full px-4 py-2.5 border {{ $errors->has('description') ? 'border-red-400' : 'border-[#D6DDEB]' }} rounded text-sm outline-none transition focus:border-[#4640DE] resize-none"
                          style="color:#25324B;">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('admin.jobs.index') }}" class="text-sm transition hover:opacity-70" style="color:#515B6F;">Cancel</a>
                <button type="submit" class="primary-btn">Post Job</button>
            </div>
        </form>

    </div>
</div>
@endsection
