<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <title>{{ $title ?? 'Controle Financeiro Pessoal' }} - Filament Wallet</title>
    <meta name="description"
        content="Filament Wallet é um gerenciador de finanças pessoais simples e eficiente. Controle seus gastos, acompanhe receitas e tenha visão clara do seu saldo financeiro.">
    <meta name="keywords"
        content="controle financeiro, gerenciador de finanças, gestão de dinheiro, planejamento financeiro, orçamento pessoal, carteira digital">
    <meta name="author" content="Filament Wallet">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Controle Financeiro Pessoal' }} - Filament Wallet">
    <meta property="og:description"
        content="Gerencie suas finanças de forma clara e eficiente. Controle total sobre seus gastos e receitas.">
    <meta property="og:image" content="{{ asset('assets/img/og-image.png') }}">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="Filament Wallet">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $title ?? 'Controle Financeiro Pessoal' }} - Filament Wallet">
    <meta name="twitter:description"
        content="Gerencie suas finanças de forma clara e eficiente. Controle total sobre seus gastos e receitas.">
    <meta name="twitter:image" content="{{ asset('assets/img/og-image.png') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Theme Color -->
    <meta name="theme-color" content="#09090b">
    <meta name="msapplication-TileColor" content="#84cc16">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdn.tailwindcss.com">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        lime: {
                            400: '#84cc16',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts (opcional - remova se não usar) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: #18181b;
        }

        ::-webkit-scrollbar-thumb {
            background: #84cc16;
            border-radius: 0;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a3e635;
        }

        /* Anti-aliasing */
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        /* Selection color */
        ::selection {
            background-color: #84cc16;
            color: #09090b;
        }

        /* Focus visible for accessibility */
        *:focus-visible {
            outline: 3px solid #84cc16;
            outline-offset: 2px;
        }
    </style>

    <!-- Additional Scripts/Styles -->
    @stack('styles')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-zinc-950 text-zinc-100 font-sans antialiased scroll-smooth">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-lime-400 text-zinc-950 px-4 py-2 font-bold z-50">
        Pular para o conteúdo principal
    </a>

    <!-- Main Content -->
    <main id="main-content">
        {{ $slot }}
    </main>

    <!-- Scripts -->
    @stack('scripts')

    <!-- Analytics (adicione seu código aqui) -->
    {{-- 
    @production
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-XXXXXXXXXX');
        </script>
    @endproduction
    --}}

    <!-- Cookie Consent (opcional) -->
    {{--
    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-zinc-900 border-t-4 border-lime-400 p-4 z-50 hidden">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-zinc-300">
                Usamos cookies para melhorar sua experiência. Ao continuar navegando, você concorda com nossa 
                <a href="{{ route('web.termos-e-condicoes') }}" class="text-lime-400 hover:underline">política de privacidade</a>.
            </p>
            <button onclick="acceptCookies()" class="bg-lime-400 text-zinc-950 px-6 py-2 font-bold uppercase whitespace-nowrap">
                Aceitar
            </button>
        </div>
    </div>
    
    <script>
        function acceptCookies() {
            localStorage.setItem('cookiesAccepted', 'true');
            document.getElementById('cookie-banner').classList.add('hidden');
        }
        
        if (!localStorage.getItem('cookiesAccepted')) {
            document.getElementById('cookie-banner').classList.remove('hidden');
        }
    </script>
    --}}
</body>

</html>
