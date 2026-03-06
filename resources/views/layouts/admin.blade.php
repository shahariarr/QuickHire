<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') – QuickHire</title>

    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primaryColor:      '#4640DE',
                        textDarkColor:     '#25324B',
                        textGrayColor:     '#515B6F',
                        cardTextGrayColor: '#7C8493',
                        textLightDarkColor:'#202430',
                        secondryColor:     '#26A4FF',
                    },
                    fontFamily: {
                        epilogue:      ['Epilogue','sans-serif'],
                        clashDisplay:  ['Clash Display','sans-serif'],
                        redHatDisplay: ['Red Hat Display','sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700;800&family=Red+Hat+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Clash Display';
            src: url('/Fonts/TTF/ClashDisplay-Variable.ttf') format('truetype');
            font-weight: 100 900;
            font-display: swap;
        }
        body { font-family: 'Epilogue', sans-serif; }
        .sidebar-link {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; border-radius: 6px;
            font-size: 14px; font-weight: 500; color: #515B6F;
            transition: all .15s;
        }
        .sidebar-link:hover { background:#F8F8FD; color:#25324B; }
        .sidebar-link.active { background:#EEF0FD; color:#4640DE; font-weight: 600; }
    </style>
    @stack('styles')
</head>
<body class="antialiased" style="background:#F8F8FD;">

<div class="flex h-screen overflow-hidden">

    {{-- =================== SIDEBAR =================== --}}
    <aside class="w-64 bg-white border-r border-[#D6DDEB] flex-shrink-0 flex flex-col">

        {{-- Logo --}}
        <div class="h-16 flex items-center px-6 border-b border-[#D6DDEB]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#4640DE;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="font-bold text-lg" style="font-family:'Clash Display',sans-serif; color:#25324B;">QuickHire</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 overflow-y-auto space-y-1">
            <p class="text-xs font-semibold uppercase tracking-widest px-3 mb-3" style="color:#7C8493;">Main Menu</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.jobs.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Manage Jobs
            </a>

            <a href="{{ route('admin.applications.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Applications
            </a>

            <div class="pt-6">
                <p class="text-xs font-semibold uppercase tracking-widest px-3 mb-3" style="color:#7C8493;">Site</p>
                <a href="{{ route('home') }}" class="sidebar-link">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View Public Site
                </a>
            </div>
        </nav>

        {{-- User badge --}}
        <div class="px-4 py-4 border-t border-[#D6DDEB]">
            <div class="flex items-center gap-3 px-3 py-2 rounded-lg" style="background:#F8F8FD;">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background:#EEF0FD;">
                    <svg class="w-4 h-4" style="color:#4640DE;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold truncate" style="color:#25324B;">Admin</p>
                    <p class="text-xs truncate" style="color:#7C8493;">admin@quickhire.com</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- =================== MAIN CONTENT =================== --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Top bar --}}
        <header class="h-16 bg-white border-b border-[#D6DDEB] flex items-center justify-between px-6 flex-shrink-0">
            <div>
                <h1 class="text-base font-bold" style="font-family:'Clash Display',sans-serif; color:#25324B;">@yield('page-title', 'Dashboard')</h1>
                @hasSection('breadcrumb')
                    <p class="text-xs mt-0.5" style="color:#7C8493;">@yield('breadcrumb')</p>
                @endif
            </div>
            <div class="flex items-center gap-4">
                @if(session('success'))
                    <span class="text-sm font-medium" style="color:#56CDAD;">✓ {{ session('success') }}</span>
                @endif
                @if(session('error'))
                    <span class="text-sm font-medium text-red-500">✕ {{ session('error') }}</span>
                @endif
                <a href="{{ route('admin.jobs.create') }}" class="primary-btn text-sm">+ Post Job</a>
            </div>
        </header>

        {{-- Page --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
