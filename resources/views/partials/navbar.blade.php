<nav class="sticky top-0 z-50 bg-white border-b border-[#D6DDEB]">
    <div class="container flex items-center justify-between h-[72px]">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 select-none">
            <div class="w-8 h-8 bg-primaryColor rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-bold text-xl" style="font-family:'Clash Display',sans-serif; color:#25324B; letter-spacing:-0.01em;">QuickHire</span>
        </a>

        {{-- Desktop Nav Links --}}
        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('jobs.index') }}" class="nav-link {{ request()->routeIs('jobs.*') ? '!text-primaryColor font-semibold' : '' }}">Find Jobs</a>
            <span class="w-px h-5 bg-[#D6DDEB] mx-2"></span>
            <a href="{{ route('home') }}#how-it-works" class="nav-link">How It Works</a>
        </div>

        {{-- Desktop CTA --}}
        <div class="hidden md:flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="nav-link" style="color:#515B6F;">Admin Panel</a>
            <div class="w-px h-6 bg-[#D6DDEB]"></div>
            <a href="{{ route('jobs.index') }}" class="primary-btn">Browse Jobs &rarr;</a>
        </div>

        {{-- Mobile toggle --}}
        <button id="nav-toggle" class="md:hidden p-2 rounded-lg transition" style="color:#515B6F;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div id="nav-menu" class="hidden md:hidden border-t border-[#D6DDEB]">
        <div class="container py-4 flex flex-col gap-1">
            <a href="{{ route('jobs.index') }}" class="nav-link block py-2.5 px-3 rounded-lg hover:bg-gray-50">Find Jobs</a>
            <a href="{{ route('home') }}#how-it-works" class="nav-link block py-2.5 px-3 rounded-lg hover:bg-gray-50">How It Works</a>
            <a href="{{ route('admin.dashboard') }}" class="nav-link block py-2.5 px-3 rounded-lg hover:bg-gray-50" style="color:#515B6F;">Admin Panel</a>
            <div class="pt-3">
                <a href="{{ route('jobs.index') }}" class="primary-btn w-full block text-center">Browse Jobs</a>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.getElementById('nav-toggle').addEventListener('click', function () {
        document.getElementById('nav-menu').classList.toggle('hidden');
    });
</script>
@endpush
