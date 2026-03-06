@extends('layouts.app')

@section('title', 'Create Account – QuickHire')

@section('content')
<div class="min-h-screen flex" style="background:#F8F8FD;">

    {{-- Left panel --}}
    <div class="hidden lg:flex lg:w-5/12 items-center justify-center p-12" style="background:#4640DE;">
        <div class="max-w-xs text-white text-center">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-8" style="background:rgba(255,255,255,.15);">
                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold mb-3" style="font-family:'Clash Display',sans-serif;">Join QuickHire Today</h2>
            <p class="text-sm opacity-70 leading-7">Create an account and start building your career with thousands of opportunities.</p>
        </div>
    </div>

    {{-- Right form panel --}}
    <div class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            <div class="mb-8">
                <h1 class="text-2xl font-bold mb-1" style="font-family:'Clash Display',sans-serif; color:#25324B;">Create Account</h1>
                <p class="text-sm" style="color:#515B6F;">Start finding your dream job today</p>
            </div>

            <div class="bg-white border border-[#D6DDEB] rounded-lg p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               placeholder="Jane Doe"
                               class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] {{ $errors->has('name') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                               style="color:#25324B;">
                        @error('name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               placeholder="you@example.com"
                               class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] {{ $errors->has('email') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                               style="color:#25324B;">
                        @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Password</label>
                        <input id="password" type="password" name="password" required
                               placeholder="Min. 8 characters"
                               class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] {{ $errors->has('password') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                               style="color:#25324B;">
                        @error('password')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               placeholder="Repeat your password"
                               class="w-full px-4 py-3 border border-[#D6DDEB] rounded text-sm outline-none transition focus:border-[#4640DE]"
                               style="color:#25324B;">
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="primary-btn w-full justify-center">Create Account →</button>
                </form>
            </div>

            <p class="text-center text-sm mt-6" style="color:#515B6F;">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold transition hover:opacity-80" style="color:#4640DE;">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection
