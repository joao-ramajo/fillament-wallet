<section class="relative z-10 px-6 py-24 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
    <div class="space-y-8">
        <h2 class="text-5xl md:text-7xl lg:text-8xl font-extrabold leading-none uppercase">
            Controle
            <span class="block text-lime-400 mt-2">Financeiro</span>
            <span class="block text-zinc-400 text-2xl md:text-3xl mt-4 font-normal normal-case tracking-wide">sem
                complicação</span>
        </h2>
        <p class="text-lg md:text-xl text-zinc-300 max-w-xl leading-relaxed">
            O <strong class="text-lime-400">Filament Wallet</strong> é um gerenciador de contas que ajuda você a
            acompanhar
            pagamentos, recebimentos e a controlar seu saldo de forma clara e eficiente.
            Registre suas transações e visualize o impacto real de cada movimento financeiro.
        </p>
        <div class="flex flex-wrap gap-6 pt-4">
            <a href="{{ route('web.register') }}"
                class="group bg-lime-400 text-zinc-950 px-10 py-5 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200">
                <span class="flex items-center gap-2">
                    Começar agora
                    <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                </span>
            </a>
            <a href="{{ route('web.features') }}"
                class="border-4 border-zinc-100 px-10 py-5 font-black uppercase hover:bg-zinc-100 hover:text-zinc-950 transition-all duration-200">
                Ver recursos
            </a>
        </div>
    </div>

    <!-- Visual block melhorado -->
    <div class="relative">
        <div
            class="bg-zinc-900 border-4 border-zinc-100 p-8 shadow-[12px_12px_0_0_#000] hover:shadow-[8px_8px_0_0_#000] transition-shadow duration-300">
            <div class="flex items-center justify-between mb-6">
                <p class="font-mono text-sm text-zinc-400 uppercase tracking-wider">Resumo financeiro</p>
                <span class="text-xs px-3 py-1 bg-lime-400 text-zinc-950 font-bold uppercase">Atualizado</span>
            </div>
            <div class="space-y-5">
                <div class="flex justify-between items-center font-bold group">
                    <span class="text-zinc-300">Total recebido</span>
                    <span class="text-lime-400 text-xl tabular-nums group-hover:scale-110 transition-transform">R$
                        12.450</span>
                </div>
                <div class="flex justify-between items-center font-bold group">
                    <span class="text-zinc-300">Total gasto</span>
                    <span class="text-red-400 text-xl tabular-nums group-hover:scale-110 transition-transform">R$
                        8.320</span>
                </div>
                <div class="h-1 bg-zinc-700 my-4"></div>
                <div class="flex justify-between items-center text-2xl font-black pt-2">
                    <span>Saldo final</span>
                    <span class="text-cyan-400 tabular-nums">R$ 4.130</span>
                </div>
            </div>
            <!-- Indicador visual -->
            <div class="mt-6 pt-6 border-t border-zinc-800">
                <div class="flex items-center gap-2 text-sm text-zinc-400">
                    <div class="w-2 h-2 bg-lime-400 rounded-full animate-pulse"></div>
                    <span>Dados em tempo real</span>
                </div>
            </div>
        </div>
    </div>
</section>
