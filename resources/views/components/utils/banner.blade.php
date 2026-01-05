@auth
    <!-- Banner Beta - Autenticado -->
    <div class="bg-lime-400 text-zinc-950 border-b-4 border-zinc-950 shadow-[0_4px_0_0_#000]">
        <div class="max-w-7xl mx-auto px-4 py-3 md:px-6">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 md:gap-4">
                <!-- Ícone + Mensagem -->
                <div class="flex items-start md:items-center gap-3 flex-1">
                    <div class="flex-shrink-0 w-8 h-8 bg-zinc-950 flex items-center justify-center">
                        <svg class="w-5 h-5 text-lime-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-sm leading-tight">
                            <span class="font-black uppercase block md:inline">Versão Beta</span>
                            <span class="block md:inline md:ml-1 text-xs md:text-sm opacity-90">Faça backup regular — pode ocorrer perda de dados</span>
                        </p>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex gap-2 w-full md:w-auto">
                    <a href="{{ route('web.export') }}"
                        class="flex-1 md:flex-initial bg-zinc-950 text-lime-400 px-4 py-2 font-black uppercase text-xs hover:bg-zinc-800 transition-colors text-center whitespace-nowrap flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span class="hidden sm:inline">Exportar</span>
                        <span class="sm:hidden">Backup</span>
                    </a>
                    <button onclick="this.parentElement.parentElement.parentElement.remove()"
                        class="flex-shrink-0 bg-zinc-950 text-lime-400 w-10 h-10 md:w-auto md:h-auto md:px-3 md:py-2 font-black flex items-center justify-center hover:bg-zinc-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Banner Visitante - Não Autenticado -->
    <div class="bg-gradient-to-r from-lime-400 to-cyan-400 text-zinc-950 border-b-4 border-zinc-950 shadow-[0_4px_0_0_#000]">
        <div class="max-w-7xl mx-auto px-4 py-3 md:px-6">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 md:gap-4">
                <!-- Ícone + Mensagem -->
                <div class="flex items-start md:items-center gap-3 flex-1">
                    <div class="flex-shrink-0 w-8 h-8 bg-zinc-950 flex items-center justify-center">
                        <svg class="w-5 h-5 text-lime-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-sm md:text-base leading-tight">
                            <span class="font-black uppercase block md:inline">Bem-vindo ao Filament Wallet!</span>
                            <span class="block md:inline md:ml-1 text-xs md:text-sm opacity-90">Controle financeiro simples e gratuito</span>
                        </p>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex gap-2 w-full md:w-auto">
                    <a href="{{ route('web.register') }}"
                        class="flex-1 md:flex-initial bg-zinc-950 text-lime-400 px-4 py-2 md:px-6 md:py-2 font-black uppercase text-xs hover:bg-zinc-800 transition-colors text-center whitespace-nowrap">
                        Criar Conta
                    </a>
                    <a href="{{ route('web.login') }}"
                        class="flex-1 md:flex-initial border-2 border-zinc-950 text-zinc-950 px-4 py-2 md:px-6 md:py-2 font-black uppercase text-xs hover:bg-zinc-950 hover:text-lime-400 transition-colors text-center whitespace-nowrap">
                        Entrar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endauth