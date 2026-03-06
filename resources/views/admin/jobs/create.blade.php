@extends('layouts.admin')

@section('title', 'Post New Job')
@section('page-title', 'Post New Job')
@section('breadcrumb', 'Admin / Jobs / New')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">

        <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-5" novalidate>
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Job Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Senior Frontend Developer"
                       class="w-full px-4 py-2.5 border {{ $errors->has('title') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent">
                @error('title') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Company --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Company Name <span class="text-red-500">*</span></label>
                <input type="text" name="company" value="{{ old('company') }}" placeholder="e.g. Acme Corp"
                       class="w-full px-4 py-2.5 border {{ $errors->has('company') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent">
                @error('company') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Location --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Location <span class="text-red-500">*</span></label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. New York, NY / Remote"
                       class="w-full px-4 py-2.5 border {{ $errors->has('location') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent">
                @error('location') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category <span class="text-red-500">*</span></label>
                <select name="category"
                        class="w-full px-4 py-2.5 border {{ $errors->has('category') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent bg-white">
                    <option value="">Select a category…</option>
                    @foreach(['Technology','Design','Marketing','Finance','Healthcare','Education','Engineering','Sales','Legal','Remote'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Job Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="8" placeholder="Describe the role, responsibilities, and requirements…"
                          class="w-full px-4 py-2.5 border {{ $errors->has('description') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent resize-none">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('admin.jobs.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
                <button type="submit" class="bg-brand text-white font-semibold px-8 py-2.5 rounded-lg hover:bg-brand-dark transition-colors text-sm">
                    Post Job
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
