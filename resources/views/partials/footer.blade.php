<footer style="background-color:#202430;" class="text-white mt-auto">
    <div class="container py-16">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-[#D6DDEB]/10">

            {{-- Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-5">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#4640DE;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-white" style="font-family:'Clash Display',sans-serif;">QuickHire</span>
                </a>
                <p class="text-sm leading-7" style="color:#D6DDEB; opacity:0.7;">
                    Connecting talented people with great companies. Find your next opportunity today.
                </p>
            </div>

            {{-- For Job Seekers --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-widest mb-5" style="color:#D6DDEB;">For Job Seekers</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('jobs.index') }}" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">Browse Jobs</a></li>
                    <li><a href="{{ route('jobs.index') }}?category=Technology" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">Tech Jobs</a></li>
                    <li><a href="{{ route('jobs.index') }}?category=Design" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">Design Jobs</a></li>
                    <li><a href="{{ route('jobs.index') }}?category=Marketing" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">Marketing Jobs</a></li>
                </ul>
            </div>

            {{-- For Employers --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-widest mb-5" style="color:#D6DDEB;">For Employers</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('admin.jobs.create') }}" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">Post a Job</a></li>
                    <li><a href="{{ route('admin.dashboard') }}" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">Dashboard</a></li>
                    <li><a href="{{ route('admin.applications.index') }}" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">Applications</a></li>
                </ul>
            </div>

            {{-- Company --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-widest mb-5" style="color:#D6DDEB;">Company</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}#how-it-works" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">How It Works</a></li>
                    <li><a href="{{ route('home') }}#about" class="text-sm transition hover:text-white" style="color:rgba(214,221,235,.7);">About Us</a></li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8">
            <p class="text-sm" style="color:rgba(214,221,235,.5);">&copy; {{ date('Y') }} QuickHire. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-xs transition hover:text-white" style="color:rgba(214,221,235,.5);">Privacy Policy</a>
                <a href="#" class="text-xs transition hover:text-white" style="color:rgba(214,221,235,.5);">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
