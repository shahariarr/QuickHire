<footer class="bg-gray-900 text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Brand --}}
            <div class="md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-brand rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-white text-xl">QuickHire</span>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Connecting talented people with great companies. Find your next opportunity today.
                </p>
            </div>

            {{-- For Job Seekers --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">For Job Seekers</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('jobs.index') }}" class="text-sm hover:text-white transition-colors">Browse Jobs</a></li>
                    <li><a href="{{ route('jobs.index') }}?category=Technology" class="text-sm hover:text-white transition-colors">Tech Jobs</a></li>
                    <li><a href="{{ route('jobs.index') }}?category=Marketing" class="text-sm hover:text-white transition-colors">Marketing Jobs</a></li>
                    <li><a href="{{ route('jobs.index') }}?category=Design" class="text-sm hover:text-white transition-colors">Design Jobs</a></li>
                </ul>
            </div>

            {{-- For Employers --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">For Employers</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.jobs.create') }}" class="text-sm hover:text-white transition-colors">Post a Job</a></li>
                    <li><a href="{{ route('admin.dashboard') }}" class="text-sm hover:text-white transition-colors">Admin Dashboard</a></li>
                    <li><a href="{{ route('admin.applications.index') }}" class="text-sm hover:text-white transition-colors">View Applications</a></li>
                </ul>
            </div>

            {{-- Company --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Company</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}#about" class="text-sm hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('home') }}#how-it-works" class="text-sm hover:text-white transition-colors">How It Works</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">© {{ date('Y') }} QuickHire. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Privacy Policy</a>
                <a href="#" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
