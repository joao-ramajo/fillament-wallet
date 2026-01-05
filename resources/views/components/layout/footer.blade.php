<footer class="relative z-10 bg-zinc-950 border-t-4 border-zinc-800">
    <!-- Main Footer Content -->
    <div class="px-6 py-16">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <!-- Brand Section -->
            <div class="lg:col-span-1">
                <div class="mb-6">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Filament Wallet" class="w-48 mb-4">
                </div>
                <p class="text-zinc-400 text-sm leading-relaxed mb-6">
                    Controle financeiro sem complicação. Gerencie suas finanças de forma clara e eficiente.
                </p>
                <!-- Social Links -->
                {{-- <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 bg-zinc-900 border-2 border-zinc-800 flex items-center justify-center hover:border-lime-400 hover:text-lime-400 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-zinc-900 border-2 border-zinc-800 flex items-center justify-center hover:border-lime-400 hover:text-lime-400 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-zinc-900 border-2 border-zinc-800 flex items-center justify-center hover:border-lime-400 hover:text-lime-400 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                </div> --}}
            </div>

            <!-- Navegação -->
            <div>
                <h3 class="text-zinc-100 font-black text-sm uppercase mb-4 tracking-wider">Navegação</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('web.home') }}" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Início</a></li>
                    <li><a href="{{ route('web.features') }}" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Funcionalidades</a></li>
                    <li><a href="{{ route('web.register') }}" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Criar Conta</a></li>
                    <li><a href="{{ route('web.login') }}" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Fazer Login</a></li>
                    <li><a href="{{ route('web.guia-de-uso') }}" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Guia de uso</a></li>
                    <li><a href="{{ route('web.apoie') }}" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Apoie também</a></li>
                </ul>
            </div>

            <!-- Recursos -->
            <div>
                <h3 class="text-zinc-100 font-black text-sm uppercase mb-4 tracking-wider">Recursos</h3>
                <ul class="space-y-3">
                    @auth
                        <li><a href="{{  route('web.dashboard') }}" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Dashboard</a></li>
                    @endauth
                    {{-- <li><a href="#" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Guia de Início</a></li> --}}
                    {{-- <li><a href="#" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">FAQ</a></li> --}}
                    {{-- <li><a href="#" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Blog</a></li> --}}
                    {{-- <li><a href="#" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Novidades</a></li> --}}
                </ul>
            </div>

            <!-- Suporte e Legal -->
            <div>
                <h3 class="text-zinc-100 font-black text-sm uppercase mb-4 tracking-wider">Suporte</h3>
                <ul class="space-y-3 mb-6">
                    <li>
                        <a href="mailto:suporte@filamentwallet.com" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            suporte@filamentwallet.com
                        </a>
                    </li>
                    {{-- <li class="text-zinc-400 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        (00) 1234-5678
                    </li> --}}
                </ul>

                <h3 class="text-zinc-100 font-black text-sm uppercase mb-4 tracking-wider">Legal</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('web.termos-e-condicoes') }}" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Termos e Condições</a></li>
                    {{-- <li><a href="#" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">Política de Privacidade</a></li> --}}
                    {{-- <li><a href="#" class="text-zinc-400 hover:text-lime-400 transition-colors text-sm">LGPD</a></li> --}}
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-zinc-800 px-6 py-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Copyright -->
            <div class="text-zinc-500 text-sm text-center md:text-left">
                <p>© {{ date('Y') }} <strong class="text-zinc-400">Filament Wallet</strong>. Todos os direitos reservados.</p>
            </div>

            <!-- Tech Stack / Credits -->
            {{-- <div class="flex items-center gap-6 text-xs text-zinc-600">
                <span class="flex items-center gap-2">
                    Feito com 
                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                    usando Laravel & Filament
                </span>
                <span class="hidden md:inline">•</span>
                <a href="#" class="hover:text-lime-400 transition-colors">Status da Plataforma</a>
            </div> --}}
        </div>
    </div>

    <!-- Back to Top Button -->
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
            class="fixed bottom-8 right-8 w-12 h-12 bg-lime-400 text-zinc-950 font-black flex items-center justify-center shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
</foote