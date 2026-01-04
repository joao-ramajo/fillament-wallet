<header
    class="relative z-10 px-6 py-4 flex items-center justify-between border-b-4 border-zinc-800 bg-zinc-950/80 backdrop-blur-sm">
    <!-- Logo -->
    <a href="{{ route('web.home') }}" class="group flex items-center gap-4 transition-transform hover:scale-105">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="Filament Wallet Logo"
            class="w-[250px] md:w-[300px] transition-all">
    </a>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex items-center gap-6">
        @if (Auth::check())
            <!-- User Info -->
            <div class="flex items-center gap-4 px-4 py-2 bg-zinc-900 border-2 border-zinc-800">
                <div
                    class="w-8 h-8 bg-lime-400 flex items-center justify-center rounded-full text-zinc-950 font-black uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-xs text-zinc-500 uppercase tracking-wider">Bem-vindo</p>
                    <p class="text-sm text-zinc-100 font-bold">{{ Str::limit(Auth::user()->name, 15) }}</p>
                </div>
            </div>

            <!-- Dashboard Button -->
            <a href="{{ route('web.dashboard') }}"
                class="bg-lime-400 text-zinc-950 px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200">
                Minha Carteira
            </a>

            <!-- Logout Button -->
            <form action="{{ route('api.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="bg-zinc-700 text-zinc-100 px-4 py-2 font-bold uppercase shadow-[2px_2px_0_0_#000] hover:shadow-[1px_1px_0_0_#000] hover:bg-zinc-600 transition-all duration-150 flex items-center gap-2">
                    <span class="hidden lg:inline">Sair</span>
                    <span class="text-lg">→</span>
                </button>
            </form>
        @else
            <!-- Features Link -->
            <a href="{{ route('web.features') }}"
                class="text-zinc-300 hover:text-lime-400 font-bold uppercase text-sm transition-colors">
                Recursos
            </a>

            <!-- Login Button -->
            <a href="{{ route('web.login') }}"
                class="bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200">
                Entrar
            </a>
        @endif
    </nav>

    <!-- Mobile Menu Button -->
    <button id="mobileMenuBtn" class="md:hidden flex flex-col gap-1.5 p-2 hover:bg-zinc-900 transition-colors">
        <span class="w-6 h-0.5 bg-zinc-100 transition-all"></span>
        <span class="w-6 h-0.5 bg-zinc-100 transition-all"></span>
        <span class="w-6 h-0.5 bg-zinc-100 transition-all"></span>
    </button>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobileMenu" class="hidden fixed inset-0 bg-zinc-950/95 backdrop-blur-md z-50 md:hidden">
    <div class="flex flex-col h-full">
        <!-- Mobile Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b-4 border-zinc-800">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="Filament Wallet Logo" class="w-[200px]">
            <button id="closeMobileMenu" class="p-2 text-zinc-100 hover:text-lime-400 text-2xl font-bold">
                ✕
            </button>
        </div>

        <!-- Mobile Nav Items -->
        <nav class="flex flex-col gap-4 p-6 flex-1">
            @if (Auth::check())
                <!-- User Card Mobile -->
                <div class="flex items-center gap-4 p-4 bg-zinc-900 border-2 border-lime-400 mb-4">
                    <div
                        class="w-12 h-12 bg-lime-400 flex items-center justify-center rounded-full text-zinc-950 font-black uppercase text-xl">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-xs text-zinc-500 uppercase tracking-wider">Bem-vindo</p>
                        <p class="text-lg text-zinc-100 font-bold">{{ Auth::user()->name }}</p>
                    </div>
                </div>

                <a href="{{ route('web.dashboard') }}"
                    class="bg-lime-400 text-zinc-950 px-6 py-4 font-black uppercase text-center shadow-[6px_6px_0_0_#000]">
                    Minha Carteira
                </a>

                <!-- Logout Button Mobile -->
                <form action="{{ route('api.logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="w-full bg-zinc-700 text-zinc-100 px-6 py-3 font-bold uppercase text-center shadow-[2px_2px_0_0_#000] flex items-center justify-center gap-2 hover:bg-zinc-600 hover:shadow-[1px_1px_0_0_#000] transition-all duration-150">
                        <span>Sair da Conta</span>
                        <span class="text-xl">→</span>
                    </button>

                </form>
            @else
                <a href="{{ route('web.home') }}"
                    class="text-zinc-100 hover:text-lime-400 font-bold uppercase text-lg py-3 border-b border-zinc-800 transition-colors">
                    Início
                </a>

                <a href="{{ route('web.features') }}"
                    class="text-zinc-100 hover:text-lime-400 font-bold uppercase text-lg py-3 border-b border-zinc-800 transition-colors">
                    Recursos
                </a>

                <a href="{{ route('web.login') }}"
                    class="bg-zinc-100 text-zinc-950 px-6 py-4 font-black uppercase text-center shadow-[6px_6px_0_0_#000] mt-4">
                    Entrar
                </a>
            @endif
        </nav>
    </div>
</div>
@auth
    <div class="bg-lime-400 text-zinc-950 border-b-4 border-zinc-950 shadow-[0_4px_0_0_#000]">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between gap-4">
            <!-- Mensagem -->
            <div class="flex items-center gap-3 flex-1">
                <p class="font-bold text-sm md:text-base">
                    <span class="font-black uppercase">Versão Beta:</span> Faça backup regular dos seus dados — pode ocorrer
                    perda de informações
                </p>
            </div>

            <!-- Botão Compacto -->
            <a href="{{ route('web.export') }}"
                class="flex-shrink-0 bg-zinc-950 text-lime-400 px-4 py-2 font-black uppercase text-xs hover:bg-zinc-800 transition-colors whitespace-nowrap hidden md:inline-block">
                Exportar
            </a>
        </div>
    </div>
@endauth
<script>
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMobileMenu = document.getElementById('closeMobileMenu');

    mobileMenuBtn?.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
    });

    closeMobileMenu?.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
    });

    // Close on click outside
    mobileMenu?.addEventListener('click', (e) => {
        if (e.target === mobileMenu) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>
