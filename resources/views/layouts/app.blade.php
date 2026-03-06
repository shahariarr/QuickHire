<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scrollbar-thin scrollbar-thumb-zinc-400 scrollbar-track-zinc-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'QuickHire • Find Your Perfect Job')</title>

    <!-- Compiled frontend CSS (Tailwind v4 + design tokens) -->
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">

    <!-- Extra Tailwind CDN for Blade-specific utilities -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primaryColor:       '#4640DE',
                        textDarkColor:      '#25324B',
                        textGrayColor:      '#515B6F',
                        cardTextGrayColor:  '#7C8493',
                        textLightDarkColor: '#202430',
                        secondryColor:      '#26A4FF',
                    },
                    fontFamily: {
                        epilogue:      ['Epilogue', 'sans-serif'],
                        clashDisplay:  ['Clash Display', 'sans-serif'],
                        redHatDisplay: ['Red Hat Display', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700;800&family=Red+Hat+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Clash Display';
            src: url('{{ asset('Fonts/TTF/ClashDisplay-Variable.ttf') }}') format('truetype');
        }
        body { font-family: Epilogue, sans-serif; overflow-x: hidden; background-color: #fff; }
        body ::selection { background-color: #4640DE; color: #EFF6FF; }
        .primary-btn {
            border-radius: 0.375rem; padding: 10px 1.25rem; text-align: center;
            font-size: 1rem; font-weight: 700; color: #EFF6FF;
            background-color: #4640DE; transition: all .3s ease-in-out; display: inline-block;
        }
        .primary-btn:hover { background-color: rgba(70,64,222,.9); scale: .97; }
        .nav-link {
            padding: 0.5rem; font-size: 1rem; font-weight: 500; color: #25324B;
            transition: color .3s; display: inline-block;
        }
        .nav-link:hover { color: #4640DE; }
    </style>

    @stack('styles')
</head>
<body>

    @include('partials.navbar')

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="container mx-auto py-3">
        <div class="flex items-center gap-2 bg-[#56CDAD1A] border border-[#56cdad29] text-[#56CDAD] rounded-lg px-4 py-3">
            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="container mx-auto py-3">
        <div class="flex items-center gap-2 bg-[#ff832a1f] border border-[#ffb93637] text-[#ff832ae5] rounded-lg px-4 py-3">
            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
