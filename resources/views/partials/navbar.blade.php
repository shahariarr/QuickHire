<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-900 text-xl">QuickHire</span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('jobs.index') }}"
                   class="text-sm font-medium {{ request()->routeIs('jobs.*') ? 'text-brand' : 'text-gray-600 hover:text-gray-900' }} transition-colors">
                    Find Jobs
                </a>
                <a href="{{ route('home') }}#how-it-works"
                   class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                    How It Works
                </a>
            </div>

            {{-- CTA Buttons --}}
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}"
                   class="text-sm font-medium text-gray-600 hover:text-brand transition-colors">
                    Admin
                </a>
                <a href="{{ route('jobs.index') }}"
                   class="bg-brand text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-brand-dark transition-colors">
                    Browse Jobs
                </a>
            </div>

            {{-- Mobile menu button --}}
            <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 px-4 pb-4">
        <div class="pt-3 space-y-1">
            <a href="{{ route('jobs.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Find Jobs</a>
            <a href="{{ route('home') }}#how-it-works" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">How It Works</a>
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Admin</a>
            <a href="{{ route('jobs.index') }}" class="block mt-2 bg-brand text-white text-sm font-semibold px-4 py-2 rounded-lg text-center">Browse Jobs</a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
@endpush
