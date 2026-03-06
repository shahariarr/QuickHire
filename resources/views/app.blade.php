<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title inertia>QuickHire • Find Your Perfect Job</title>

    <!-- Compiled frontend CSS (design tokens) -->
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">

    <!-- Tailwind CDN for Blade utilities -->
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
            border-radius: .375rem; padding: 10px 1.25rem; text-align: center;
            font-size: 1rem; font-weight: 700; color: #EFF6FF;
            background-color: #4640DE; transition: all .3s ease-in-out; display: inline-block;
            cursor: pointer; border: none;
        }
        .primary-btn:hover { background-color: rgba(70,64,222,.9); transform: scale(.97); }
        .nav-link {
            padding: .5rem; font-size: 1rem; font-weight: 500; color: #25324B;
            transition: color .3s; display: inline-block; text-decoration: none;
        }
        .nav-link:hover { color: #4640DE; }
        a { text-decoration: none; }
        /* NProgress bar colour */
        #nprogress .bar { background: #4640DE !important; }
        #nprogress .peg  { box-shadow: 0 0 10px #4640DE, 0 0 5px #4640DE !important; }
        #nprogress .spinner-icon {
            border-top-color: #4640DE !important;
            border-left-color: #4640DE !important;
        }
        /* ── Responsive container padding ── */
        .container { padding-left: 1rem; padding-right: 1rem; }
        @media (min-width: 640px)  { .container { padding-left: 1.5rem; padding-right: 1.5rem; } }
        @media (min-width: 1280px) { .container { padding-left: 2rem;   padding-right: 2rem;   } }
        /* ── Hero search bar: stack on mobile ── */
        @media (max-width: 639px) {
            .search-kw  { border-right: none !important; border-bottom: 1px solid #D6DDEB; }
            .search-loc { border-right: none !important; border-bottom: 1px solid #D6DDEB; }
            .search-btn { width: 100%; padding: 0.5rem 0.75rem !important; }
            .search-btn button { width: 100%; border-radius: 0 0 0.5rem 0.5rem !important; }
        }
        /* ── Job show: stack aside below description on mobile ── */
        @media (max-width: 767px) {
            .job-show-layout { flex-direction: column !important; }
            .job-show-aside  { width: 100% !important; }
        }
        /* ── Admin: tighter padding on phones ── */
        @media (max-width: 639px) {
            .admin-body    { padding: 1rem !important; }
            .admin-topbar  { padding-left: 1rem !important; padding-right: 1rem !important; }
            .admin-flash   { margin-left: 1rem !important; margin-right: 1rem !important; }
        }
    </style>

    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
</head>
<body>
    @inertia
</body>
</html>
