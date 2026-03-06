@extends('layouts.app')

@section('title', 'Sign In – QuickHire')

@section('content')
<div class="min-h-screen flex" style="background:#F8F8FD;">

    {{-- Left decorative panel --}}
    <div class="hidden lg:flex lg:w-5/12 items-center justify-center p-12" style="background:#4640DE;">
        <div class="max-w-xs text-white text-center">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-8" style="background:rgba(255,255,255,.15);">
                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold mb-3" style="font-family:'Clash Display',sans-serif;">Find Your Next Opportunity</h2>
            <p class="text-sm opacity-70 leading-7">Connect with top companies and land your dream job with QuickHire.</p>
        </div>
    </div>

    {{-- Right form panel --}}
    <div class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            <div class="mb-8">
                <h1 class="text-2xl font-bold mb-1" style="font-family:'Clash Display',sans-serif; color:#25324B;">Welcome Back!</h1>
                <p class="text-sm" style="color:#515B6F;">Sign in to your QuickHire account</p>
            </div>

            <div class="bg-white border border-[#D6DDEB] rounded-lg p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold mb-1.5" style="color:#25324B;">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="you@example.com"
                               class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] {{ $errors->has('email') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                               style="color:#25324B;">
                        @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="text-sm font-semibold" style="color:#25324B;">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs transition hover:opacity-80" style="color:#4640DE;">Forgot password?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required
                               placeholder="Min. 8 characters"
                               class="w-full px-4 py-3 border rounded text-sm outline-none transition focus:border-[#4640DE] {{ $errors->has('password') ? 'border-red-400' : 'border-[#D6DDEB]' }}"
                               style="color:#25324B;">
                        @error('password')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center gap-2">
                        <input id="remember" type="checkbox" name="remember" class="w-4 h-4 rounded" style="accent-color:#4640DE;">
                        <label for="remember" class="text-sm" style="color:#515B6F;">Remember me</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="primary-btn w-full justify-center">Sign In →</button>
                </form>
            </div>

            @if (Route::has('register'))
            <p class="text-center text-sm mt-6" style="color:#515B6F;">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold transition hover:opacity-80" style="color:#4640DE;">Sign up</a>
            </p>
            @endif
        </div>
    </div>
</div>
@endsection
